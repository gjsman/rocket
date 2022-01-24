<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Exception\InvalidRequestException;
use Stripe\Product;
use Stripe\Stripe;
use Stripe\StripeClient;

class ShopController extends Controller
{
    public function index(): Factory|View|Application {
        return view('shop.index');
    }

    public function show(Course $course): Factory|View|Application
    {
        if(!$course->visible) {
            if(!Auth::check()) abort(401);
            if((Auth::user()->rank < 5) && (Auth::id() !== $course->instructor_id)) abort(403);
        }
        return view('course.guest', ['course' => $course]);
    }

    public function addToCart(Course $course): RedirectResponse
    {
        $item = Cart::add($course->id, $course->name, 1, $course->price / 100, 1);
        Cart::associate($item->rowId, Course::class);
        return redirect()->route('cart');
    }

    public function cart(): Factory|View|Application
    {
        return view('course.cart');
    }

    public function checkout(): RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripeCustomer = Auth::user()->createOrGetStripeCustomer();

        $lineItems = [];
        foreach (Cart::content() as $item) {
            $itemPrice = $item->price * 100;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->model->name,
                        'description' => $item->model->short_summary,
                        'metadata' => [
                            'course_id' => $item->model->id,
                        ]
                    ],
                    'unit_amount' => $itemPrice,
                ],
                'quantity' => $item->qty,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'customer' => $stripeCustomer,
            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'success_url' => route('checkoutCompleted'),
            'cancel_url' => route('cart'),
        ]);

        return redirect($session->url, 303);
    }

    public function checkoutCompleted(): RedirectResponse
    {
        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );
        $stripeCustomer = Auth::user()->createOrGetStripeCustomer();
        $intents =
            $stripe
                ->paymentIntents
                ->all(['customer' => $stripeCustomer->id]);

        $orders = array();

        foreach($intents->data as $intent) {
            if($intent->status === 'succeeded') {
                $checkoutSession = $stripe->checkout->sessions->all(
                    [
                        'payment_intent' => $intent->id,
                        'expand' => ['data.line_items'],
                    ]
                )->data[0];
                $lineItems = $checkoutSession->line_items->data;
                $courseIDs = array();
                foreach ($lineItems as $lineItem) {
                    $lineItemProduct = $stripe->products->retrieve($lineItem->price->product);
                    if(isset($lineItemProduct->metadata->course_id)) {
                        for($i = 0; $i < $lineItem->quantity; $i++) {
                            $courseIDs[] = $lineItemProduct->metadata->course_id;
                        }
                    }
                }
                if(!empty($courseIDs)) {
                    foreach ($courseIDs as $courseID) {
                        Order::firstOrCreate([
                            'user_id' => Auth::id(),
                            'course_id' => $courseID,
                            'price' => $checkoutSession->amount_total,
                            'charge_id' => $intent->charges->data[0]['id'],
                            'charge_created' =>
                                Carbon::createFromTimestamp($intent->charges->data[0]['created'])->toDateTime(),
                            'payment_intent' => $intent->id,
                            'receipt_email' => $intent->charges->data[0]['receipt_email'],
                            'receipt_url' => $intent->charges->data[0]['receipt_url'],
                        ]);
                    }
                }
            }
        }

        /*
        foreach($intents->data as $intent) {
            if($intent->status === "succeeded") {
                $checkoutSession =
                    $stripe
                        ->checkout
                        ->sessions
                        ->all([
                            'payment_intent' => $intent->id
                        ])
                        ->data[0];

                $lineItems = $stripe->checkout->sessions->allLineItems($checkoutSession->id)->data;

                $course_ids = array();

                foreach($lineItems as $lineItem) {
                    $product = $stripe->products->retrieve($lineItem->price->product);

                    if(isset($product->metadata->course_id)) {
                        $checkoutSession['intent'] = $intent;
                        $checkoutSession['charge'] = $stripe
                            ->charges
                            ->retrieve(
                                $intent
                                    ->charges
                                    ->data[0]
                                    ->id
                            );
                        $checkoutSession['course'] = Course::where('id', $product->metadata->course_id)->first();
                        $checkoutSession['charge_course_id'] = (int) $product->metadata->course_id;
                        $orders[] = $checkoutSession;
                    }
                }
            }
        }
        */


        /*
        foreach(array_reverse($orders) as $order) {
            Order::firstOrCreate([
                'user_id' => Auth::id(),
                'course_id' => $order
                    ->charge_course_id,
                'price' => $order
                    ->charge
                    ->amount,
                'charge_id' => $order
                    ->charge
                    ->id,
                'charge_created' =>
                    Carbon::createFromTimestamp($order
                        ->charge
                        ->created
                    )
                        ->toDateTime(),
                'payment_intent' => $order
                    ->intent
                    ->id,
                'receipt_email' => $order
                    ->charge
                    ->receipt_email,
                'receipt_url' => $order
                    ->charge
                    ->receipt_url,
            ]);
        }
*/
        return redirect()->route('orders');
    }

    public function orders(): Factory|View|Application
    {
        $orders = Auth::user()->orders->sortByDesc('id');
        return view('shop.orders', ['orders' => $orders]);
    }
}

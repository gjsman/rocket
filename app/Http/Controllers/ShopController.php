<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
        $item = Cart::add($course->id, $course->name, 1, 9.99, 1);
        Cart::associate($item->rowId, Course::class);
        return redirect()->route('cart');
    }

    public function cart(): Factory|View|Application
    {
        return view('course.cart');
    }
}

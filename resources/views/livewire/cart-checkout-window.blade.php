<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <h1 class="text-3xl mb-4">${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</h1>
    @if(\Illuminate\Support\Facades\Auth::user())
        @if(\Gloudemans\Shoppingcart\Facades\Cart::count() > 0)
            <x-button href="{{ route('checkout') }}" class="btn btn-success">{{ __('Checkout') }} &rarr;</x-button>
        @endif
    @else
        <x-alert-warning title="{{ __('You must login or register to purchase courses.') }}" />
    @endif
</div>

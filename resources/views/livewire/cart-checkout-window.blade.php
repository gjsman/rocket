<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <h1 class="text-3xl mb-4">${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</h1>
    <p class="mb-4">{{ __('Implement Early Enrollment Discount Here') }}</p>
    @if(\Illuminate\Support\Facades\Auth::user())
        <x-button href="#" class="btn btn-success">{{ __('Checkout') }} &rarr;</x-button>
    @else
        <x-alert-warning title="{{ __('You must login or register to purchase courses.') }}" />
    @endif
</div>

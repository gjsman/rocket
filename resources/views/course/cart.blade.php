<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-4 md:gap-6">
        <div class="col-span-3 h-fit">
            <x-panel class="mb-6">
                <a class="text-green-700 font-semibold" href="{{ route('shop') }}">&larr; {{ __('Back to shop') }}</a>
            </x-panel>
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header>
                        <x-slot name="title">
                            {{ __('My cart') }}
                        </x-slot>
                    </x-header>
                </x-slot>
                <x-alert-info class="mb-6" title="{{ __('You cannot order more than 3 seats of a course, or more seats than are remaining.') }}">
                    {{ __('If a course was removed automatically from your cart, the remaining seats were purchased after you added the course to your cart. Adding a course to your cart does not guarantee a seat.') }}
                </x-alert-info>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Qty') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Price') }}
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">{{ __('Remove from cart buttons') }}</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                                            @livewire('cart-item', ['rowId' => $item->rowId])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </x-panel>
        </div>
        <div class="col-span-1 h-fit">
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header>
                        <x-slot name="title">
                            {{ __('Checkout') }}
                        </x-slot>
                    </x-header>
                </x-slot>
                @livewire('cart-checkout-window')
            </x-panel>
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header>
                        <x-slot name="title">
                            {{ __('Previous orders') }}
                        </x-slot>
                    </x-header>
                </x-slot>
                <x-button href="{{ route('orders') }}">{{ __('View previous orders') }}</x-button>
            </x-panel>
        </div>
    </div>
</x-app-layout>

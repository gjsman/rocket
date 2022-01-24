<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-4 md:gap-6">
        <div class="col-span-3 h-fit">
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header title="{{ __('My Orders') }}" />
                </x-slot>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Order date') }}
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">{{ __('Remove from cart buttons') }}</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($orders as $order)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $order->course->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @if($order->assigned())
                                                        {{ __('Assigned to ').$order->enrollment->student->name }}
                                                    @else
                                                        {{ __('Unassigned') }}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $order->created_at->format('m/d/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ url($order->receipt_url) }}" class="text-green-700 hover:text-green-800 mr-4" style="text-decoration: none;">{{ __('Receipt') }}</a>
                                                    @if($order->assigned())
                                                        <a href="#" class="text-green-700 hover:text-green-800" style="text-decoration: none;">{{ __('Unassign') }}</a>
                                                    @else
                                                        <x-button href="#">{{ __('Assign to student') }}</x-button>
                                                    @endif
                                                </td>
                                            </tr>
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
            <x-panel>
                <x-slot name="header">
                    <x-header title="{{ __('Missing an order?') }}" />
                </x-slot>
                <x-button href="{{ route('checkoutCompleted') }}">{{ __('Reload recent orders') }}</x-button>
            </x-panel>
        </div>
    </div>
</x-app-layout>

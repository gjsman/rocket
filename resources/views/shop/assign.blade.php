<x-app-layout>
    <x-panel class="mb-6">
        <a class="text-green-700 font-semibold" href="{{ route('orders') }}">&larr; {{ __('Back to orders') }}</a>
    </x-panel>
    <x-panel>
        <x-slot name="header">
            <x-header>
                <x-slot name="title">
                    {{ __('Assign purchased course ').$order->course->name.__(' to a student') }}
                </x-slot>
            </x-header>
        </x-slot>

    </x-panel>
</x-app-layout>

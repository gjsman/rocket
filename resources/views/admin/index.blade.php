<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin > Home') }}
        </h2>
    </x-slot>
    <x-admin-layout>
        <x-slot name="header">
            <x-header title="{{ __('Home') }}" />
        </x-slot>


    </x-admin-layout>
</x-app-layout>

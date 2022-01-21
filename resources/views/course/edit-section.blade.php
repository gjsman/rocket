<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ').$section->name }}
        </h2>
    </x-slot>
    <x-panel>
        <x-slot name="header">
            <x-header>
                <x-slot name="title">
                    {{ __('Edit Section') }}
                </x-slot>
                <ul>
                    <li>{{ __('Section: ').$section->name }}</li>
                    <li>{{ __('Course: ').$section->course->name }}</li>
                </ul>
            </x-header>
        </x-slot>
        @livewire('edit-section', ['section' => $section])
    </x-panel>
</x-app-layout>

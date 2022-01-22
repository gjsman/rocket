<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Move ').$element->name.__(' to a different section') }}
        </h2>
    </x-slot>
    <x-panel>
        <x-slot name="header">
            <x-header>
                <x-slot name="title">
                    {{ __('Move ').$element->name.__(' to a different section') }}
                </x-slot>
                <ul>
                    <li>{{ __('Section: ').$element->section->name }}</li>
                    <li>{{ __('Course: ').$element->section->course->name }}</li>
                </ul>
            </x-header>
        </x-slot>
        <form method="POST" action="{{ route('element.move', ['course' => $element->section->course, 'class' => class_basename($element), 'id' => $element->id]) }}">
            @csrf
            <div>
                <label class="text-base font-medium text-gray-900">{{ __('Select a section') }}</label>
                <p class="text-sm leading-5 text-gray-500">{{ __('Which section should ').$element->name.__(' belong to?') }}</p>
                <fieldset class="mt-4">
                    <legend class="sr-only">{{ __('Section name') }}</legend>
                    <div class="space-y-4">
                        @foreach($course->sections->sortBy('order') as $section)
                            <div class="flex items-center">
                                <input id="{{ $section->id }}" value="{{ $section->id }}" name="sectionID" type="radio" @if($section->id === $element->section_id) checked @endif class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300">
                                <label for="{{ $section->id }}" class="ml-3 block text-sm font-medium text-gray-700">
                                    {{ $section->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>
            <div class="mt-6 h-9">
                <div class="clearfix">
                    <div class="float-right">
                        <div class="flex space-x-2">
                            <x-secondary-button href="{{ route('course', ['course' => $element->section->course]) }}">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-button type="submit">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-panel>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(isset($element))
                {{ __('Edit ').$element->name }}
            @else
                {{ __('Create ').strtolower(class_basename($class)) }}
            @endif
        </h2>
    </x-slot>
    <x-panel>
        <x-slot name="header">
            <x-header>
                <x-slot name="title">
                    @if(isset($element))
                        {{ __('Edit ').strtolower(class_basename($element)) }}
                    @else
                        {{ __('Create ').strtolower(class_basename($class)) }}
                    @endif
                </x-slot>
                @if(isset($element))
                    <ul>
                        <li>{{ __('Section: ').$element->section->name }}</li>
                        <li>{{ __('Course: ').$element->section->course->name }}</li>
                    </ul>
                @endif
            </x-header>
        </x-slot>
        @php
            if(isset($element)) {
                $editorName = 'edit-'.strtolower(class_basename($element));
            } else {
                $editorName = 'edit-'.strtolower(class_basename($class));
            }
            if($editorName === 'edit-textblock') {
                $editorName = 'edit-text-block';
            }
        @endphp
        @if(isset($element))
            @livewire($editorName, ['element' => $element])
        @else
            @livewire($editorName, ['section' => $section])
        @endif
    </x-panel>
</x-app-layout>
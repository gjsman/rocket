@props(['element'])

<x-panel>
    <x-slot name="header">
        <x-header>
            <x-slot name="title">
                @cannot('update', $element)
                    @livewire('checkoff', ['model' => $element], key('CHK-C-'.get_class($element).'-E-'.$element->id))
                @endcannot
                @can('update', $element)
                    <svg xmlns="http://www.w3.org/2000/svg" style="cursor: move;" class="inline h-5 w-5 mb-0.5" wire:sortable.handle fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                    </svg>
                @endcan
                @include('partials/name-with-visibility-indicator', ['model' => $element])
            </x-slot>
            @can('update', $element)
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                               <x-secondary-button type="button">
                                    {{ __('Options') }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </x-secondary-button>
                            </span>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="#">
                            {{ __('Edit or Delete ').strtolower(class_basename($element)) }}
                        </x-dropdown-link>
                        <x-dropdown-link href="#">
                            {{ __('Move') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="#">
                            {{ __('Duplicate') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="#">
                            {{ __('Hide / Show') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            @endcan
        </x-header>
    </x-slot>
    <div class="prose">
        {!! $element->summary !!}
    </div>
</x-panel>

@props(['element'])

<x-panel class="mb-6">
    <x-slot name="header">
        <x-header>
            <x-slot name="title">
                @cannot('update', $element)
                    <span class="mr-2">
                        @livewire('checkoff', ['model' => $element], key('CHK-C-'.get_class($element).'-E-'.$element->id))
                    </span>
                @endcannot
                @can('update', $element)
                    <svg xmlns="http://www.w3.org/2000/svg" class="cursor-move inline h-6 w-6 mb-0.5" wire:sortable.handle fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                    </svg>
                @endcan
                @if(strtolower(class_basename($element)) === 'video')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
                @if(strtolower(class_basename($element)) === 'link')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                @endif
                @if(strtolower(class_basename($element)) === 'file')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                @endif
                @if(strtolower(class_basename($element)) === 'book')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                @endif
                @include('partials/name-with-visibility-indicator', ['model' => $element])
            </x-slot>
            <div class="flex space-x-2">
                @if(strtolower(class_basename($element)) !== "textblock")
                    <x-button href="{{ route(strtolower(class_basename($element)), ['element' => $element]) }}">
                        {{ __('Open') }}
                    </x-button>
                @endif
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
                            <x-dropdown-link href="{{ route(strtolower(class_basename($element)).'.edit', ['element' => $element]) }}">
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
            </div>
        </x-header>
    </x-slot>
    <div class="prose">
        {!! $element->summary !!}
    </div>
</x-panel>

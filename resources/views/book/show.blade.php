<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-element-back-button :element="$element" />
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header>
                        <x-slot name="title">
                            {{ $element->name }}
                        </x-slot>
                        <div class="flex space-x-2">
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
                                        <x-dropdown-link href="{{ route('book.edit', ['element' => $element]) }}">
                                            {{ __('Edit or Delete book') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            @endcan
                        </div>
                    </x-header>
                </x-slot>
                @livewire('book-navigation', ['book' => $element, 'location' => $location])
            </x-panel>
        </div>
        <div class="col-span-2 h-fit">
            @if($location === 'information')
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header title="{{ __('Summary') }}" />
                    </x-slot>
                    <div class="prose">
                        {!! $element->summary !!}
                    </div>
                </x-panel>
            @elseif($location === 'addPage')
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header title="{{ __('Add Page') }}" />
                    </x-slot>
                    @livewire('edit-book-page', ['book' => $element])
                </x-panel>
            @else
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header>
                            <x-slot name="title">
                                @include('partials/name-with-visibility-indicator', ['model' => $page])
                            </x-slot>
                            <div class="flex space-x-2">
                                @can('update', $page)
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
                                            <x-dropdown-link href="{{ route('bookpage.edit', ['element' => $page]) }}">
                                                {{ __('Edit or Delete page') }}
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
                        {!! $page->summary !!}
                    </div>
                </x-panel>
            @endif
        </div>
    </div>
</x-app-layout>

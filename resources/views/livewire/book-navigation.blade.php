<nav class="space-y-1" aria-label="Sidebar">
    {{-- In work, do what you enjoy. --}}
    <x-sidebar-item href="{{ route('book.location', ['element' => $book, 'location' => 'information']) }}" :active="$location === 'information'">
        {{ __('Summary') }}
    </x-sidebar-item>
    @php
        $showDraggableHandles = (\Illuminate\Support\Facades\Auth::user()->can('update', $book));
    @endphp
    <ul @if ($showDraggableHandles) wire:sortable="updatePageOrder" @endif>
        @foreach($pages as $page)
            <li @if ($showDraggableHandles) wire:sortable.item="{{ $page->id }}" wire:key="PAGE-{{ $page->id }}" @endif>
                <x-sidebar-item href="{{ route('book.location', ['element' => $book, 'location' => $page->id]) }}" :active="(int) $location === $page->id">
                    @if ($showDraggableHandles)
                        <svg xmlns="http://www.w3.org/2000/svg" style="cursor: move; width: 24px; height: 24px;" class="inline" wire:sortable.handle fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    @else
                        <span class="mr-2">
                            @livewire('checkoff', ['model' => $page], key('CHK-C-'.get_class($page).'-E-'.$page->id))
                        </span>
                    @endif
                    @include('partials/name-with-visibility-indicator', ['model' => $page])
                </x-sidebar-item>
            </li>
        @endforeach
    </ul>
    @can('update', $book)
        <x-sidebar-item href="{{ route('book.location', ['element' => $book, 'location' => 'addPage']) }}" :active="$location === 'addPage'" class="text-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-0.5 ml-0.5 mb-0.5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ __('Add a new page') }}
        </x-sidebar-item>
    @endcan
</nav>

<nav class="space-y-1" aria-label="Sidebar">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'information']) }}" :active="$location === 'information'">
        {{ __('General information') }}
    </x-sidebar-item>
    @if(\Illuminate\Support\Facades\Auth::user()->can('update', $course))
        <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'participants']) }}" :active="$location === 'participants'">
            {{ __('Participants') }}
        </x-sidebar-item>
    @endif
    @php
        $showDraggableHandles = (\Illuminate\Support\Facades\Auth::user()->can('update', $this->course));
    @endphp
    <ul @if ($showDraggableHandles) wire:sortable="updateSectionOrder" @endif>
        @foreach($sections as $section)
            <li @if ($showDraggableHandles) wire:sortable.item="{{ $section->id }}" wire:key="SECTION-{{ $section->id }}" @endif>
                <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => $section->id]) }}" :active="(int) $location === $section->id">
                    @if ($showDraggableHandles)
                        <svg xmlns="http://www.w3.org/2000/svg" style="cursor: move; width: 24px; height: 24px;" class="inline" wire:sortable.handle fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                        </svg>
                    @endif
                    {{ $section->name }}
                </x-sidebar-item>
            </li>
        @endforeach
    </ul>
    <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'completion']) }}" :active="$location === 'completion'">
        {{ __('Completion') }}
    </x-sidebar-item>
</nav>

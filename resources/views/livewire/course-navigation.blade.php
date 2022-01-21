<nav class="space-y-1" aria-label="Sidebar">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'information']) }}" :active="$location === 'information'">
        {{ __('General Information') }}
    </x-sidebar-item>
    @if($course->instructor_access_link)
        <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'instructorAccess']) }}" :active="$location === 'instructorAccess'">
            {{ __('Instructor Access') }}
        </x-sidebar-item>
    @endif
    @can('update', $course)
        <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'participants']) }}" :active="$location === 'participants'">
            {{ __('Participants') }}
        </x-sidebar-item>
    @endcan
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
                    @else
                        <span class="mr-2">
                            @livewire('checkoff', ['model' => $section], key('CHK-C-'.get_class($section).'-E-'.$section->id))
                        </span>
                    @endif
                    {{ $section->name }}
                </x-sidebar-item>
            </li>
        @endforeach
    </ul>
    @can('update', $course)
        <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'addSection']) }}" :active="$location === 'addSection'" class="text-green-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-0.5 ml-0.5 mb-0.5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ __('Add a new section') }}
        </x-sidebar-item>
    @endcan
    <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'completion']) }}" :active="$location === 'completion'">
        {{ __('Completion') }}
    </x-sidebar-item>
</nav>

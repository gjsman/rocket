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
    @foreach($sections as $section)
        <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => $section->id]) }}" :active="(int) $location === $section->id">
            {{ $section->name }}
        </x-sidebar-item>
    @endforeach
    <x-sidebar-item href="{{ route('course.location', ['course' => $course, 'location' => 'completion']) }}" :active="$location === 'completion'">
        {{ __('Completion') }}
    </x-sidebar-item>
</nav>

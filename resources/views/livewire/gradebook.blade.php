<div>
    <x-panel class="mb-6">
        {{-- The Master doesn't talk, he acts. --}}
        <x-slot name="header">
            <x-header title="{{ __('Gradebook by Gradeables') }}" />
        </x-slot>
        <nav class="space-y-1">
            @foreach($gradeables as $gradeable)
                @if(class_basename($gradeable) === 'Assignment')
                    <x-sidebar-item href="{{ route('assignment.all', ['element' => $gradeable]) }}">
                        {{ $gradeable->name }}
                    </x-sidebar-item>
                @else
                    <x-sidebar-item href="#">
                        {{ $gradeable->name }}
                    </x-sidebar-item>
                @endif
            @endforeach
        </nav>
    </x-panel>
</div>

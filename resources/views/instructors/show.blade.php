<x-app-layout>
    <x-panel class="mb-6">
        <a class="text-green-700 font-semibold" href="{{ \Illuminate\Support\Facades\URL::previous() }}">&larr; {{ __('Back to instructors') }}</a>
    </x-panel>

    <x-panel class="mb-6">
        <x-slot name="header">
            <x-header>
                <x-slot name="title">
                    {{ $instructor->name }}
                </x-slot>
            </x-header>
        </x-slot>
        <div class="prose">
            {!! $instructor->summary !!}
        </div>
    </x-panel>

    <x-panel>
        <x-slot name="header">
            <x-header>
                <x-slot name="title">
                    {{ __('Courses I teach') }}
                </x-slot>
            </x-header>
        </x-slot>
        <nav class="space-y-1" aria-label="Sidebar">
            @foreach($instructor->instructing->where('visible', true)->sortBy('name') as $course)
                <x-sidebar-item href="{{ route('course', $course) }}" :active="false">
                    {{ $course->name }}
                </x-sidebar-item>
            @endforeach
        </nav>
    </x-panel>
</x-app-layout>

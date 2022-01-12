@props(['showStudentName' => false])

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <span class="inline-flex rounded-md">
            <x-secondary-button type="button">
                @if($showStudentName)

                @else
                    {{ __('Switch student') }}
                @endif
                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </x-secondary-button>
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Parent account') }}
        </div>

        <x-dropdown-link href="#">
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        </x-dropdown-link>

        <div class="border-t border-gray-100"></div>

        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Select student') }}
        </div>

        @foreach(\Illuminate\Support\Facades\Auth::user()->students as $student)
            <x-dropdown-link href="#">
                {{ $student->name }}
            </x-dropdown-link>
        @endforeach

        <div class="border-t border-gray-100"></div>

        <x-dropdown-link href="{{ route('students.manage') }}">
            {{ __('Manage students') }}
        </x-dropdown-link>
    </x-slot>
</x-dropdown>

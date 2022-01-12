@props(['showStudentName' => false, 'showInMenu' => false])

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <span class="inline-flex rounded-md">
            @if($showInMenu === true)
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                        @if(student())
                            {{ student()->name }}
                        @else
                            {{ __('Parent - ').\Illuminate\Support\Facades\Auth::user()->name }}
                        @endif

                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            @else
                <x-secondary-button type="button">
                    @if($showStudentName)
                        @if(student())
                            {{ student()->name }}
                        @else
                            {{ __('Switch student') }}
                        @endif
                    @else
                        {{ __('Switch student') }}
                    @endif
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-secondary-button>
            @endif
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Parent account') }}
        </div>

        <x-dropdown-link href="{{ route('student.unset') }}">
            @if(!student())
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            @endif
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        </x-dropdown-link>

        <div class="border-t border-gray-100"></div>

        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Select student') }}
        </div>

        @foreach(\Illuminate\Support\Facades\Auth::user()->students as $student)
            <x-dropdown-link href="{{ route('student.set', $student) }}">
                @if(student())
                    @if(student()->id === $student->id)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    @endif
                @endif
                {{ $student->name }}
            </x-dropdown-link>
        @endforeach

        <div class="border-t border-gray-100"></div>

        <x-dropdown-link href="{{ route('students.manage') }}">
            {{ __('Manage students') }}
        </x-dropdown-link>
    </x-slot>
</x-dropdown>

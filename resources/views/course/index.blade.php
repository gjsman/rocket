<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }}
        </h2>
    </x-slot>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-panel class="mb-6">
                <a class="text-green-700 font-semibold" href="{{ route('dashboard') }}">&larr; {{ __('Back to my courses') }}</a>
            </x-panel>
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header title="{{ $course->name }}" />
                </x-slot>
                @livewire('course-navigation', ['course' => $course, 'location' => $location])
            </x-panel>
        </div>
        <div class="col-span-2 h-fit">
            @if($location === 'information')
                <x-panel class="mb-8">
                    <x-slot name="header">
                        <x-header>
                            <x-slot name="title">
                                @include('partials/name-with-visibility-indicator', ['model' => $course])
                            </x-slot>
                            @can('update', $course)
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
                                        <x-dropdown-link href="{{ route('course.edit', ['course' => $course]) }}">
                                            {{ __('Edit course') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            @endcan
                        </x-header>
                    </x-slot>
                    <div class="prose">
                        {!! $course->summary !!}
                    </div>
                </x-panel>
                @if($course->instructor->summary)
                    <x-panel class="mb-8">
                        <x-slot name="header">
                            <x-header title="{{ __('About the instructor, ').$course->instructor->name }}" />
                        </x-slot>
                        <div class="prose">
                            {!! $course->instructor->summary !!}
                        </div>
                    </x-panel>
                @endif
                <x-panel>
                    <x-slot name="header">
                        <x-header title="© {{ date('Y') }} Homeschool Connections and {{ $course->instructor->name }}. All Rights Reserved."/>
                    </x-slot>
                    <p class="text-xs">This course is designed by {{ $course->instructor->name }}. All primary rights to materials are to the designer. Any redistribution or reproduction of part or all of the contents in any form is prohibited other than the following:</p>
                    <br/>
                    <ul class="list-disc list-inside">
                        <li class="text-xs">You may print or download to a local hard disk extracts for your personal homeschool and non-commercial use only.</li>
                        <li class="text-xs">You may not, except with our express written permission, distribute or commercially exploit the content, nor may you transmit it or store it in any other website or other forms of electronic retrieval system.</li>
                        <li class="text-xs">You may not, except with our express written permission, use these materials in any manner outside of personal home use. You are not permitted to use the materials in a co-op or other group setting.</li>
                        <li class="text-xs">Upon completion of the course, you must delete all copies of course materials from any local hard disk on which you saved permissible extracts.</li>
                    </ul>
                    <br/>
                    <p class="text-xs font-bold">Violation of the above copyright policies may result in expulsion without a refund and/or legal action.</p>
                </x-panel>
            @elseif($location === 'participants')
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header title="{{ __('Participants') }}" />
                    </x-slot>
                </x-panel>
            @elseif($location === 'completion')
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header title="{{ __('Course Completion') }}" />
                    </x-slot>
                    @if($course->type === 2 && student())
                        <x-button :href="route('course.unenroll', ['course' => $course, 'student' => student()])">{{ __('Unenroll from course') }}</x-button>
                    @endif
                </x-panel>
            @elseif($location === 'instructorAccess')
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header>
                            <x-slot name="title">
                                {{ __('Instructor Access') }}
                            </x-slot>
                            @can('update', $course)
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
                                        <x-dropdown-link href="{{ route('course.edit', ['course' => $course]) }}">
                                            {{ __('Edit Instructor Access information') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            @endcan
                        </x-header>
                    </x-slot>
                    <div class="prose">
                        {!! $course->instructor_access_link !!}
                    </div>
                </x-panel>
            @elseif($location === 'addSection')
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header title="{{ __('Add a section') }}" />
                    </x-slot>
                    @livewire('edit-section', ['course' => $course])
                </x-panel>
            @else
                <x-panel class="mb-6">
                    <x-slot name="header">
                        <x-header>
                            <x-slot name="title">
                                @include('partials/name-with-visibility-indicator', ['model' => $section])
                            </x-slot>
                            @can('update', $section)
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
                                        <x-dropdown-link href="{{ route('section.edit', ['section' => $section]) }}">
                                            {{ __('Edit or Delete section') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            @endcan
                        </x-header>
                    </x-slot>
                    <div class="prose">
                        {!! $section->summary !!}
                    </div>
                </x-panel>
                @livewire('elements', ['section' => $section])
                @can('update', $section)
                    <x-panel>
                        <x-slot name="header">
                            <x-header title="{{ __('Add element') }}" />
                        </x-slot>
                        <x-secondary-button href="{{ route('video.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </x-secondary-button>
                        <x-secondary-button href="{{ route('link.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </x-secondary-button>
                        <x-secondary-button href="{{ route('textblock.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </x-secondary-button>
                        <x-secondary-button href="{{ route('file.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </x-secondary-button>
                        <x-secondary-button href="{{ route('book.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </x-secondary-button>
                        <x-secondary-button href="{{ route('assignment.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </x-secondary-button>
                        <x-secondary-button href="{{ route('quiz.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </x-secondary-button>
                        <x-secondary-button href="{{ route('forum.create', ['section' => $section]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                        </x-secondary-button>
                    </x-panel>
                @endcan
            @endif
        </div>
    </div>
</x-app-layout>

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
                        <span class="mr-4">{{ __('Add') }}</span>
                        <x-secondary-button href="{{ route('video.create', ['section' => $section]) }}">{{ __('Video') }}</x-secondary-button>
                        <x-secondary-button href="{{ route('link.create', ['section' => $section]) }}">{{ __('Link') }}</x-secondary-button>
                        <x-secondary-button href="{{ route('textblock.create', ['section' => $section]) }}">{{ __('Text Block') }}</x-secondary-button>
                        <x-secondary-button href="{{ route('file.create', ['section' => $section]) }}">{{ __('File') }}</x-secondary-button>
                        <x-secondary-button href="{{ route('book.create', ['section' => $section]) }}">{{ __('Book') }}</x-secondary-button>
                        <x-secondary-button href="{{ route('assignment.create', ['section' => $section]) }}">{{ __('Assignment') }}</x-secondary-button>
                        <x-secondary-button href="{{ route('quiz.create', ['section' => $section]) }}">{{ __('Quiz') }}</x-secondary-button>
                        <x-secondary-button href="{{ route('forum.create', ['section' => $section]) }}">{{ __('Forum') }}</x-secondary-button>
                    </x-panel>
                @endcan
            @endif
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }}
        </h2>
    </x-slot>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-panel class="mb-8">
                <a class="text-green-700 font-semibold" href="{{ route('dashboard') }}">&larr; {{ __('Back to my courses') }}</a>
            </x-panel>
            <x-panel class="mb-8">
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
                        <x-header title="{{ $course->name }}" />
                    </x-slot>
                    {!! $course->summary !!}
                </x-panel>
                @if($course->instructor->summary)
                    <x-panel class="mb-8">
                        <x-slot name="header">
                            <x-header title="{{ __('About the instructor, ').$course->instructor->name }}" />
                        </x-slot>
                        {!! $course->instructor->summary !!}
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
                <x-panel class="mb-8">
                    <x-slot name="header">
                        <x-header title="{{ __('Participants') }}" />
                    </x-slot>
                </x-panel>
            @elseif($location === 'completion')
                <x-panel class="mb-8">
                    <x-slot name="header">
                        <x-header title="{{ __('Course Completion') }}" />
                    </x-slot>
                </x-panel>
            @else
                <?php
                    $section = \App\Models\Section::where('id', $location)->where('course_id', $course->id)->first();
                ?>
                <x-panel class="mb-8">
                    <x-slot name="header">
                        <x-header title="{{ $section->name }}" />
                    </x-slot>
                    {{ $section->summary }}
                </x-panel>
            @endif
        </div>
    </div>
</x-app-layout>

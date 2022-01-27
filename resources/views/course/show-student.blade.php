<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-panel class="mb-6">
                <a class="text-green-700 font-semibold" href="{{ route('course', $enrollment->course) }}">&larr; {{ __('Back to course') }}</a>
            </x-panel>
            <x-panel class="mb-6 text-lg leading-6 font-medium text-gray-900">
                {{ $student->name }}
            </x-panel>
        </div>
        <div class="col-span-2 h-fit">
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header>
                        <x-slot name="title">
                            {{ __('Grades') }}
                        </x-slot>
                    </x-header>
                </x-slot>
                <nav class="space-y-1">
                    @foreach($enrollment->course->gradeables() as $gradeable)
                        @if(class_basename($gradeable) === 'Assignment')
                            @php
                                $submission = $gradeable->submissions()->where('student_id', $student->id)->latest()->get()->first();
                            @endphp
                            @if($submission)
                                <x-sidebar-item href="{{ route('assignment.showSubmission', ['element' => $submission]) }}">
                                    {{ $gradeable->name }}
                                    <div class="ml-2 flex-shrink-0 flex float-right">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $submission->grade->value.__(' / ').$submission->grade->base }}
                                        </p>
                                    </div>
                                </x-sidebar-item>
                            @else
                                <x-sidebar-item href="#">
                                    {{ $gradeable->name }}
                                </x-sidebar-item>
                            @endif
                        @else
                            <x-sidebar-item href="#">
                                {{ $gradeable->name }}
                            </x-sidebar-item>
                        @endif
                    @endforeach
                </nav>
            </x-panel>
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header>
                        <x-slot name="title">
                            {{ __('Actions') }}
                        </x-slot>
                    </x-header>
                </x-slot>
                <x-secondary-button href="" disabled>{{ __('Refund course') }}</x-secondary-button>
                <x-secondary-button href="" disabled>{{ __('Unenroll student') }}</x-secondary-button>
            </x-panel>
        </div>
    </div>
</x-app-layout>

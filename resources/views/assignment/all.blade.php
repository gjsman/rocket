<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-element-back-button :element="$element" />
            <x-panel class="mb-6">
                <nav class="space-y-1" aria-label="Sidebar">
                    <x-sidebar-item href="{{ route('assignment', ['element' => $element]) }}" :active="false">
                        {{ __('New Submission') }}
                    </x-sidebar-item>
                    <x-sidebar-item href="{{ route('assignment.previous', ['element' => $element]) }}" :active="false">
                        {{ __('Previous Submissions') }}
                    </x-sidebar-item>
                    <x-sidebar-item href="{{ route('assignment.all', ['element' => $element]) }}" :active="true">
                        {{ __('All Submissions') }}
                    </x-sidebar-item>
                </nav>
            </x-panel>
        </div>
        <div class="col-span-2 h-fit">
            <x-list class="col-span-1 h-fit mb-8 md:mb-0">
                <x-header title="{{ __('All Submissions') }}" :list="true" />
                @forelse($element->submissions->sortByDesc('created_at') as $key => $submission)
                    @php
                        $badge = '';
                        if($submission->grade !== null) $badge = __('Graded ').$submission->grade->value.__(' / ').$submission->grade->base;
                    @endphp
                    <x-list-clickable-item href="{{ route('assignment.showSubmission', ['element' => $submission]) }}" :badge="$badge">
                        <x-slot name="title">
                            @if($submission->user_id)
                                {{ $submission->user->name }}
                            @else
                                {{ $submission->student->name }}
                            @endif
                        </x-slot>
                        <x-slot name="footerLeftIcons">
                            <x-list-icon :fixSpacing="false" title="{{ $key + 1 }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </x-list-icon>
                            <x-list-icon :fixSpacing="true" title="{{ $submission->created_at->format('m/d/Y') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </x-list-icon>
                            <x-list-icon :fixSpacing="true" title="{{ $submission->created_at->format('h:i:s').__(' UTC') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </x-list-icon>
                        </x-slot>
                    </x-list-clickable-item>
                @empty
                    <x-list-clickable-item title="{{ __('No submissions') }}" href="#" badge="">
                        <x-slot name="footerLeftIcons">
                            <p class="text-sm">{{ __('There are no submissions for the assignment.') }}</p>
                        </x-slot>
                    </x-list-clickable-item>
                @endforelse
            </x-list>
        </div>
    </div>
</x-app-layout>

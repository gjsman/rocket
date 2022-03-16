<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @if(!$quizStarted)
        @if($quiz->attemptInProgress())
            <x-alert-warning title="{{ __('You have a quiz attempt in progress.') }}" />
            <x-button class="mt-4" wire:click="startQuiz()">{{ __('Resume quiz') }}</x-button>
        @else
            <x-alert-info title="{{ __('You have no quiz attempts in progress.') }}" />
            @if($quiz->canStartAttempt())
                <x-button class="mt-4" wire:click="startQuiz()">{{ __('Start quiz') }}</x-button>
            @endif
        @endif
    @else
        <x-alert-warning title="{{ __('Quiz Attempt In Progress') }}">
            <p>{{ __('You can leave this quiz and come back later if you need. Leaving the quiz will not stop the time limit if present. If the time limit expires, you will be unable to complete further questions or edit previous responses, and will only be able to submit the quiz as-is.') }}</p>
        </x-alert-warning>
        <ul @can('update', $quiz) wire:sortable="updateElementOrder" @endcan>
            @foreach($elements->sortBy('order') as $element)
                <li @can('update', $quiz) wire:sortable.item="{{ get_class($element) }}#{{ $element->id }}" wire:key="ELM-C-{{ get_class($element).'-E-'.$element->id }}" @endcan>
                    <x-panel class="mb-6">
                        <x-slot name="header">
                            <x-header>
                                <x-slot name="title">
                                    @cannot('update', $element)
                                        <span class="mr-2">
                                            @livewire('checkoff', ['model' => $element], key('CHK-C-'.get_class($element).'-E-'.$element->id))
                                        </span>
                                    @endcannot
                                    @can('update', $element)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="cursor-move inline h-6 w-6 mb-0.5" wire:sortable.handle fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                        </svg>
                                    @endcan
                                    @if(strtolower(class_basename($element)) === 'video')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                    @if(strtolower(class_basename($element)) === 'zoommeeting')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @endif
                                    @if(strtolower(class_basename($element)) === 'link')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    @endif
                                    @if(strtolower(class_basename($element)) === 'file')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    @endif
                                    @if(strtolower(class_basename($element)) === 'book')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    @endif
                                    @if(strtolower(class_basename($element)) === 'assignment')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                    @endif
                                    @if(strtolower(class_basename($element)) === 'quiz')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                        </svg>
                                    @endif
                                    @if(strtolower(class_basename($element)) === 'forum')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                        </svg>
                                    @endif
                                    @include('partials/name-with-visibility-indicator', ['model' => $element])
                                </x-slot>
                                <div class="flex space-x-2">
                                    @if(strtolower(class_basename($element)) !== "textblock")
                                        <x-button href="#">
                                            {{ __('Open') }}
                                        </x-button>
                                    @endif
                                    @can('update', $element)
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
                                                <x-dropdown-link href="{{ route(strtolower(class_basename($element)).'.edit', ['element' => $element]) }}">
                                                    {{ __('Edit or Delete') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link href="{{ route('element.move', ['course' => $element->quiz->section->course, 'class' => class_basename($element), 'id' => $element->id]) }}">
                                                    {{ __('Move') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link href="{{ route('element.duplicate', ['course' => $element->quiz->section->course, 'class' => class_basename($element), 'id' => $element->id]) }}">
                                                    {{ __('Duplicate') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link href="#">
                                                    {{ __('Hide / Show') }}
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown>
                                    @endcan
                                </div>
                            </x-header>
                        </x-slot>
                        @if($element->due)
                            @if(class_basename($element) === 'ZoomMeeting')
                                <?php
                                $adjective = 'takes';
                                if($element->due->isPast()) $adjective = 'took';
                                $title = __('Meeting ').$adjective.__(' place ').$element->due->diffForHumans().__(' on ').$element->due->format('l, F jS, Y').__(' at ').$element->due->format('H:i').__(' UTC');
                                ?>
                                <x-alert-info title="{{ $title }}" class="mb-4">
                                </x-alert-info>
                            @else
                                @if($element->show_due_date)
                                    @if($element->due->isPast())
                                        @if(!$element->hasSubmittedFile(student(), \Illuminate\Support\Facades\Auth::user()))
                                            <x-alert-warning title="{{ __('Due ').$element->due->diffForHumans().__(' on ').$element->due->format('l, F jS, Y').__(' at ').$element->due->format('H:i').__(' UTC') }}" class="mb-4">
                                                @if($element->allow_late_submissions)
                                                    {{ __('Late submissions are accepted with possible penalties.') }}
                                                @else
                                                    {{ __('Late submissions are not accepted without a waiver.') }}
                                                @endif
                                            </x-alert-warning>
                                        @endif
                                    @else
                                        @if(!$element->hasSubmittedFile(student(), \Illuminate\Support\Facades\Auth::user()))
                                            <x-alert-info title="{{ __('Due ').$element->due->diffForHumans().__(' on ').$element->due->format('l, F jS, Y').__(' at ').$element->due->format('H:i').__(' UTC') }}" class="mb-4">
                                                @if($element->allow_late_submissions)
                                                    {{ __('Late submissions are accepted with possible penalties.') }}
                                                @else
                                                    {{ __('Late submissions are not accepted without a waiver.') }}
                                                @endif
                                            </x-alert-info>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                        @if(strtolower(class_basename($element)) === 'forum')
                            @if($element->open == false)
                                <x-alert-warning title="{{ __('Forum closed') }}" class="mb-4">
                                    {{ __('You can read forum posts, but cannot reply or create new posts.') }}
                                </x-alert-warning>
                            @endif
                        @endif
                        <div class="prose">
                            {!! $element->summary !!}
                        </div>
                    </x-panel>
                </li>
            @endforeach
        </ul>
        @foreach($elements as $element)
            @php
                dump($element);
            @endphp
            <x-panel class="mt-4">
                <x-slot name="header">
                    <x-header title="{{ $element->name }}" />
                </x-slot>
                <p class="mb-4">{!! $element->summary !!}</p>
            </x-panel>
        @endforeach
        <x-panel class="mt-4">
            <x-slot name="header">
                <x-header title="{{ __('Question 1') }}" />
            </x-slot>
            <p class="mb-4">{{ __('Is faith, hope, or charity the most important virtue?') }}</p>
        </x-panel>
        <x-button class="mt-4" wire:click="submitQuiz()">{{ __('Submit quiz') }}</x-button>
    @endif
</div>

<div>
    <?php $quizSubmission = $element; ?>
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
                                    @include('partials/name-with-visibility-indicator', ['model' => $element])
                                </x-slot>
                                <div class="flex space-x-2">
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
                                            </x-slot>
                                        </x-dropdown>
                                    @endcan
                                </div>
                            </x-header>
                        </x-slot>
                        <div class="prose">
                            {!! $element->summary !!}
                        </div>
                        @if(class_basename($element) === 'QuizTrueFalseQuestion')
                            @livewire('edit-quiz-true-false-question-form', ['quizTrueFalseQuestion' => $element, 'quizSubmission' => $quizSubmission], key('TF-'.$element->id))
                        @endif
                        @if(class_basename($element) === 'QuizMultipleChoiceQuestion')
                            @livewire('edit-quiz-multiple-choice-form', ['quizMultipleChoiceQuestion' => $element, 'quizSubmission' => $quizSubmission], key('MC-'.$element->id))
                        @endif
                    </x-panel>
                </li>
            @endforeach
        </ul>
        <x-button class="mt-4" wire:click="submitQuiz()">{{ __('Submit quiz') }}</x-button>
    @endif
</div>

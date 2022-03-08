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
        <x-panel class="mt-4">
            <x-slot name="header">
                <x-header title="{{ __('Question 1') }}" />
            </x-slot>
            <p class="mb-4">{{ __('Is faith, hope, or charity the most important virtue?') }}</p>
        </x-panel>
        <x-button class="mt-4" wire:click="submitQuiz()">{{ __('Submit quiz') }}</x-button>
    @endif
</div>

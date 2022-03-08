<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-panel class="mb-6">
                <a class="text-green-700 font-semibold" href="{{ route('quiz.all', $element->quiz) }}">&larr; {{ __('Back to quiz') }}</a>
            </x-panel>
            @livewire('grader', ['element' => $element])
        </div>
        <div class="col-span-2 h-fit">
            <x-panel class="mb-6">
                <x-slot name="header">
                    <x-header>
                        <x-slot name="title">
                            {{ __('Quiz Submission') }}
                        </x-slot>
                        <!--
                        <x-secondary-button disabled>&larr; {{ __('Prev') }}</x-secondary-button>
                        <x-button disabled>{{ __('Next') }} &rarr;</x-button>
                        -->
                        <x-button href="{{ \Illuminate\Support\Facades\Storage::url($element->file) }}">&darr; {{ __('Download') }}</x-button>
                    </x-header>
                </x-slot>
                <p>{{ __('File Universally Unique Identifier (UUID) name:') }}</p>
                <p>{{ $element->file }}</p>
                <p class="mt-4">{{ __('User / Student:') }}</p>
                @if($element->user_id)
                    <p>{{ $element->user->name }}</p>
                @else
                    <p>{{ $element->student->name }}</p>
                @endif
                <p class="mt-4">{{ __('Date / Time:') }}</p>
                <p>{{ $element->created_at->format('m/d/Y').__(' ').$element->created_at->format('h:i:s').__(' UTC') }}</p>
                @if($element->quiz->due)
                    @if($element->quiz->show_due_date)
                        <p class="mt-4">{{ __('Quiz Due:') }}</p>
                        <p>{{ $element->quiz->due }}</p>
                        @if($element->quiz->due < $element->created_at)
                            <p class="mt-4 text-danger-700 font-semibold">{{ __('This quiz was submitted late.') }}</p>
                        @else
                            <p class="mt-4 text-green-700 font-semibold">{{ __('This quiz was submitted on time.') }}</p>
                        @endif
                    @endif
                @endif
            </x-panel>
        </div>
    </div>
</x-app-layout>

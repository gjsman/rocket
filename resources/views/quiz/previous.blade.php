<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-element-back-button :element="$element" />
            <x-panel class="mb-6">
                <nav class="space-y-1" aria-label="{{ __('Sidebar') }}">
                    <x-sidebar-item href="{{ route('quiz', ['element' => $element]) }}" :active="false">
                        {{ __('New Submission') }}
                    </x-sidebar-item>
                    <x-sidebar-item href="{{ route('quiz.previous', ['element' => $element]) }}" :active="true">
                        {{ __('Previous Submissions') }}
                    </x-sidebar-item>
                    @can('update', $element)
                        <x-sidebar-item href="{{ route('quiz.all', ['element' => $element]) }}" :active="false">
                            {{ __('All Submissions') }}
                        </x-sidebar-item>
                    @endcan
                </nav>
            </x-panel>
        </div>
        <div class="col-span-2 h-fit">
            <x-panel>
                <x-slot name="header">
                    <x-header title="{{ __('Previous Submissions') }}" />
                </x-slot>
                <nav class="space-y-1" aria-label="{{ __('Previous Submissions') }}">
                    @foreach($submissions->sortByDesc('created_at') as $key => $submission)
                        <x-sidebar-item href="{{ \Illuminate\Support\Facades\Storage::url($submission->file) }}">{{ __('Submission #').$key+1 }} {{ __(' from ').$submission->created_at->format('l, F jS, Y').__(' at ').$submission->created_at->format('H:i').__(' UTC') }}</x-sidebar-item>
                    @endforeach
                </nav>
            </x-panel>
        </div>
    </div>
</x-app-layout>

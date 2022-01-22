<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-element-back-button :element="$element" />
            <x-panel class="mb-6">
                <nav class="space-y-1" aria-label="Sidebar">
                    <x-sidebar-item href="{{ route('assignment', ['element' => $element]) }}" :active="true">
                        {{ __('New Submission') }}
                    </x-sidebar-item>
                    <x-sidebar-item href="{{ route('assignment.previous', ['element' => $element]) }}" :active="false">
                        {{ __('Previous Submissions') }}
                    </x-sidebar-item>
                    @can('update', $element)
                        <x-sidebar-item href="{{ route('assignment.all', ['element' => $element]) }}" :active="false">
                            {{ __('All Submissions') }}
                        </x-sidebar-item>
                    @endcan
                </nav>
            </x-panel>
        </div>
        <div class="col-span-2 h-fit">
            <x-panel>
                <x-slot name="header">
                    <x-header title="{{ __('New Submission') }}" />
                </x-slot>
                @if($element->due)
                    @if($element->show_due_date)
                        @if($element->due->isPast())
                            <x-alert-warning title="{{ __('Due ').$element->due->diffForHumans().__(' on ').$element->due->format('l, F jS, Y').__(' at ').$element->due->format('H:i').__(' UTC') }}" class="mb-4">
                                @if($element->allow_late_submissions)
                                    {{ __('Late submissions are accepted with possible penalties.') }}
                                @else
                                    {{ __('Late submissions are not accepted without a waiver.') }}
                                @endif
                            </x-alert-warning>
                            @if($element->allow_late_submissions)
                                @livewire('edit-assignment-submission', ['assignment' => $element])
                            @endif
                        @else
                            <x-alert-info title="{{ __('Due ').$element->due->diffForHumans().__(' on ').$element->due->format('l, F jS, Y').__(' at ').$element->due->format('H:i').__(' UTC') }}" class="mb-4">
                                @if($element->allow_late_submissions)
                                    {{ __('Late submissions are accepted with possible penalties.') }}
                                @else
                                    {{ __('Late submissions are not accepted without a waiver.') }}
                                @endif
                            </x-alert-info>
                            @livewire('edit-assignment-submission', ['assignment' => $element])
                        @endif
                    @else
                        @livewire('edit-assignment-submission', ['assignment' => $element])
                    @endif
                @else
                    @livewire('edit-assignment-submission', ['assignment' => $element])
                @endif
            </x-panel>
        </div>
    </div>
</x-app-layout>

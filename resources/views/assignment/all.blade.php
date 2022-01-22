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
            <x-panel>
                <x-slot name="header">
                    <x-header title="{{ __('All Submissions') }}" />
                </x-slot>
                <p>{{ __('Feature not present') }}</p>
            </x-panel>
        </div>
    </div>
</x-app-layout>

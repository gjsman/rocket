<div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
    <x-panel class="col-span-1 h-fit">
        <x-slot name="header">
            <x-header title="{{ __('Navigation') }}" />
        </x-slot>
        <x-list>
            <x-list-clickable-item :compact="true" :active="request()->routeIs('admin')" href="{{ route('admin') }}" title="Home" />
            <x-list-clickable-item :compact="true" :active="request()->routeIs('admin.courses')" href="{{ route('admin.courses') }}" title="Courses" />
            <x-list-clickable-item :compact="true" :active="request()->routeIs('admin.instructors')" href="{{ route('admin.instructors') }}" title="Instructors" />
        </x-list>
    </x-panel>
    <x-panel class="col-span-2 mt-8 md:mt-0 h-fit">
        <x-slot name="header">
            {{ $header }}
        </x-slot>
        <x-slot name="override">
            {{ $slot }}
        </x-slot>
    </x-panel>
</div>

<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <x-panel class="col-span-1 h-fit">
            <x-slot name="header">
                <x-header title="{{ __('Filters') }}" />
            </x-slot>
            <div class="-mt-1">
                <x-label for="instructorName" value="{{ __('Search for instructor') }}" />
                <x-input id="instructorName" type="text" class="mt-1 block w-full" autofocus wire:model="search" />
                <x-input-error for="instructorName" class="mt-2" />
            </div>
        </x-panel>
        <x-panel class="col-span-2 mt-8 md:mt-0">
            <x-slot name="header">
                @if($search)
                    <x-header title="{{ __('Search for ').$search }}" />
                @else
                    <x-header title="{{ __('Instructors') }}" />
                @endif
            </x-slot>
            <x-slot name="override">
                <x-list>
                    @foreach($instructors as $instructor)
                        <x-list-clickable-item href="{{ route('instructor', ['instructor' => $instructor]) }}" title="{{ $instructor->name }}" />
                    @endforeach
                </x-list>
            </x-slot>
            {{ $instructors->links() }}
        </x-panel>
    </div>
</div>

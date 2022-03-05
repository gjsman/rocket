<x-panel>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-slot name="header">
        <x-header title="{{ __('Grade') }}" />
    </x-slot>
    <p class="mb-2">{{ __('Current grade') }}: @if($element->grade === null) {{ __('Unassigned') }} @else {{ $element->grade->value.__(' / ').$element->grade->base }} @endif</p>
    <p class="mb-2">{{ __('Maximum grade: 125 / 100') }}</p>
    <p>
        {{ __('New grade: ') }}
    <x-input wire:model="score" class="inline" onclick="this.select()" type="number" id="score" name="score" style="max-width: 75px;" />
        / 100
    </p>
    <x-button wire:click="save()" class="mt-4" wire:loading.attr="disabled">{{ __('Save') }}</x-button>
    @if($element->grade !== null)
        <x-secondary-button wire:click="unset()" wire:loading.attr="disabled" class="mt-4">{{ __('Unset') }}</x-secondary-button>
    @endif
</x-panel>

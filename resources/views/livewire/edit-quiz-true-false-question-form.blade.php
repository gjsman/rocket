<div>
    <p>
        @if($selected === true)
            <x-button wire:click="setSelection(true)" class="bg-blue-500 hover:bg-blue-600">True</x-button>
        @else
            <x-button wire:click="setSelection(true)">True</x-button>
        @endif
        @if($selected === false)
            <x-button wire:click="setSelection(false)" class="bg-blue-500 hover:bg-blue-600">False</x-button>
        @else
            <x-button wire:click="setSelection(false)">False</x-button>
        @endif
    </p>
</div>

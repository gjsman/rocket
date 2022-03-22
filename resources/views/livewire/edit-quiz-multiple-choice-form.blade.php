<div>
    <p class="mt-4">
        @if($quizMultipleChoiceQuestion->choice1 !== null)
            @if($selected === 1)
                <x-button wire:click="setSelection(1)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice1 }}</x-button>
            @else
                <x-button wire:click="setSelection(1)">{{ $quizMultipleChoiceQuestion->choice1 }}</x-button>
            @endif
        @endif
        @if($quizMultipleChoiceQuestion->choice2 !== null)
            @if($selected === 2)
                <x-button wire:click="setSelection(2)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice2 }}</x-button>
            @else
                <x-button wire:click="setSelection(2)">{{ $quizMultipleChoiceQuestion->choice2 }}</x-button>
            @endif
        @endif
        @if($quizMultipleChoiceQuestion->choice3 !== null)
            @if($selected === 3)
                <x-button wire:click="setSelection(3)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice3 }}</x-button>
            @else
                <x-button wire:click="setSelection(3)">{{ $quizMultipleChoiceQuestion->choice3 }}</x-button>
            @endif
        @endif
        @if($quizMultipleChoiceQuestion->choice4 !== null)
            @if($selected === 4)
                <x-button wire:click="setSelection(4)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice4 }}</x-button>
            @else
                <x-button wire:click="setSelection(4)">{{ $quizMultipleChoiceQuestion->choice4 }}</x-button>
            @endif
        @endif
        @if($quizMultipleChoiceQuestion->choice5 !== null)
            @if($selected === 5)
                <x-button wire:click="setSelection(5)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice5 }}</x-button>
            @else
                <x-button wire:click="setSelection(5)">{{ $quizMultipleChoiceQuestion->choice5 }}</x-button>
            @endif
        @endif
        @if($quizMultipleChoiceQuestion->choice6 !== null)
            @if($selected === 6)
                <x-button wire:click="setSelection(6)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice6 }}</x-button>
            @else
                <x-button wire:click="setSelection(6)">{{ $quizMultipleChoiceQuestion->choice6 }}</x-button>
            @endif
        @endif
        @if($quizMultipleChoiceQuestion->choice7 !== null)
            @if($selected === 7)
                <x-button wire:click="setSelection(7)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice7 }}</x-button>
            @else
                <x-button wire:click="setSelection(7)">{{ $quizMultipleChoiceQuestion->choice7 }}</x-button>
            @endif
        @endif
        @if($quizMultipleChoiceQuestion->choice8 !== null)
            @if($selected === 8)
                <x-button wire:click="setSelection(8)" class="bg-blue-500 hover:bg-blue-600">{{ $quizMultipleChoiceQuestion->choice8 }}</x-button>
            @else
                <x-button wire:click="setSelection(8)">{{ $quizMultipleChoiceQuestion->choice8 }}</x-button>
            @endif
        @endif
    </p>
</div>

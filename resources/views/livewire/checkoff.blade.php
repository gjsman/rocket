<div class="d-inline-block">
    {{-- Do your work, then step back. --}}
    @if($button)
        @if($checked)
            <button type="button" wire:click="$set('checked', false)">
                <span wire:loading.remove>
                    <svg class="h-4 pr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Marked as complete') }}
                </span>
                <span wire:loading>
                    <svg class="h-4 pr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('Marking as incomplete...') }}
                </span>
            </button>
        @else
            <button type="button" wire:click="$set('checked', true)">
                <span wire:loading.remove>
                    <svg class="h-4 pr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Mark as complete') }}
                </span>
                <span wire:loading>
                     <svg class="h-4 pr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>
                     {{ __('Marking as complete...') }}
                </span>
            </button>
        @endif
    @else
        {{-- Care about people's approval and you will be their prisoner. --}}
        <input type="checkbox" wire:model="checked" class="cursor-default" />
    @endif
</div>

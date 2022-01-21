<form wire:submit.prevent="submit">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{ $this->form }}


    <div class="mt-6 h-10">
        <div class="clearfix">
            @if($section)
                <div class="float-left">
                    <x-danger-button href="{{ route('section.delete', ['section' => $section]) }}">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            @endif
            <div class="float-right">
                <div class="flex space-x-2">
                    @if($section)
                        <x-secondary-button href="{{ route('course.location', ['course' => $section->course, 'location' => $section->id]) }}">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    @endif
                    <x-button type="submit">
                        {{ __('Save') }}
                    </x-button>
                </div>

            </div>
        </div>
    </div>
</form>

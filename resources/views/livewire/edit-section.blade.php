<form wire:submit.prevent="submit">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{ $this->form }}

    <div class="mt-6 h-10">
        <div class="clearfix">
            @if(isset($section))
                <div class="float-left">
                    <x-danger-button href="{{ route('section.delete', ['section' => $section]) }}">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            @endif
            <div class="float-right">
                <div class="flex space-x-2">
                    @if(isset($section))
                        <x-secondary-button href="{{ route('course.location', ['course' => $section->course, 'location' => $section->id]) }}">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    @elseif(isset($element))
                        @if(strtolower(class_basename($element)) === 'course')
                            <x-secondary-button href="{{ route('course', ['course' => $element]) }}">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                        @endif
                    @endif
                    <x-button type="submit">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</form>

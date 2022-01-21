<form wire:submit.prevent="submit">
    {{-- In work, do what you enjoy. --}}
    {{ $this->form }}

    <div class="mt-6 h-9">
        <div class="clearfix">
            @if($element)
                <div class="float-left">
                    <x-danger-button href="{{ route(strtolower(class_basename($element)).'.delete', ['element' => $element]) }}">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>
            @endif
            <div class="float-right">
                <div class="flex space-x-2">
                    @if($element)
                        <x-secondary-button href="{{ route('course.location', ['course' => $element->section->course, 'location' => $element->section->id]) }}">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    @else
                        <x-secondary-button href="{{ route('course', ['course' => $section->course]) }}">
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
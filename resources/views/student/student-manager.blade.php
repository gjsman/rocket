<div>
    <!-- Create Student -->
    <x-form-section submit="createStudent">
        <x-slot name="title">
            {{ __('Create Student') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Students allow you to keep grades, courses, and other information separated.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Student Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="createStudentForm.name" autofocus />
                <x-input-error for="name" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="created">
                {{ __('Created.') }}
            </x-action-message>

            <x-button>
                {{ __('Create') }}
            </x-button>
        </x-slot>
    </x-form-section>

    @if ($this->user->students->isNotEmpty())
        <x-section-border />

        <!-- Manage Students -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Manage Students') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('You may edit or archive any of your existing students if they are no longer needed.') }}
                </x-slot>

                <!-- Students List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->students->sortBy('name') as $student)
                            <div class="flex items-center justify-between">
                                <div>
                                    {{ $student->name }}
                                </div>

                                <div class="flex items-center">
                                    <div class="text-sm text-gray-400">
                                        {{ __('Created') }} {{ $student->created_at->diffForHumans() }}
                                    </div>

                                    @if($student->active)
                                        <button class="cursor-pointer ml-6 text-sm text-red-500" wire:click="confirmStudentArchival({{ $student->id }})">
                                            {{ __('Archive') }}
                                        </button>
                                    @elseif(!$student->active)
                                        <button class="cursor-pointer ml-6 text-sm text-emerald-500" wire:click="confirmStudentArchival({{ $student->id }})">
                                            {{ __('Restore') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    <!-- Archive Student Confirmation Modal -->
    <x-confirmation-modal wire:model="confirmingStudentArchival">
        @if($studentIsActive)
            <x-slot name="title">
                {{ __('Archive Student') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you would like to archive this student?') }}
            </x-slot>
        @else
            <x-slot name="title">
                {{ __('Restore Student') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you would like to restore this student?') }}
            </x-slot>
        @endif

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingStudentArchival')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if($studentIsActive)
                <x-danger-button class="ml-3" wire:click="archiveStudent" wire:loading.attr="disabled">
                    {{ __('Archive') }}
                </x-danger-button>
            @else
                <x-button class="ml-3" wire:click="archiveStudent" wire:loading.attr="disabled">
                    {{ __('Restore') }}
                </x-button>
            @endif
        </x-slot>
    </x-confirmation-modal>
</div>

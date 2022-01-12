<div>
    {{-- Stop trying to control. --}}
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <x-panel class="col-span-1 h-fit">
            <x-slot name="header">
                <x-header title="{{ __('Filters') }}" />
            </x-slot>
            <x-slot name="override">
                <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200">
                    <x-label for="courseName" value="{{ __('Search for course') }}" />
                    <x-input id="courseName" type="text" class="mt-1 block w-full" autofocus wire:model="search" />
                    <x-input-error for="courseName" class="mt-2" />
                </div>
            </x-slot>
            <div id="courseType" class="mb-4">
                <x-label for="courseType" value="{{ __('Type') }}" />
                <x-select id="courseType" type="text" class="mt-1 block w-full" wire:model="courseType" wire:key="courseType">
                    <option value="0">{{ __('All Types') }}</option>
                    <option value="1">{{ __('Live Courses') }}</option>
                    <option value="2">{{ __('Unlimited Access Courses') }}</option>
                </x-select>
                <x-input-error for="courseType" class="mt-2" />
            </div>
            <div id="courseDifficulty" class="mb-4">
                <x-label for="courseDifficulty" value="{{ __('Difficulty level') }}" />
                <x-select id="courseDifficulty" type="text" class="mt-1 block w-full" wire:model="courseDifficulty" wire:key="courseDifficulty">
                    <option value="0">{{ __('All Levels') }}</option>
                    <option value="1">{{ __('Elementary School') }}</option>
                    <option value="2">{{ __('Middle School') }}</option>
                    <option value="3">{{ __('High School') }}</option>
                    <option value="4">{{ __('Adult Courses') }}</option>
                </x-select>
                <x-input-error for="courseDifficulty" class="mt-2" />
            </div>
            <div id="courseCategory">
                <x-label for="courseCategory" value="{{ __('Category') }}" />
                <x-select id="courseCategory" type="text" class="mt-1 block w-full" wire:model="courseCategory" wire:key="courseCategory">
                    <option value="0">{{ __('All Categories') }}</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="courseCategory" class="mt-2" />
            </div>
        </x-panel>
        <x-panel class="col-span-2 mt-8 md:mt-0">
            <x-slot name="header">
                @if($search)
                    <x-header title="{{ __('Search for ').$search }}" />
                @else
                    <x-header title="{{ __('Available courses') }}" />
                @endif
            </x-slot>
            <x-slot name="override">
                <x-list>
                    @foreach($courses as $course)
                        <x-list-clickable-course :course="$course" />
                    @endforeach
                </x-list>
            </x-slot>
            {{ $courses->links() }}
        </x-panel>
    </div>
</div>

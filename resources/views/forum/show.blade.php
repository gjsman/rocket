<x-app-layout>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-element-back-button :element="$element" />
        </div>
        <div class="col-span-2 h-fit">
            <x-panel>
                <p>{{ __('Feature not present') }}</p>
            </x-panel>
        </div>
    </div>
</x-app-layout>

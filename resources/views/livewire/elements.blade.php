<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <ul @can('update', $section) wire:sortable="updateElementOrder" @endcan>
        @foreach($elements->sortBy('order') as $element)
            <li @can('update', $section) wire:sortable.item="{{ get_class($element) }}#{{ $element->id }}" wire:key="ELM-C-{{ get_class($element).'-E-'.$element->id }}" @endcan>
                <x-element-item :element="$element" />
            </li>
        @endforeach
    </ul>
</div>

@props(['active' => false, 'href'])

@php
if ($active) {
    $classes = 'bg-gray-100 text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md';
} else {
    $classes = 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md';
}
@endphp

<a {{ $attributes->merge(['href' => $href, 'class' => $classes]) }}>
    <span class="truncate">
        {{ $slot }}
    </span>
</a>

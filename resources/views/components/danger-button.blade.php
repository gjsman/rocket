@props(['href' => null])

@php
    $classes = 'inline-flex items-center px-4 py-2 shadow-sm text-sm font-medium rounded-md text-white bg-red-600 active:bg-red-600 hover:bg-red-500 focus:outline-none focus:ring-2 disabled:opacity-25 focus:ring-offset-2 focus:ring-red-200 transition uppercase';
@endphp

@if($href)
    <a {{ $attributes->merge(['href' => $href, 'class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif

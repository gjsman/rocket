@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-green-400 text-sm font-medium leading-5 text-white focus:outline-none focus:border-green-700 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-emerald-100 hover:border-emerald-300 focus:outline-none focus:text-emerald-300 focus:border-emerald-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

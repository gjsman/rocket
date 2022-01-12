@props(['href' => null, 'title' => null, 'badge' => null, 'compact' => false, 'active' => false])

@php
if($active) {
    $classes = 'block hover:bg-gray-50 bg-emerald-100 hover:bg-emerald-200 transition';
} else {
    $classes = 'block hover:bg-gray-50';
}
@endphp

<li>
    <a {{ $attributes->merge(['href' => $href, 'class' => $classes ]) }}>
        <div class="@if($compact) px-2 py-2 sm:px-4 @else px-4 py-4 sm:px-6 @endif">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-emerald-600 truncate">
                    {{ $title }}
                </p>
                @if($badge)
                    <div class="ml-2 flex-shrink-0 flex">
                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $badge }}
                        </p>
                    </div>
                @endif
            </div>
            @if($slot)
                <div>
                    {{ $slot }}
                </div>
            @endif
            @if(isset($footerLeftIcons) || isset($footerRightIcons))
                <div class="mt-2 sm:flex sm:justify-between">
                    @if(isset($footerLeftIcons))
                        <div class="sm:flex">
                            {{ $footerLeftIcons }}
                        </div>
                    @endif
                    @if(isset($footerRightIcons))
                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                            {{ $footerRightIcons }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </a>
</li>

<!--
<p class="flex items-center text-sm text-gray-500">
<svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
</svg>
Engineering
</p>
<p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
<svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
</svg>
Remote
</p>
-->

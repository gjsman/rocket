@props(['fixSpacing' => false, 'title' => null])

<p class="flex items-center text-sm text-gray-500 @if($fixSpacing) sm:mt-0 sm:ml-6 @endif">
    {{ $slot }}
    {{ $title }}
</p>

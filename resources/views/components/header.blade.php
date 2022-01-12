@props(['title' => null, 'list' => false])

@if($list)
<li>
@endif
    <div class="bg-white px-4 py-5 sm:px-6 @if(!$list) border-b border-gray-200 @endif">
        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $title }}
                </h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                {{ $slot }}
            </div>
        </div>
    </div>
@if($list)
</li>
@endif

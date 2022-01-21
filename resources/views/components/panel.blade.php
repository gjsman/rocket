<div {!! $attributes->merge(['class' => 'bg-white overflow-visible shadow rounded-none sm:rounded-lg']) !!}>
    @if(isset($header))
        {{ $header }}
    @endif
    @if(isset($override))
        {{ $override }}
    @endif
    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>
</div>

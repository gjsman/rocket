<x-app-layout>
    <x-panel class="mb-8">
        <a class="text-green-700 font-semibold" href="{{ \Illuminate\Support\Facades\URL::previous() }}">&larr; {{ __('Back to course') }}</a>
    </x-panel>
    <x-panel class="mb-8">
        @if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $element->url, $match))
            <div class="w-100 h-100">
                <iframe class="w-100" width="640" height="360" src="https://www.youtube.com/embed/{{ $match[1] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        @else
            <video class="w-100 h-100" controls>
                <source src="{{ $element->url }}" type="video/mp4">
                {{ __('Your browser does not support the video tag.') }}
            </video>
        @endif
    </x-panel>
    <x-panel>
        <x-slot name="header">
            <x-header>
                <x-slot name="title">
                    @include('partials/name-with-visibility-indicator', ['model' => $element])
                </x-slot>
            </x-header>
        </x-slot>
        <div class="prose">
            {!! $element->summary !!}
        </div>
    </x-panel>
</x-app-layout>

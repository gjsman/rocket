@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ \Illuminate\Support\Facades\URL::previous() }}" style="text-decoration: none;">&larr; {{ __('Back to course') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        @include('partials/name-with-visibility-indicator', ['object' => $video])
                    </div>
                    <div class="card-body">
                        @if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video->url, $match))
                            <div class="w-100 h-100">
                                <iframe class="w-100" width="640" height="360" src="https://www.youtube.com/embed/{{ $match[1] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @else
                            <video class="w-100 h-100" controls>
                                <source src="{{ $video->url }}" type="video/mp4">
                                {{ __('Your browser does not support the video tag.') }}
                            </video>
                        @endif
                    </div>
                    @if($video->summary)
                        <div class="card-footer">
                            {!! $video->summary !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

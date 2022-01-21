@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-12 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                    <span class="align-middle">
                        @if (isset($video))
                            {{ __('Edit video from URL') }}
                        @else
                            {{ __('Add a new video from URL') }}
                        @endif
                    </span>
                    </div>
                    <div class="card-body">
                        @if(isset($video))
                            <form method="POST" action="{{ route('video.edit', ['video' => $video]) }}" id="form">
                                @else
                                    <form method="POST" action="{{ route('video.add', ['course' => $course, 'section' => $section]) }}" id="form">
                                        @endif
                                        @csrf
                                        <div class="form-group row mb-3">
                                            <label for="courseName" class="col-sm-2 col-form-label">{{ __('Course') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" readonly class="form-control" id="courseName" name="courseName" value="{{ $course->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="videoName" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                            <div class="col-sm-10">
                                                <?php
                                                $old = null;
                                                if(old('videoName')) {
                                                    $old = old('videoName');
                                                } else {
                                                    if(isset($video)) {
                                                        $old = $video->name;
                                                    }
                                                }
                                                ?>
                                                <input required type="text" class="@error('videoName') is-invalid @enderror form-control" id="videoName" name="videoName" placeholder="" value="{{ $old }}">
                                                @error('videoName')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="videoUrl" class="col-sm-2 col-form-label">{{ __('URL') }}</label>
                                            <div class="col-sm-10">
                                                <?php
                                                $old = null;
                                                if(old('videoUrl')) {
                                                    $old = old('videoUrl');
                                                } else {
                                                    if(isset($video)) {
                                                        $old = $video->url;
                                                    }
                                                }
                                                ?>
                                                <input type="text" class="@error('videoUrl') is-invalid @enderror form-control" id="videoUrl" name="videoUrl" placeholder="" value="{{ $old }}">
                                                @error('videoUrl')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="videoSummary" class="col-sm-2 col-form-label">{{ __('Summary') }}</label>
                                            <div class="col-sm-10">
                                                @if(isset($video))
                                                    @trix($video, 'summary')
                                                @else
                                                    @trix(\App\Models\VideoFromUrl::class, 'summary')
                                                @endif
                                                @error('videoSummary')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">{{ __('Visibility') }}</div>
                                            <div class="col-sm-10">
                                                <?php
                                                $checked = true;
                                                if(old('videoVisible')) {
                                                    $checked = old('videoVisible') === 'on';
                                                } else {
                                                    if(isset($video)) {
                                                        $checked = $video->visible;
                                                    }
                                                }
                                                ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="videoVisible" name="videoVisible" @if($checked) checked @endif>
                                                    <label class="form-check-label" for="videoVisible">
                                                        {{ __('Make this video publicly visible') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                    </div>
                    <div class="card-footer">
                        @if(isset($video))
                            <a class="btn btn-danger" href="{{ route('video.delete', ['video' => $video]) }}">{{ __('Delete video') }}</a>
                        @endif
                        <span class="float-end">
                        <a class="btn btn-secondary" href="{{ \Illuminate\Support\Facades\URL::previous() }}">{{ __('Cancel') }}</a>
                        <button type="submit" onclick="document.getElementById('form').submit();" class="btn btn-success">
                            @if(isset($video))
                                {{ __('Edit video') }}
                            @else
                                {{ __('Add this new video') }}
                            @endif
                        </button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($video))
        @if (!$errors->any())
            @include('partials/trix-js-content-workaround', ['object' => $video])
        @endif
    @endif
@endsection

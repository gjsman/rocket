<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }}
        </h2>
    </x-slot>
    <div class="md:grid grid-cols-1 md:grid-cols-3 md:gap-6">
        <div class="col-span-1 h-fit">
            <x-panel class="mb-8">
                <a class="text-green-700 font-semibold" href="{{ \Illuminate\Support\Facades\URL::previous() }}">&larr; {{ __('Back to search') }}</a>
            </x-panel>
            <x-panel class="mb-8">
                <ul>
                    <li>{{ $course->name }}</li>
                    <li>{{ __('Taught by ').$course->instructor->name }}</li>
                    <li>{{ $course->typeName().__(' course for ').$course->difficultyName().' '.$course->category->name }}</li>
                    @if($course->type === 1)
                        <li>0 {{ __('seats remaining out of ').$course->seats }}</li>
                    @endif
                </ul>
            </x-panel>
            @if(\Illuminate\Support\Facades\Auth::check())
                @if((\Illuminate\Support\Facades\Auth::user()->rank >= 5) && !student())
                    <x-panel class="mb-8">
                        <h3 class="text-lg mb-2">{{ __('Admin Options') }}</h3>
                        <x-button href="{{ route('course', $course) }}">{{ __('Open course') }} &rarr;</x-button>
                    </x-panel>
                @endif
            @endif
            <x-panel class="mb-8">
                <h3 class="text-lg mb-2">{{ __('Enrollment Options') }}</h3>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if($course->type === 1)
                        <p>{{ __('This live course costs $0.00.') }}</p>
                    @elseif($course->type === 2)
                        @if(\Illuminate\Support\Facades\Auth::user()->sparkPlan())
                            @if(student())
                                <p class="mb-4">{{ __('Enroll in the course') }}</p>
                                <x-button :href="route('course.enroll', ['course' => $course, 'student' => student()])">{{ __('Enroll myself') }}</x-button>
                                <p class="mt-4 mb-4">{{ __('Enroll a different student') }}</p>
                                <ul>
                                    @foreach(\Illuminate\Support\Facades\Auth::user()->students as $student)
                                        @if($student->id !== student()->id)
                                            <li>
                                                <x-button :class="($loop->last) ? 'mb-0' : 'mb-4'" :href="route('course.enroll', ['course' => $course, 'student' => $student])">{{ __('Enroll ').$student->name }}</x-button>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <p class="mb-4">{{ __('Enroll a student') }}</p>
                                <ul>
                                    @foreach(\Illuminate\Support\Facades\Auth::user()->students as $student)
                                        <li>
                                            <x-button :class="($loop->last) ? 'mb-0' : 'mb-4'" :href="route('course.enroll', ['course' => $course, 'student' => $student])">{{ __('Enroll ').$student->name }}</x-button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @else
                            <p class="mb-4">{{ __('You must be subscribed to take this course.') }}</p>
                            <x-button href="{{ url('/subscription') }}">{{ __('Subscribe') }}</x-button>
                        @endif
                    @endif
                @else
                    <p class="mb-4">{{ __('You must log in or register to take this course.') }}</p>
                    <p>
                        <x-secondary-button href="{{ url('/login') }}">{{ __('Login') }}</x-secondary-button>
                        <x-secondary-button href="{{ url('/register') }}">{{ __('Register') }}</x-secondary-button>
                    </p>
                @endif
            </x-panel>
            @if($course->type === 1)
                <x-panel class="mb-8">
                    <h3 class="text-lg mb-2">{{ __('Live Course Refunds') }}</h3>
                    <ul class="list-disc list-inside">
                        <li>95% of the course fee is refunded for cancellations that are made up to one month before the first day of class.</li>
                        <li>85% of the course fee is refunded for cancellations up to two weeks before the first class.</li>
                        <li>75% of the course fee is refunded for cancellations between two weeks before the start date and up to the first day of the third week of class.</li>
                    </ul>
                </x-panel>
            @endif
        </div>
        <div class="col-span-2 h-fit">
            <x-panel class="mb-8">
                <x-slot name="header">
                    <x-header title="{{ $course->name }}" />
                </x-slot>
                <div class="prose">
                    {!! $course->summary !!}
                </div>
            </x-panel>
            @if($course->instructor->summary)
                <x-panel class="mb-8">
                    <x-slot name="header">
                        <x-header title="{{ __('About the instructor, ').$course->instructor->name }}" />
                    </x-slot>
                    <div class="prose">
                        {!! $course->instructor->summary !!}
                    </div>
                </x-panel>
            @endif
        </div>
    </div>
</x-app-layout>

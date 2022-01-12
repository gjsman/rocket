<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(\Illuminate\Support\Facades\Auth::check())
        <x-panel class="mb-6 overflow-visible">
            <div class="max-w-3xl mx-auto md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl">
                <div class="flex items-center space-x-5">
                    <!--
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img class="h-16 w-16 rounded-full" src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=8&amp;w=1024&amp;h=1024&amp;q=80" alt="">
                            <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
                        </div>
                    </div>
                    -->
                    <div>
                        <p>{{ __('Welcome,') }}</p>
                        <h1 class="text-2xl font-bold text-gray-900">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h1>
                    </div>
                </div>
                <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                    <x-select-student :showStudentName="false" />
                </div>
            </div>
        </x-panel>
        <div class="md:grid grid-cols-1 md:grid-cols-2 md:gap-6 mb-8">
            <x-list class="col-span-1 h-fit mb-8 md:mb-0">
                <x-header title="{{ __('Live Courses') }}" :list="true">
                    <x-secondary-button>
                        {{ __('Shop for courses') }}
                    </x-secondary-button>
                </x-header>
                <?php
                    $courses = \App\Models\Course::inRandomOrder()->where('type', 1)->limit(3)->get();
                ?>
                @forelse($courses as $course)
                    <x-list-clickable-course :course="$course" :showSeats="false" :showType="false"></x-list-clickable-course>
                @empty
                    <x-list-clickable-item title="{{ __('No live courses') }}" href="{{ url('/shop?courseType=1') }}" badge="{{ __('Go to shop') }} →">
                        <x-slot name="footerLeftIcons">
                            <p class="text-sm">{{ __('You are not enrolled in any live courses.') }}</p>
                        </x-slot>
                    </x-list-clickable-item>
                @endforelse
            </x-list>
            <x-list class="col-span-1">
                <x-header title="{{ __('Recorded Courses') }}" :list="true">
                    <x-secondary-button>
                        {{ __('Manage subscription') }}
                    </x-secondary-button>
                </x-header>
                <?php
                    $courses = \App\Models\Course::inRandomOrder()->where('type', 2)->limit(3)->get();
                ?>
                @forelse($courses as $course)
                    <x-list-clickable-course :course="$course" :showSeats="false" :showType="false"></x-list-clickable-course>
                @empty
                    <x-list-clickable-item title="{{ __('No recorded courses') }}" href="{{ url('/shop?courseType=2') }}" badge="{{ __('Go to shop') }} →">
                        <x-slot name="footerLeftIcons">
                            <p class="text-sm">{{ __('You are not enrolled in any recorded courses.') }}</p>
                        </x-slot>
                    </x-list-clickable-item>
                @endforelse
            </x-list>
        </div>
    @else
        <x-panel>
            <h3 class="text-2xl font-semibold mb-3">{{ env('APP_NAME', 'Laravel') }}</h3>
            <p>{{ __('You are not logged in.') }}</p>
            <div class="mt-4">
                <x-button href="{{ url('/login') }}">{{ __('Login') }}</x-button>
                <x-secondary-button href="{{ url('/register') }}">{{ __('Register') }}</x-secondary-button>
            </div>
        </x-panel>
    @endif
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(\Illuminate\Support\Facades\Auth::check())
        <x-panel class="mb-6 overflow-visible">
            <div class="flex items-center justify-between space-x-5 max-w-7xl">
                <div class="flex items-center space-x-5">
                    <div>
                        <p>{{ __('Welcome,') }}</p>
                        <h1 class="text-2xl font-bold text-gray-900">
                            @if(student())
                                {{ student()->name }}
                            @else
                                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                            @endif
                        </h1>
                    </div>
                </div>
                <x-select-student :showStudentName="false" :showInMenu="false" />
            </div>
        </x-panel>
        @if(student())
            <div class="md:grid grid-cols-1 md:grid-cols-2 md:gap-6 mb-8">
                <x-list class="col-span-1 h-fit mb-8 md:mb-0">
                    <x-header title="{{ __('Live Courses') }}" :list="true">
                        <x-secondary-button href="{{ url('/shop?courseType=1') }}">
                            {{ __('Shop for live courses') }}
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
                        @if(\Illuminate\Support\Facades\Auth::user()->sparkPlan())
                            <x-secondary-button href="{{ url('/shop?courseType=2') }}">
                                {{ __('Shop for recorded courses') }}
                            </x-secondary-button>
                        @else
                            <x-secondary-button href="{{ url('/subscription') }}">
                                {{ __('Subscribe') }}
                            </x-secondary-button>
                        @endif
                    </x-header>
                    <?php
                        $courses = \App\Models\Course::inRandomOrder()->where('type', 2)->limit(3)->get();
                    ?>
                    @if(\Illuminate\Support\Facades\Auth::user()->sparkPlan())
                        @forelse($courses as $course)
                            <x-list-clickable-course :course="$course" :showSeats="false" :showType="false"></x-list-clickable-course>
                        @empty
                            <x-list-clickable-item title="{{ __('No recorded courses') }}" href="{{ url('/shop?courseType=2') }}" badge="{{ __('Go to shop') }} →">
                                <x-slot name="footerLeftIcons">
                                    <p class="text-sm">{{ __('You are not enrolled in any recorded courses.') }}</p>
                                </x-slot>
                            </x-list-clickable-item>
                        @endforelse
                    @else
                        <x-list-clickable-item title="{{ __('No Unlimited Access Subscription') }}" href="{{ url('/subscription') }}">
                            <x-slot name="footerLeftIcons">
                                <p class="text-sm">{{ __('You are not subscribed to Unlimited Access. Subscribe to Unlimited Access to gain access to hundreds of recorded courses from the best instructors.') }}</p>
                            </x-slot>
                        </x-list-clickable-item>
                    @endif
                </x-list>
            </div>
        @else
            <div class="md:grid grid-cols-1 md:grid-cols-2 md:gap-6 mb-8">
                <x-list class="col-span-1 h-fit mb-8 md:mb-0">
                    <x-header title="{{ __('Quick actions') }}" :list="true" />
                    @if(!\Illuminate\Support\Facades\Auth::user()->sparkPlan())
                        <x-list-clickable-item href="{{ url('/subscription') }}" title="{{ __('Subscribe to Unlimited Access →') }}">
                            <x-slot name="footerLeftIcons">
                                <p class="text-sm">{{ __('Hundreds of courses from the best instructors, for a low monthly fee.') }}</p>
                            </x-slot>
                        </x-list-clickable-item>
                    @endif
                    <x-list-clickable-item href="{{ route('shop') }}" title="{{ __('Shop for courses →') }}">
                        <x-slot name="footerLeftIcons">
                            <p class="text-sm">{{ __('Amazing courses from the best instructors, fully live and with grading.') }}</p>
                        </x-slot>
                    </x-list-clickable-item>
                    <x-list-clickable-item href="{{ route('students.manage') }}" title="{{ __('Manage students →') }}">
                        <x-slot name="footerLeftIcons">
                            <p class="text-sm">{{ __('Add or remove student profiles to keep information separated.') }}</p>
                        </x-slot>
                    </x-list-clickable-item>
                    <x-list-clickable-item href="{{ route('profile.show') }}" title="{{ __('Change account settings →') }}">
                        <x-slot name="footerLeftIcons">
                            <p class="text-sm">{{ __('Set up extra security, change your password, or manage your subscription.') }}</p>
                        </x-slot>
                    </x-list-clickable-item>
                </x-list>
                <x-list class="col-span-1">
                    <x-header title="{{ __('Select your name') }}" :list="true" />

                    @forelse(\Illuminate\Support\Facades\Auth::user()->students->where('active', true) as $student)
                        <x-list-clickable-item href="{{ route('student.set', $student) }}" title="{{ $student->name }}">
                            <x-slot name="footerLeftIcons">
                                <p class="text-sm">{{ __('Last logged in ').$student->updated_at->diffForHumans() }}.</p>
                            </x-slot>
                        </x-list-clickable-item>
                    @empty
                        <x-list-clickable-item title="{{ __('No students') }}" href="{{ route('students.manage') }}" badge="{{ __('Create students') }} →">
                            <x-slot name="footerLeftIcons">
                                <p class="text-sm">{{ __('You do not have any students set up on this account.') }}</p>
                            </x-slot>
                        </x-list-clickable-item>
                    @endforelse
                </x-list>
            </div>
        @endif
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

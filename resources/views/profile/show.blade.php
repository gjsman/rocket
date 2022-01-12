<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>

    <div>
        <div class="">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <x-section-border />

            <div class="mt-10 sm:mt-0">
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Subscription') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Subscribe, manage, or unsubscribe from Unlimited Access.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="max-w-xl text-sm text-gray-600">
                            {{ __('If necessary, you can subscribe to Unlimited Access, manage your subscription, or unsubscribe using our easy-to-use billing portal. You can also set up an email address for receipts or change the credit card to bill.') }}
                        </div>

                        <div class="flex items-center mt-5">
                            <x-button href="{{ url('/subscription') }}">
                                {{ __('Manage Subscription') }}
                            </x-button>
                        </div>
                    </x-slot>
                </x-action-section>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

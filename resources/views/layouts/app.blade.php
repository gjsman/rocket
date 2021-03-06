<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Homeschool Connections') }}</title>

        <!-- Fonts -->
        <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">-->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <style>[x-cloak] { display: none !important; }</style>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 background">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <!--
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                -->
            @endif

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{ $slot }}
                        <div class="mt-16">
                            <div class="text-white mb-2">
                                <p>{{ __('Build') }} {{ substr(get_current_git_commit(), 0, 7) }}</p>
                                <p>&copy; {{ date('Y') }} {{ __('Homeschool Connections') }}</p>
                            </div>
                            <x-alert-warning title="ALPHA SOFTWARE NOTICE">
                                This is ALPHA software and may have serious bugs which may cause damage or loss to stored data. User interface elements and features may not be final and may change without notice. Some features may not be available. It is intended for qualified developers and testers only and must not be used in production systems. Please report feedback to Gabriel Sieben at <a href="mailto:gsieben@homeschoolconnections.com">gsieben@homeschoolconnections.com</a>.
                            </x-alert-warning>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>

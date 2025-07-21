<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-base-100 text-base-content">
    <flux:main class="max-w-sm sm:max-w-md md:max-w-lg mx-auto px-4">
        {{ $slot }}
        <x-toast />
    </flux:main>
    @fluxScripts
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Examine CBT') }} - Master JAMB & WAEC Exams</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased" x-data="window.topLoader()" x-init="init()">
    <!-- Top Loading Bar -->
    <div
        class="top-loader"
        :style="`width: ${progress}%; ${progress === 0 ? 'opacity: 0;' : 'opacity: 1;'}`"
        :class="{ 'hidden': progress === 0 }">
    </div>

    {{ $slot }}

    @livewireScripts
</body>

</html>
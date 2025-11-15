<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Examine CBT' }} - Master JAMB & WAEC Exams</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/state-capital.js'])
    
    <!-- Lottie Player CDN -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
    @livewireStyles
</head>

<body class="antialiased bg-gradient-to-br from-primary-50 via-white to-secondary-50" x-data="window.topLoader()" x-init="init()">
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

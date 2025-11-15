<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Examine CBT') }} - Master JAMB & WAEC Exams</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="antialiased" x-data="window.topLoader()" x-init="init()">
    <!-- Top Loading Bar -->
    <div
        class="top-loader"
        :style="`width: ${progress}%; ${progress === 0 ? 'opacity: 0;' : 'opacity: 1;'}`"
        :class="{ 'hidden': progress === 0 }">
    </div>

    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50">

        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md shadow-soft">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
                <div class="flex justify-between items-center h-14 sm:h-16">

                    <!-- Logo -->
                    <div class="flex items-center space-x-2">
                        <div class="w-8 sm:w-10 h-8 sm:h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg sm:text-xl">E</span>
                        </div>
                        <span class="text-base sm:text-xl font-bold text-spiritual-900">Examine</span>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#featured-exams" class="text-spiritual-600 hover:text-primary-600 transition-colors ">Exams</a>
                        <a href="#" class="text-spiritual-600 hover:text-primary-600 transition-colors ">About</a>
                        <a href="#" class="text-spiritual-600 hover:text-primary-600 transition-colors ">Contact</a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        @auth
                        <a href="{{ route('dashboard') }}" wire:navigate class="btn-primary text-sm">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" wire:navigate class="text-spiritual-600 hover:text-primary-600 transition-colors text-sm font-semibold border border-gray-200 rounded-xl px-3 py-2 sm:px-4 sm:py-3">Sign In</a>
                        <a href="{{ route('register') }}" wire:navigate class="btn-primary text-sm hidden sm:inline-flex">Get Started</a>
                        @endauth
                    </div>

                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-20 sm:pt-24 md:pt-32 pb-12 sm:pb-16 md:pb-20 px-3 sm:px-4 lg:px-8 overflow-hidden">
            <div class="absolute inset-0 islamic-bg opacity-30"></div>

            <div class="relative max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 md:gap-12 items-center">

                    <!-- Hero Content -->
                    <div
                        x-data="{ show: false }"
                        x-init="setTimeout(() => show = true, 100)"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-800"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="space-y-4 sm:space-y-6 md:space-y-8">

                        <div class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-primary-100 text-primary-700 rounded-full text-xs sm:text-sm font-medium">
                            🎯 AI-Powered Exam Preparation
                        </div>

                        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-spiritual-900 leading-tight">
                            Master Your
                            <span class="text-gradient block">Exam Preparation</span>
                        </h1>

                        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-spiritual-600 max-w-3xl leading-relaxed">
                            Ace your JAMB, WAEC, and NECO exams with AI-powered practice tests, compete with peers, and track your academic progress in real-time.
                        </p>

                        <!-- CTA Buttons -->
                        <div
                            x-data="{ showButtons: false }"
                            x-init="setTimeout(() => showButtons = true, 300)"
                            x-show="showButtons"
                            x-transition:enter="transition ease-out duration-800"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="flex flex-col sm:flex-row items-center justify-start gap-2 sm:gap-3 md:gap-4">

                            @auth
                            <a href="{{ route('dashboard') }}" wire:navigate class="bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium py-4 sm:py-3 px-6 sm:px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50 disabled:opacity-50 disabled:cursor-not-allowed group text-sm sm:text-base w-full sm:w-auto">
                                <x-lucide-play class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                                Start Practicing
                                <x-lucide-arrow-right class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover:translate-x-1 transition-transform" />
                            </a>
                            @else
                            <a href="{{ route('register') }}?role=student" class="bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium py-4 sm:py-3 px-6 sm:px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50 disabled:opacity-50 disabled:cursor-not-allowed group text-sm sm:text-base w-full sm:w-auto">
                                <x-lucide-play class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                                Start Learning
                                <x-lucide-arrow-right class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover:translate-x-1 transition-transform" />
                            </a>
                            @endauth

                            <a href="#featured-exams" data-no-loading class="bg-white text-spiritual-700 font-medium py-2.5 sm:py-3 px-4 sm:px-6 rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 border border-spiritual-200 hover:border-spiritual-300 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spiritual-500/50 disabled:opacity-50 disabled:cursor-not-allowed text-sm sm:text-base w-full sm:w-auto">
                                <x-lucide-trophy class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                                View Leaderboard
                            </a>
                        </div>
                    </div>

                    <!-- Hero Illustration -->
                    <div
                        x-data="{ show: false }"
                        x-init="setTimeout(() => show = true, 600)"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 scale-80"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="mt-8 sm:mt-12 lg:mt-0 relative hidden sm:block">

                        <div class="w-full max-w-xs sm:max-w-sm md:max-w-md mx-auto">
                            <div class="relative bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 shadow-strong">
                                <div class="text-center space-y-3 sm:space-y-4">
                                    <div class="w-16 sm:w-20 h-16 sm:h-20 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl mx-auto flex items-center justify-center animate-bounce-gentle">
                                        <x-lucide-book-open class="w-8 sm:w-10 h-8 sm:h-10 text-white" />
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-spiritual-900">Ready to Begin?</h3>
                                    <p class="text-xs sm:text-sm text-spiritual-600">Choose from thousands of exam questions across all subjects</p>
                                    <div class="flex items-center justify-center space-x-2 text-xs sm:text-sm text-spiritual-500">
                                        <x-lucide-star class="w-3 h-3 sm:w-4 sm:h-4 text-warning-500" />
                                        <span>Trusted by 10,000+ students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-8 sm:py-12 md:py-16 bg-white/50">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6 lg:gap-8">

                    @php
                    $stats = [
                    [
                    'icon' => 'users',
                    'label' => 'Active Students',
                    'value' => '10,000+',
                    'color' => 'text-primary-600'
                    ],
                    [
                    'icon' => 'book-open',
                    'label' => 'Practice Questions',
                    'value' => '50,000+',
                    'color' => 'text-secondary-600'
                    ],
                    [
                    'icon' => 'badge-check',
                    'label' => 'Tests Completed',
                    'value' => '100,000+',
                    'color' => 'text-success-600'
                    ],
                    [
                    'icon' => 'star',
                    'label' => 'Success Rate',
                    'value' => '92%',
                    'color' => 'text-warning-600'
                    ]
                    ];
                    @endphp

                    @foreach($stats as $index => $stat)
                    <div
                        class="text-center space-y-1 sm:space-y-2 animate-fadeIn">

                        <div class="w-10 sm:w-12 h-10 sm:h-12 mx-auto rounded-lg sm:rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center {{ $stat['color'] }}">
                            @if($stat['icon'] === 'users')
                            <x-lucide-users class="w-5 sm:w-6 h-5 sm:h-6" />
                            @elseif($stat['icon'] === 'book-open')
                            <x-lucide-book-open class="w-5 sm:w-6 h-5 sm:h-6" />
                            @elseif($stat['icon'] === 'badge-check')
                            <x-lucide-badge-check class="w-5 sm:w-6 h-5 sm:h-6" />
                            @elseif($stat['icon'] === 'star')
                            <x-lucide-star class="w-5 sm:w-6 h-5 sm:h-6" />
                            @endif
                        </div>
                        <div class="text-lg sm:text-xl md:text-2xl font-bold text-spiritual-900">{{ $stat['value'] }}</div>
                        <div class="text-xs sm:text-sm text-spiritual-600">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- Featured Exams Section -->
        <section id="featured-exams" class="py-8 sm:py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">

                <div class="text-center mb-6 sm:mb-8 md:mb-12 animate-fadeIn">

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-spiritual-900 mb-2 sm:mb-4">
                        Featured Mock Exams
                    </h2>
                    <p class="text-sm sm:text-base md:text-lg text-spiritual-600 max-w-2xl mx-auto">
                        Start your preparation with these carefully designed mock tests based on past JAMB, WAEC, and NECO questions.
                    </p>
                </div>

                @php
                $featuredExams = [
                [
                'id' => 1,
                'title' => 'JAMB Mathematics',
                'description' => 'Comprehensive practice test covering all JAMB mathematics topics',
                'subject' => 'Mathematics',
                'timeLimit' => 120,
                'difficulty' => 'medium',
                'difficultyColor' => 'text-warning-600 bg-warning-100',
                'totalPoints' => 400,
                'questions' => 40,
                'emoji' => '🧮'
                ],
                [
                'id' => 2,
                'title' => 'WAEC English Language',
                'description' => 'Master WAEC English comprehension, grammar, and oral English',
                'subject' => 'English',
                'timeLimit' => 180,
                'difficulty' => 'easy',
                'difficultyColor' => 'text-success-600 bg-success-100',
                'totalPoints' => 500,
                'questions' => 50,
                'emoji' => '📚'
                ],
                [
                'id' => 3,
                'title' => 'JAMB Chemistry',
                'description' => 'Practice organic, inorganic, and physical chemistry questions',
                'subject' => 'Chemistry',
                'timeLimit' => 120,
                'difficulty' => 'hard',
                'difficultyColor' => 'text-error-600 bg-error-100',
                'totalPoints' => 400,
                'questions' => 40,
                'emoji' => '⚗️'
                ]
                ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 md:gap-6">
                    @foreach($featuredExams as $index => $exam)
                    <div
                        class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 md:p-6 shadow-soft border border-white/20 card-hover animate-fadeIn"
                        style="animation-delay: {{ $index * 100 }}ms;">

                        <!-- Card Header -->
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="text-3xl sm:text-4xl">{{ $exam['emoji'] }}</div>
                            <span class="px-2 sm:px-3 py-0.5 sm:py-1 rounded-full text-xs font-medium {{ $exam['difficultyColor'] }}">
                                {{ ucfirst($exam['difficulty']) }}
                            </span>
                        </div>

                        <!-- Card Content -->
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-spiritual-900 mb-1 sm:mb-2">{{ $exam['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-spiritual-600 mb-3 sm:mb-4 leading-relaxed">{{ $exam['description'] }}</p>

                        <!-- Card Meta -->
                        <div class="flex items-center justify-between text-xs sm:text-sm text-spiritual-500 mb-3 sm:mb-4 gap-2">
                            <div class="flex items-center space-x-1">
                                <x-lucide-clock class="w-3 h-3 sm:w-4 sm:h-4" />
                                <span>{{ $exam['timeLimit'] }}m</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <x-lucide-star class="w-3 h-3 sm:w-4 sm:h-4" />
                                <span>{{ $exam['totalPoints'] }} pts</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <x-lucide-users class="w-3 h-3 sm:w-4 sm:h-4" />
                                <span>{{ $exam['questions'] }}</span>
                            </div>
                        </div>

                        <!-- Start Button -->
                        <a href="{{ route('mock.exam', ['examId' => $exam['id']]) }}" class="bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium py-2 sm:py-3 px-4 sm:px-6 rounded-lg sm:rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50 disabled:opacity-50 disabled:cursor-not-allowed w-full group text-sm sm:text-base">
                            <span>Start Exam</span>
                            <x-lucide-arrow-right class="w-3 h-3 sm:w-4 sm:h-4 ml-2 group-hover:translate-x-1 transition-transform" />
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="text-center mt-6 sm:mt-8 md:mt-12 animate-fadeIn">

                    <a href="{{ route('login') }}" wire:navigate class="bg-white text-spiritual-700 font-medium py-2 sm:py-3 px-4 sm:px-6 rounded-lg sm:rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 border border-spiritual-200 hover:border-spiritual-300 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spiritual-500/50 disabled:opacity-50 disabled:cursor-not-allowed text-sm sm:text-base">
                        <span>View All Exams</span>
                        <x-lucide-arrow-right class="w-4 h-4 sm:w-5 sm:h-5 ml-2" />
                    </a>
                </div>

            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-8 sm:py-12 md:py-16 bg-gradient-to-r from-primary-600 to-secondary-600">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 text-center">
                <div class="space-y-4 sm:space-y-6 animate-fadeIn">

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">
                        Ready to Ace Your Exams?
                    </h2>
                    <p class="text-sm sm:text-base md:text-lg lg:text-xl text-primary-100 max-w-2xl mx-auto">
                        Join thousands of Nigerian students preparing for JAMB, WAEC, and NECO with our AI-powered mock tests.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-3 md:gap-4 pt-2">
                        <a href="{{ route('register') }}" wire:navigate class="bg-white text-primary-600 hover:bg-primary-50 font-medium py-2.5 sm:py-3 px-4 sm:px-6 rounded-lg sm:rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/50 text-sm sm:text-base w-full sm:w-auto">
                            <x-lucide-play class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                            Start Your First Test
                        </a>

                        <a href="#featured-exams" data-no-loading class="text-white font-medium py-2.5 sm:py-3 px-4 sm:px-6 rounded-lg sm:rounded-xl hover:bg-white/20 transition-all duration-300 border-2 border-white inline-flex items-center justify-center text-sm sm:text-base w-full sm:w-auto">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-spiritual-900 text-spiritual-300 py-8 sm:py-10 md:py-12">
            <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8 mb-6 sm:mb-8">

                    <!-- Brand -->
                    <div class="col-span-2 md:col-span-1 space-y-3 sm:space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 sm:w-8 h-6 sm:h-8 bg-gradient-to-br from-primary-600 to-secondary-500 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-xs sm:text-sm">E</span>
                            </div>
                            <span class="text-base sm:text-lg font-bold text-white">Examine</span>
                        </div>
                        <p class="text-xs sm:text-sm">
                            Your trusted platform for JAMB, WAEC, and NECO exam preparation.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white font-semibold mb-2 sm:mb-4 text-sm sm:text-base">Quick Links</h4>
                        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm">
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Home</a></li>
                            <li><a href="#featured-exams" class="hover:text-primary-400 transition-colors">Exams</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors">About Us</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Resources -->
                    <div>
                        <h4 class="text-white font-semibold mb-2 sm:mb-4 text-sm sm:text-base">Resources</h4>
                        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm">
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Study Guides</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Past Questions</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Blog</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors">FAQs</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h4 class="text-white font-semibold mb-2 sm:mb-4 text-sm sm:text-base">Legal</h4>
                        <ul class="space-y-1 sm:space-y-2 text-xs sm:text-sm">
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Terms of Service</a></li>
                            <li><a href="#" class="hover:text-primary-400 transition-colors">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-spiritual-700 pt-6 sm:pt-8 text-center text-xs sm:text-sm">
                    <p>&copy; {{ date('Y') }} Examine. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>
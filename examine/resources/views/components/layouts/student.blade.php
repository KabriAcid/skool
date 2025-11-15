<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Student Dashboard' }} - {{ config('app.name', 'Examine CBT') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.css" />

    <!-- NProgress Custom Styling -->
    <style>
        #nprogress {
            pointer-events: none;
        }

        #nprogress .bar {
            background: linear-gradient(90deg, rgb(59, 130, 246), rgb(168, 85, 247));
            height: 3px;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.8);
        }

        #nprogress .spinner {
            display: none;
        }

        /* Skeleton Loader Pulse Animation */
        @keyframes skeleton-pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .skeleton-pulse {
            animation: skeleton-pulse 1.5s ease-in-out infinite;
        }
    </style>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>

<body class="antialiased bg-gradient-to-br from-primary-50 via-white to-secondary-50" x-data="window.topLoader()" x-init="init()">

    <!-- Top Loading Bar -->
    <div
        class="top-loader"
        :style="`width: ${progress}%; ${progress === 0 ? 'opacity: 0;' : 'opacity: 1;'}`"
        :class="{ 'hidden': progress === 0 }">
    </div>

    <div x-data="{
        sidebarOpen: {{ (isset($currentPage) && $currentPage === 'mock-exam') ? 'false' : 'false' }},
        currentPage: '{{ $currentPage ?? 'dashboard' }}',
        userMenuOpen: false,
        notificationOpen: false
    }" class="min-h-screen flex flex-col">

        <!-- Sidebar (Desktop: Fixed, Mobile: Overlay) -->
        <aside
            x-show="sidebarOpen || window.innerWidth >= 1024"
            @click.away="if (window.innerWidth < 1024) sidebarOpen = false"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:fixed top-0 left-0 z-40 w-72 h-screen flex-col transition-transform duration-300 ease-in-out bg-white/95 backdrop-blur-lg border-r border-spiritual-200 shadow-strong flex">

            <div class="h-full flex flex-col">

                <!-- Logo & Brand -->
                <div class="flex items-center justify-between px-4 sm:px-6 py-4 sm:py-5 border-b border-spiritual-200">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <!-- Logo Icon (SVG instead of favicon) -->
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-primary-500 to-secondary-600 rounded-lg sm:rounded-xl flex items-center justify-center text-white font-bold text-sm">
                            E
                        </div>
                        <span class="text-lg sm:text-xl font-bold text-spiritual-900 truncate">Examine</span>
                    </div>
                    <!-- Close button on mobile -->
                    <button
                        @click="sidebarOpen = false"
                        class="lg:hidden text-spiritual-600 hover:text-spiritual-900 transition-colors">
                        <x-lucide-x class="w-6 h-6" />
                    </button>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 overflow-y-auto py-3 sm:py-4">
                    <div class="px-2 sm:px-3 space-y-0.5 sm:space-y-1">

                        <!-- Dashboard -->
                        <a href="{{ route('student.dashboard') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'dashboard' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-layout-dashboard class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Dashboard</span>
                        </a>

                        <!-- My Exams -->
                        <a href="{{ route('student.exams') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'exams' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-book-open class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">My Exams</span>
                        </a>

                        <!-- Practice Tests -->
                        <a href="{{ route('student.practice') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'practice' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-trophy class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Practice Tests</span>
                        </a>

                        <!-- Results -->
                        <a href="{{ route('student.results') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'results' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-bar-chart-3 class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Results</span>
                        </a>

                        <!-- Performance -->
                        <a href="{{ route('student.performance') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'performance' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-trending-up class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Performance</span>
                        </a>

                        <!-- Subjects -->
                        <a href="{{ route('student.subjects') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'subjects' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-layers class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Subjects</span>
                        </a>

                        <div class="my-2 sm:my-3 border-t border-spiritual-200"></div>

                        <!-- Settings -->
                        <a href="{{ route('student.settings') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'settings' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-settings class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Settings</span>
                        </a>

                        <!-- Help -->
                        <a href="{{ route('student.help') }}"
                            wire:navigate
                            @click="if (window.innerWidth < 1024) sidebarOpen = false"
                            :class="currentPage === 'help' ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium' : 'text-spiritual-700 hover:bg-spiritual-50'"
                            class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300 group text-sm sm:text-base">
                            <x-lucide-help-circle class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Help & Support</span>
                        </a>

                    </div>
                </nav>

                <!-- Logout Button -->
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-spiritual-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 sm:gap-3 w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl text-spiritual-700 hover:bg-error-50 hover:text-error-600 transition-all duration-300 text-sm sm:text-base">
                            <x-lucide-log-out class="w-5 h-5 flex-shrink-0" />
                            <span class="font-medium truncate">Logout</span>
                        </button>
                    </form>
                </div>

            </div>
        </aside>

        <!-- Sidebar Overlay (Mobile only) -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 lg:hidden"
            style="display: none;">
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-72 {{ (isset($currentPage) && $currentPage === 'mock-exam') ? 'pb-0' : 'pb-20 lg:pb-0' }}"> <!-- Top Header Bar (Hidden on Mock Exam) -->
            @if((isset($currentPage) && $currentPage !== 'mock-exam') || !isset($currentPage))
            <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-spiritual-200 shadow-soft">
                <div class="px-3 sm:px-6 lg:px-8 py-3 sm:py-4">
                    <div class="flex items-center gap-2 sm:gap-4">

                        <!-- Mobile Menu Toggle (Hidden on SM, visible on MD+) -->
                        <button
                            @click="sidebarOpen = !sidebarOpen"
                            class="text-spiritual-600 hover:text-primary-600 transition-colors hidden md:block lg:hidden flex-shrink-0">
                            <x-lucide-menu class="w-5 h-5 sm:w-6 sm:h-6" />
                        </button>

                        <!-- Page Title (Hidden on mobile) -->
                        <div class="hidden lg:block">
                            <h1 class="text-xl sm:text-2xl font-bold text-spiritual-900">{{ $pageTitle ?? 'Dashboard' }}</h1>
                            @isset($pageDescription)
                            <p class="text-xs sm:text-sm text-spiritual-600 mt-1">{{ $pageDescription }}</p>
                            @endisset
                        </div>

                        <!-- Spacer -->
                        <div class="flex-1"></div>

                        <!-- Right Side Actions -->
                        <div class="flex items-center gap-2 sm:gap-4">

                            <!-- Streak Counter -->
                            <div class="flex items-center gap-1.5 px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-lg bg-gradient-to-r from-warning-50 to-orange-50">
                                <div class="bg-gradient-to-b from-warning-400 to-orange-500 rounded-full p-0.5">
                                    <x-lucide-flame class="w-4 h-4 sm:w-5 sm:h-5 text-white" />
                                </div>
                                <span class="font-semibold text-sm sm:text-base text-warning-600">{{ str_pad(7, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <!-- Notifications -->
                            <div class="relative" x-data="{ open: false }">
                                <button
                                    @click="open = !open"
                                    class="relative p-1.5 sm:p-2 text-spiritual-600 hover:text-primary-600 transition-colors rounded-lg hover:bg-spiritual-50 flex-shrink-0">
                                    <x-lucide-bell class="w-5 h-5 sm:w-5 sm:h-5" />
                                    <span class="absolute top-1 right-1 w-2 h-2 bg-error-500 rounded-full"></span>
                                </button>

                                <!-- Notifications Dropdown -->
                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-72 sm:w-80 bg-white rounded-xl shadow-strong border border-spiritual-200 py-2 z-50"
                                    style="display: none;">

                                    <div class="px-3 sm:px-4 py-2 sm:py-3 border-b border-spiritual-200">
                                        <h3 class="font-semibold text-sm sm:text-base text-spiritual-900">Notifications</h3>
                                    </div>

                                    <div class="max-h-96 overflow-y-auto">
                                        <div class="px-3 sm:px-4 py-2 sm:py-3 hover:bg-spiritual-50 cursor-pointer transition-colors">
                                            <p class="text-xs sm:text-sm font-medium text-spiritual-900">New exam available</p>
                                            <p class="text-xs text-spiritual-600 mt-1">JAMB Physics Mock - 2025</p>
                                            <p class="text-xs text-spiritual-500 mt-1">2 hours ago</p>
                                        </div>
                                        <div class="px-3 sm:px-4 py-2 sm:py-3 hover:bg-spiritual-50 cursor-pointer transition-colors">
                                            <p class="text-xs sm:text-sm font-medium text-spiritual-900">Result published</p>
                                            <p class="text-xs text-spiritual-600 mt-1">Your Chemistry exam result is now available</p>
                                            <p class="text-xs text-spiritual-500 mt-1">1 day ago</p>
                                        </div>
                                    </div>

                                    <div class="px-3 sm:px-4 py-2 sm:py-3 border-t border-spiritual-200">
                                        <a href="#" class="text-xs sm:text-sm text-primary-600 hover:text-primary-700 font-medium">View all notifications</a>
                                    </div>
                                </div>
                            </div>

                            <!-- User Menu -->
                            <div class="relative" x-data="{ open: false }">
                                <button
                                    @click="open = !open"
                                    class="flex items-center gap-2 p-1.5 sm:p-2 rounded-lg hover:bg-spiritual-50 transition-colors flex-shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-xs">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <x-lucide-chevron-down class="hidden sm:block w-4 h-4 text-spiritual-600" />
                                </button>

                                <!-- User Dropdown -->
                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-48 sm:w-56 bg-white rounded-xl shadow-strong border border-spiritual-200 py-2 z-50"
                                    style="display: none;">

                                    <div class="px-3 sm:px-4 py-2 sm:py-3 border-b border-spiritual-200">
                                        <p class="text-xs sm:text-sm font-semibold text-spiritual-900 truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-spiritual-600 mt-1 truncate">{{ auth()->user()->email }}</p>
                                    </div>

                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 sm:px-4 py-2 text-xs sm:text-sm text-spiritual-700 hover:bg-spiritual-50 transition-colors">
                                        <x-lucide-user class="w-4 h-4 flex-shrink-0" />
                                        <span class="truncate">My Profile</span>
                                    </a>

                                    <a href="{{ route('student.settings') }}" class="flex items-center gap-2 px-3 sm:px-4 py-2 text-xs sm:text-sm text-spiritual-700 hover:bg-spiritual-50 transition-colors">
                                        <x-lucide-settings class="w-4 h-4 flex-shrink-0" />
                                        <span class="truncate">Settings</span>
                                    </a>

                                    <div class="border-t border-spiritual-200 my-2"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 w-full px-3 sm:px-4 py-2 text-xs sm:text-sm text-error-600 hover:bg-error-50 transition-colors">
                                            <x-lucide-log-out class="w-4 h-4 flex-shrink-0" />
                                            <span class="truncate">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 {{ (isset($currentPage) && $currentPage === 'mock-exam') ? '' : 'p-4 sm:p-6 lg:p-8' }}">
                {{ $slot }}
            </main>

            <!-- Footer (Hidden on Mock Exam) -->
            @if((isset($currentPage) && $currentPage !== 'mock-exam') || !isset($currentPage))
            <footer class="hidden lg:block bg-white/50 border-t border-spiritual-200 mt-12">
                <div class="px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <p class="text-sm text-spiritual-600">&copy; {{ date('Y') }} Examine CBT. All rights reserved.</p>
                        <div class="flex items-center space-x-6 text-sm text-spiritual-600">
                            <a href="#" class="hover:text-primary-600 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-primary-600 transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-primary-600 transition-colors">Help</a>
                        </div>
                    </div>
                </div>
            </footer>
            @endif

        </div>

        <!-- Mobile Bottom Navigation (SM & MD screens only, hidden on mock exam) -->
        @if((isset($currentPage) && $currentPage !== 'mock-exam') || !isset($currentPage))
        <nav class="fixed bottom-0 left-0 right-0 lg:hidden z-50 bg-white/95 backdrop-blur-md border-t border-spiritual-200 shadow-strong">
            <div class="flex items-center justify-around h-20">
                <!-- Dashboard -->
                <a href="{{ route('student.dashboard') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.dashboard') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-layout-dashboard class="w-6 h-6" />
                    <span class="text-xs font-medium">Dashboard</span>
                </a>

                <!-- Practice -->
                <a href="{{ route('student.practice') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.practice') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-play class="w-6 h-6" />
                    <span class="text-xs font-medium">Practice</span>
                </a>

                <!-- Results -->
                <a href="{{ route('student.results') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.results') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-bar-chart-3 class="w-6 h-6" />
                    <span class="text-xs font-medium">Results</span>
                </a>

                <!-- More (Mobile Only) -->
                <a href="{{ route('student.more') }}"
                    wire:navigate
                    class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('student.more') ? 'text-primary-600' : 'text-spiritual-600' }} hover:text-primary-600 transition-colors">
                    <x-lucide-ellipsis-vertical class="w-6 h-6" />
                    <span class="text-xs font-medium">More</span>
                </a>
            </div>
        </nav>
        @endif

        <!-- Mobile Sidebar Overlay (removed since we're not using sliding sidebar anymore) -->
        <!-- Exam-only quit button (Mock Exam mode) -->
        @if(isset($currentPage) && $currentPage === 'mock-exam')
        <div class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-spiritual-200 h-16 flex items-center justify-between px-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-secondary-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    E
                </div>
                <span class="font-semibold text-spiritual-900">Examine</span>
            </div>
            <a href="{{ route('student.dashboard') }}"
                wire:navigate
                class="flex items-center gap-2 px-4 py-2 rounded-lg bg-error-50 text-error-600 hover:bg-error-100 transition-all duration-300 font-medium">
                <x-lucide-x class="w-5 h-5" />
                <span class="hidden sm:inline">Quit Exam</span>
                <span class="sm:hidden">Quit</span>
            </a>
        </div>
        @endif

        @livewireScripts
</body>

</html>
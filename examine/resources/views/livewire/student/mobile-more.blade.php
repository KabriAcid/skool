<div class="space-y-6 pb-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-primary-500 to-secondary-600 rounded-2xl p-6 text-white">
        <h1 class="text-3xl font-bold mb-2">More Options</h1>
        <p class="text-primary-100">Access additional features and manage your account</p>
    </div>

    <!-- Premium Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-spiritual-900">Premium Features</h2>
            <span class="bg-warning-100 text-warning-600 text-xs font-semibold px-3 py-1 rounded-full">PRO</span>
        </div>

        <a href="#" class="block group">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20 hover:shadow-medium hover:border-warning-300 transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-warning-100 rounded-xl flex items-center justify-center group-hover:bg-warning-200 transition-colors">
                        <x-lucide-crown class="w-6 h-6 text-warning-600" />
                    </div>
                    <span class="text-xs font-semibold text-warning-600 uppercase tracking-wide">Premium</span>
                </div>
                <h3 class="text-lg font-bold text-spiritual-900 mb-2">Upgrade to Premium</h3>
                <p class="text-sm text-spiritual-600 mb-4">Unlimited hearts, no ads, streak freeze, and more</p>
                <div class="flex items-center text-primary-600 font-medium text-sm">
                    View Plans
                    <x-lucide-arrow-right class="w-4 h-4 ml-2" />
                </div>
            </div>
        </a>
    </div>

    <!-- Quick Links Grid -->
    <div class="space-y-4">
        <h2 class="text-lg font-bold text-spiritual-900">Quick Links</h2>

        <div class="grid grid-cols-2 gap-3">
            <!-- Leaderboard -->
            <a href="#" class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-primary-300 transition-all duration-300">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-primary-200 transition-colors">
                        <x-lucide-trophy class="w-5 h-5 text-primary-600" />
                    </div>
                    <h3 class="font-semibold text-sm text-spiritual-900 mb-1">Leaderboard</h3>
                    <p class="text-xs text-spiritual-600">Global rankings</p>
                </div>
            </a>

            <!-- Achievements -->
            <a href="#" class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-secondary-300 transition-all duration-300">
                    <div class="w-10 h-10 bg-secondary-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-secondary-200 transition-colors">
                        <x-lucide-medal class="w-5 h-5 text-secondary-600" />
                    </div>
                    <h3 class="font-semibold text-sm text-spiritual-900 mb-1">Achievements</h3>
                    <p class="text-xs text-spiritual-600">Your badges</p>
                </div>
            </a>

            <!-- Statistics -->
            <a href="{{ route('student.performance') }}" wire:navigate class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-success-300 transition-all duration-300">
                    <div class="w-10 h-10 bg-success-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-success-200 transition-colors">
                        <x-lucide-bar-chart-2 class="w-5 h-5 text-success-600" />
                    </div>
                    <h3 class="font-semibold text-sm text-spiritual-900 mb-1">Statistics</h3>
                    <p class="text-xs text-spiritual-600">Detailed analytics</p>
                </div>
            </a>

            <!-- Study Streak -->
            <a href="#" class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-warning-300 transition-all duration-300">
                    <div class="w-10 h-10 bg-warning-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-warning-200 transition-colors">
                        <x-lucide-flame class="w-5 h-5 text-warning-600" />
                    </div>
                    <h3 class="font-semibold text-sm text-spiritual-900 mb-1">Streak</h3>
                    <p class="text-xs text-spiritual-600">Keep going!</p>
                </div>
            </a>

            <!-- Schedule -->
            <a href="#" class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-info-300 transition-all duration-300">
                    <div class="w-10 h-10 bg-info-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-info-200 transition-colors">
                        <x-lucide-calendar class="w-5 h-5 text-info-600" />
                    </div>
                    <h3 class="font-semibold text-sm text-spiritual-900 mb-1">Schedule</h3>
                    <p class="text-xs text-spiritual-600">Plan ahead</p>
                </div>
            </a>

            <!-- Resources -->
            <a href="#" class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-purple-300 transition-all duration-300">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-3 group-hover:bg-purple-200 transition-colors">
                        <x-lucide-book class="w-5 h-5 text-purple-600" />
                    </div>
                    <h3 class="font-semibold text-sm text-spiritual-900 mb-1">Resources</h3>
                    <p class="text-xs text-spiritual-600">Study materials</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Account Section -->
    <div class="space-y-4">
        <h2 class="text-lg font-bold text-spiritual-900">Account</h2>

        <div class="grid grid-cols-1 gap-3">
            <!-- Profile Settings -->
            <a href="{{ route('student.settings') }}" wire:navigate class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-primary-300 transition-all duration-300 flex items-center gap-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors flex-shrink-0">
                        <x-lucide-settings class="w-6 h-6 text-primary-600" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-spiritual-900">Settings</h3>
                        <p class="text-sm text-spiritual-600">Preferences & privacy</p>
                    </div>
                    <x-lucide-chevron-right class="w-5 h-5 text-spiritual-300 flex-shrink-0" />
                </div>
            </a>

            <!-- Help & Support -->
            <a href="{{ route('student.help') }}" wire:navigate class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-secondary-300 transition-all duration-300 flex items-center gap-4">
                    <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center group-hover:bg-secondary-200 transition-colors flex-shrink-0">
                        <x-lucide-help-circle class="w-6 h-6 text-secondary-600" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-spiritual-900">Help & Support</h3>
                        <p class="text-sm text-spiritual-600">FAQs and contact us</p>
                    </div>
                    <x-lucide-chevron-right class="w-5 h-5 text-spiritual-300 flex-shrink-0" />
                </div>
            </a>

            <!-- About -->
            <a href="#" class="group">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-soft border border-white/20 hover:shadow-medium hover:border-success-300 transition-all duration-300 flex items-center gap-4">
                    <div class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center group-hover:bg-success-200 transition-colors flex-shrink-0">
                        <x-lucide-info class="w-6 h-6 text-success-600" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-spiritual-900">About Examine</h3>
                        <p class="text-sm text-spiritual-600">Version & information</p>
                    </div>
                    <x-lucide-chevron-right class="w-5 h-5 text-spiritual-300 flex-shrink-0" />
                </div>
            </a>
        </div>
    </div>

    <!-- Bottom Info Card -->
    <div class="bg-gradient-to-br from-primary-50 to-secondary-50 rounded-2xl p-6 border border-primary-200">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <x-lucide-lightbulb class="w-6 h-6 text-primary-600" />
            </div>
            <div>
                <h3 class="font-bold text-spiritual-900 mb-2">Pro Tip</h3>
                <p class="text-sm text-spiritual-700 leading-relaxed">
                    Consistent daily practice is the key to success! Maintain your study streak and unlock exclusive achievements.
                </p>
                <a href="{{ route('student.help') }}" wire:navigate class="text-sm text-primary-600 hover:text-primary-700 font-medium mt-3 inline-flex items-center gap-1">
                    Learn More
                    <x-lucide-arrow-right class="w-4 h-4" />
                </a>
            </div>
        </div>
    </div>
</div>
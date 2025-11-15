<div class="space-y-5 sm:space-y-6 md:space-y-7 lg:space-y-8">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-primary-500 to-secondary-600 rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-7 lg:p-8 shadow-strong text-white"
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 100)"
        x-show="show"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0">
        <div class="flex items-center justify-between gap-4">
            <div class="flex-1">
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-1 sm:mb-2 leading-tight">Welcome back, {{ auth()->user()->name }}! 👋</h2>
                <p class="text-xs sm:text-sm md:text-base text-primary-100">Ready to ace your exams? Let's keep the momentum going!</p>
            </div>
            <div class="hidden md:flex flex-shrink-0">
                <x-lucide-rocket class="w-12 sm:w-16 md:w-20 h-12 sm:h-16 md:h-20 opacity-20" />
            </div>
        </div>
    </div>

    <!-- Chart.js Script (loaded first) -->
    <script>
        // Initialize Chart.js globally
        let Chart = null;
        import('chart.js').then(module => {
            Chart = module.Chart;
        });
    </script>

    <!-- Quick Stats - Show skeleton OR content (React style) -->
    @if($isLoading)
    <x-skeleton.stats />
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
        <!-- Total Exams -->
        <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-4 lg:p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 200)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between gap-2 sm:gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm text-spiritual-600 mb-0.5 sm:mb-1">Total Exams</p>
                    <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-spiritual-900 truncate">{{ $stats['total_exams'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-primary-100 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                    <x-lucide-book-open class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-primary-600" />
                </div>
            </div>
            <div class="mt-2 sm:mt-3 lg:mt-4 flex items-center text-xs sm:text-sm">
                <span class="text-success-600 font-medium">+3 this week</span>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-4 lg:p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 300)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between gap-2 sm:gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm text-spiritual-600 mb-0.5 sm:mb-1">Completed</p>
                    <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-spiritual-900 truncate">{{ $stats['completed'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-success-100 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                    <x-lucide-badge-check class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-success-600" />
                </div>
            </div>
            <div class="mt-2 sm:mt-3 lg:mt-4">
                <div class="w-full bg-spiritual-200 rounded-full h-1.5 sm:h-2">
                    <div class="bg-gradient-to-r from-success-500 to-success-600 h-1.5 sm:h-2 rounded-full"
                        style="width: {{ ($stats['completed'] / $stats['total_exams']) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Average Score -->
        <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-4 lg:p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 400)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between gap-2 sm:gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm text-spiritual-600 mb-0.5 sm:mb-1">Avg Score</p>
                    <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-spiritual-900 truncate">{{ $stats['average_score'] }}%</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-secondary-100 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                    <x-lucide-trending-up class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-secondary-600" />
                </div>
            </div>
            <div class="mt-2 sm:mt-3 lg:mt-4 flex items-center text-xs sm:text-sm">
                <x-lucide-arrow-up class="w-3 h-3 sm:w-4 sm:h-4 text-success-600 mr-1" />
                <span class="text-success-600 font-medium">+5% from last week</span>
            </div>
        </div>

        <!-- Class Rank -->
        <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-4 lg:p-6 shadow-soft border border-white/20 hover:shadow-medium transition-all duration-300"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 500)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">
            <div class="flex items-center justify-between gap-2 sm:gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm text-spiritual-600 mb-0.5 sm:mb-1">Class Rank</p>
                    <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-spiritual-900 truncate">#{{ $stats['rank'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-warning-100 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                    <x-lucide-trophy class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-warning-600" />
                </div>
            </div>
            <div class="mt-2 sm:mt-3 lg:mt-4 flex items-center text-xs sm:text-sm">
                <span class="text-spiritual-600">Out of 120 students</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6 md:gap-7 lg:gap-8">
        <!-- Left Column (2/3) -->
        <div class="lg:col-span-2 space-y-5 sm:space-y-6 md:space-y-7 lg:space-y-8">
            <!-- Upcoming Exams -->
            @if($isLoading)
            <x-skeleton.list />
            @else
            <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20">
                <div class="flex items-center justify-between mb-4 sm:mb-5 lg:mb-6 gap-2">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-spiritual-900">Upcoming Exams</h3>
                    <a href="{{ route('student.exams') }}" class="text-xs sm:text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1 whitespace-nowrap">
                        View All
                        <x-lucide-arrow-right class="w-3 h-3 sm:w-4 sm:h-4" />
                    </a>
                </div>

                <div class="space-y-3 sm:space-y-4">
                    @forelse($upcomingExams as $exam)
                    <div class="border border-spiritual-200 rounded-lg sm:rounded-xl p-3 sm:p-4 hover:border-primary-300 hover:shadow-medium transition-all duration-300 group cursor-pointer flex flex-col">
                        <!-- Title -->
                        <h4 class="font-semibold text-sm sm:text-base text-spiritual-900 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $exam['title'] }}</h4>

                        <!-- Info badges - single line, no wrap -->
                        <div class="flex items-center gap-2 sm:gap-2.5 mt-2 sm:mt-3 text-xs sm:text-sm text-spiritual-600 overflow-x-auto pb-1 scrollbar-hide">
                            <div class="flex items-center gap-0.5 whitespace-nowrap flex-shrink-0">
                                <x-lucide-book class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" />
                                <span class="truncate">{{ $exam['subject'] }}</span>
                            </div>
                            <span class="text-spiritual-300 flex-shrink-0">•</span>
                            <div class="flex items-center gap-0.5 whitespace-nowrap flex-shrink-0">
                                <x-lucide-clock class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" />
                                <span class="truncate">{{ $exam['duration'] }}</span>
                            </div>
                            <span class="text-spiritual-300 flex-shrink-0">•</span>
                            <div class="flex items-center gap-0.5 whitespace-nowrap flex-shrink-0">
                                <x-lucide-file-question class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" />
                                <span class="truncate">{{ $exam['questions'] }} Qs</span>
                            </div>
                        </div>

                        <!-- Scheduled date -->
                        <div class="mt-2 text-xs text-spiritual-500 truncate">
                            Scheduled: {{ $exam['scheduled_at']->format('M d, Y - h:i A') }}
                        </div>

                        <!-- Full width button -->
                        <button
                            wire:click="startExam({{ $exam['id'] }})"
                            class="mt-3 sm:mt-4 w-full bg-gradient-to-r from-primary-500 to-primary-600 text-white py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm font-medium hover:shadow-medium transition-all duration-300 active:scale-95">
                            Start Exam
                        </button>
                    </div>
                    @empty
                    <div class="text-center py-8 sm:py-12">
                        <x-lucide-calendar-x class="w-12 h-12 sm:w-16 sm:h-16 text-spiritual-300 mx-auto mb-3 sm:mb-4" />
                        <p class="text-spiritual-600 text-sm sm:text-base">No upcoming exams</p>
                        <a href="{{ route('student.practice') }}" class="text-primary-600 hover:text-primary-700 text-xs sm:text-sm font-medium mt-2 inline-block">
                            Browse Practice Tests
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
            @endif

            <!-- Subject Performance Chart -->
            @if($isLoading)
            <x-skeleton.chart />
            @else
            <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20">
                <div class="flex items-center justify-between mb-4 sm:mb-5 lg:mb-6">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-spiritual-900">Subject Performance</h3>
                </div>

                <div x-data="{ init() { initChart(); } }" class="space-y-4 sm:space-y-5">
                    <div class="bg-gradient-to-br from-spiritual-50 to-white rounded-lg sm:rounded-xl p-3 sm:p-4">
                        <canvas id="subjectChart" height="200"></canvas>
                    </div>

                    <div class="mt-4 sm:mt-5 lg:mt-6 pt-4 sm:pt-5 lg:pt-6 border-t border-spiritual-200">
                        <div class="grid grid-cols-2 gap-3 sm:gap-4">
                            <div class="text-center">
                                <p class="text-xl sm:text-2xl md:text-3xl font-bold text-spiritual-900">80.75%</p>
                                <p class="text-xs sm:text-sm text-spiritual-600 mt-1">Overall Average</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl sm:text-2xl md:text-3xl font-bold text-success-600">↑ 3.2%</p>
                                <p class="text-xs sm:text-sm text-spiritual-600 mt-1">Week Improvement</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Recent Results -->
            @if($isLoading)
            <x-skeleton.list />
            @else
            <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20">
                <div class="flex items-center justify-between mb-4 sm:mb-5 lg:mb-6 gap-2">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-spiritual-900">Recent Results</h3>
                    <a href="{{ route('student.results') }}" class="text-xs sm:text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1 whitespace-nowrap">
                        View All
                        <x-lucide-arrow-right class="w-3 h-3 sm:w-4 sm:h-4" />
                    </a>
                </div>

                <div class="space-y-3 sm:space-y-4">
                    @forelse($recentResults as $result)
                    <div class="flex items-center justify-between p-3 sm:p-4 border border-spiritual-200 rounded-lg sm:rounded-xl hover:border-primary-300 transition-all duration-300 gap-2 sm:gap-3">
                        <div class="flex items-center gap-2 sm:gap-3 sm:gap-4 flex-1 min-w-0">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 rounded-lg flex items-center justify-center flex-shrink-0
                                        {{ $result['status'] === 'passed' ? 'bg-success-100' : 'bg-error-100' }}">
                                @if($result['status'] === 'passed')
                                <x-lucide-badge-check class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-success-600" />
                                @else
                                <x-lucide-x-circle class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-error-600" />
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-sm sm:text-base text-spiritual-900 truncate">{{ $result['exam'] }}</h4>
                                <p class="text-xs sm:text-sm text-spiritual-600 mt-0.5 sm:mt-1">{{ $result['date']->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-lg sm:text-2xl lg:text-3xl font-bold {{ $result['percentage'] >= 70 ? 'text-success-600' : 'text-error-600' }}">
                                {{ $result['percentage'] }}%
                            </p>
                            <p class="text-xs sm:text-sm text-spiritual-600">{{ $result['score'] }}/{{ $result['total'] }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 sm:py-12">
                        <x-lucide-bar-chart-3 class="w-12 h-12 sm:w-16 sm:h-16 text-spiritual-300 mx-auto mb-3 sm:mb-4" />
                        <p class="text-spiritual-600 text-sm sm:text-base">No results yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column (1/3) -->
        <div class="space-y-4 sm:space-y-5 lg:space-y-6">
            @if($isLoading)
            <x-skeleton.card />
            <x-skeleton.card />
            <x-skeleton.card />
            @else
            <!-- Quick Actions -->
            <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20">
                <h3 class="text-lg sm:text-xl font-bold text-spiritual-900 mb-3 sm:mb-4">Quick Actions</h3>
                <div class="space-y-2 sm:space-y-3">
                    <a href="{{ route('student.practice') }}" class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 rounded-lg sm:rounded-xl hover:bg-primary-50 hover:border-primary-200 border border-transparent transition-all duration-300 group">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-primary-100 rounded-lg flex items-center justify-center group-hover:bg-primary-200 transition-colors flex-shrink-0">
                            <x-lucide-play class="w-4 h-4 sm:w-5 sm:h-5 text-primary-600" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm sm:text-base text-spiritual-900">Start Practice</p>
                            <p class="text-xs text-spiritual-600">Take a quick test</p>
                        </div>
                    </a>

                    <a href="{{ route('student.results') }}" class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 rounded-lg sm:rounded-xl hover:bg-secondary-50 hover:border-secondary-200 border border-transparent transition-all duration-300 group">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-secondary-100 rounded-lg flex items-center justify-center group-hover:bg-secondary-200 transition-colors flex-shrink-0">
                            <x-lucide-bar-chart-3 class="w-4 h-4 sm:w-5 sm:h-5 text-secondary-600" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm sm:text-base text-spiritual-900">View Results</p>
                            <p class="text-xs text-spiritual-600">Check performance</p>
                        </div>
                    </a>

                    <a href="{{ route('student.subjects') }}" class="flex items-center gap-2 sm:gap-3 p-2 sm:p-3 rounded-lg sm:rounded-xl hover:bg-success-50 hover:border-success-200 border border-transparent transition-all duration-300 group">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-success-100 rounded-lg flex items-center justify-center group-hover:bg-success-200 transition-colors flex-shrink-0">
                            <x-lucide-layers class="w-4 h-4 sm:w-5 sm:h-5 text-success-600" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm sm:text-base text-spiritual-900">Browse Subjects</p>
                            <p class="text-xs text-spiritual-600">Explore topics</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Best Subject -->
            <div class="bg-gradient-to-br from-warning-500 to-warning-600 rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-strong text-white">
                <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                    <x-lucide-star class="w-5 h-5 sm:w-6 sm:h-6" />
                    <h3 class="font-bold text-base sm:text-lg">Best Subject</h3>
                </div>
                <p class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-1 sm:mb-2">{{ $stats['best_subject'] }}</p>
                <p class="text-warning-100 text-xs sm:text-sm">Keep up the great work!</p>
            </div>

            <!-- Study Tips -->
            <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20">
                <div class="flex items-center gap-2 mb-3 sm:mb-4">
                    <x-lucide-lightbulb class="w-4 h-4 sm:w-5 sm:h-5 text-primary-600" />
                    <h3 class="text-base sm:text-lg font-bold text-spiritual-900">Study Tip</h3>
                </div>
                <p class="text-xs sm:text-sm text-spiritual-700 leading-relaxed">
                    Practice with past questions regularly. Focus on understanding concepts rather than memorizing answers. Review your mistakes after each test!
                </p>
            </div>

            <!-- Leaderboard - Other Schools -->
            <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20">
                <div class="flex items-center justify-between mb-3 sm:mb-4 gap-2">
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <x-lucide-medal class="w-4 h-4 sm:w-5 sm:h-5 text-warning-600" />
                        <h3 class="text-base sm:text-lg font-bold text-spiritual-900">Top Performers</h3>
                    </div>
                    <span class="text-xs bg-primary-100 text-primary-600 px-2 py-1 rounded-full font-medium whitespace-nowrap">Other Schools</span>
                </div>

                <div class="space-y-2 sm:space-y-3">
                    <!-- Rank 1 -->
                    <div class="flex items-center justify-between p-2 sm:p-3 bg-gradient-to-r from-warning-50 to-transparent rounded-lg sm:rounded-xl border border-warning-200 gap-2">
                        <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-warning-400 to-warning-600 flex items-center justify-center text-white font-bold text-xs sm:text-sm flex-shrink-0">🥇</div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-xs sm:text-sm text-spiritual-900 truncate">Chioma Okonkwo</p>
                                <p class="text-xs text-spiritual-600 truncate">Excellence Academy</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-warning-600 text-sm">98%</p>
                        </div>
                    </div>

                    <!-- Rank 2 -->
                    <div class="flex items-center justify-between p-2 sm:p-3 bg-gradient-to-r from-gray-50 to-transparent rounded-lg sm:rounded-xl border border-gray-200 gap-2">
                        <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center text-white font-bold text-xs sm:text-sm flex-shrink-0">🥈</div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-xs sm:text-sm text-spiritual-900 truncate">Tunde Adeyemi</p>
                                <p class="text-xs text-spiritual-600 truncate">Lagos High School</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-gray-600 text-sm">96%</p>
                        </div>
                    </div>

                    <!-- Rank 3 -->
                    <div class="flex items-center justify-between p-2 sm:p-3 bg-gradient-to-r from-amber-50 to-transparent rounded-lg sm:rounded-xl border border-amber-200 gap-2">
                        <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold text-xs sm:text-sm flex-shrink-0">🥉</div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-xs sm:text-sm text-spiritual-900 truncate">Amara Ejiofor</p>
                                <p class="text-xs text-spiritual-600 truncate">Federal College</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-amber-600 text-sm">94%</p>
                        </div>
                    </div>

                    <!-- Rank 4 -->
                    <div class="flex items-center justify-between p-2 sm:p-3 hover:bg-spiritual-50 rounded-lg sm:rounded-xl border border-spiritual-200 transition-colors gap-2">
                        <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-xs sm:text-sm flex-shrink-0">4</div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-xs sm:text-sm text-spiritual-900 truncate">Kelechi Ibeabuchi</p>
                                <p class="text-xs text-spiritual-600 truncate">Abuja International</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-primary-600 text-sm">92%</p>
                        </div>
                    </div>

                    <!-- Rank 5 -->
                    <div class="flex items-center justify-between p-2 sm:p-3 hover:bg-spiritual-50 rounded-lg sm:rounded-xl border border-spiritual-200 transition-colors gap-2">
                        <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-xs sm:text-sm flex-shrink-0">5</div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-xs sm:text-sm text-spiritual-900 truncate">Nneka Uche</p>
                                <p class="text-xs text-spiritual-600 truncate">Covenant Academy</p>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-primary-600 text-sm">90%</p>
                        </div>
                    </div>
                </div>

                <a href="#" class="text-xs sm:text-sm text-primary-600 hover:text-primary-700 font-medium mt-3 sm:mt-4 block text-center">
                    View Full Leaderboard →
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Chart.js Initialization Function -->
<script>
    function initChart() {
        // Wait for Chart to be available
        const checkChart = setInterval(() => {
            if (typeof Chart !== 'undefined' && Chart !== null) {
                clearInterval(checkChart);
                const ctx = document.getElementById('subjectChart');
                if (ctx) {
                    new Chart(ctx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Mathematics', 'English', 'Physics', 'Chemistry'],
                            datasets: [{
                                label: 'Score (%)',
                                data: [85, 72, 88, 78],
                                backgroundColor: [
                                    'rgb(59, 130, 246)',
                                    'rgb(168, 85, 247)',
                                    'rgb(34, 197, 94)',
                                    'rgb(245, 158, 11)'
                                ],
                                borderColor: [
                                    'rgb(37, 99, 235)',
                                    'rgb(147, 51, 234)',
                                    'rgb(22, 163, 74)',
                                    'rgb(217, 119, 6)'
                                ],
                                borderWidth: 2,
                                borderRadius: 8,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    padding: 12,
                                    titleFont: {
                                        size: 14,
                                        weight: 'bold'
                                    },
                                    bodyFont: {
                                        size: 13
                                    },
                                    borderColor: 'rgba(255, 255, 255, 0.2)',
                                    borderWidth: 1,
                                    borderRadius: 8,
                                    callbacks: {
                                        label: (ctx) => ctx.parsed.x + '%'
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    max: 100,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: 'rgb(107, 114, 128)',
                                        font: {
                                            size: 12
                                        },
                                        callback: (v) => v + '%'
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: 'rgb(55, 65, 81)',
                                        font: {
                                            size: 13,
                                            weight: '500'
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }
        }, 100);
    }
</script>
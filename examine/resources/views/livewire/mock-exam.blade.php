<div>
    @if(!$isCompleted)
    <!-- Quiz In Progress -->
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 pt-20 lg:pt-8 pb-8"
        x-data="{
            timeRemaining: @entangle('timeRemaining'),
            timeWarning: false,
            init() {
                const timer = setInterval(() => {
                    if (this.timeRemaining > 0) {
                        this.timeRemaining--;
                        if (this.timeRemaining === 60 && !this.timeWarning) {
                            this.timeWarning = true;
                        }
                        if (this.timeRemaining === 0) {
                            @this.submitExam();
                            clearInterval(timer);
                        }
                    }
                }, 1000);
            },
            formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                return mins + ':' + (secs < 10 ? '0' : '') + secs;
            }
        }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Main Quiz Area -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('welcome') }}"
                            class="flex items-center space-x-2 text-spiritual-600 hover:text-primary-600 transition-colors">
                            <x-lucide-arrow-left class="w-5 h-5" />
                            <span>Back</span>
                        </a>

                        <div class="flex items-center space-x-2 text-spiritual-600">
                            <x-lucide-clock class="w-5 h-5" />
                            <span class="font-mono" :class="timeRemaining < 60 ? 'text-error-600' : ''"
                                x-text="formatTime(timeRemaining)"></span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm text-spiritual-600">
                            <span>Question {{ $currentQuestionIndex + 1 }} of {{ count($exam['questions']) }}</span>
                            <span>{{ round($this->getProgress()) }}% Complete</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $this->getProgress() }}%;"></div>
                        </div>
                    </div>

                    <!-- Question Card -->
                    <div wire:key="question-{{ $currentQuestionIndex }}"
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-5"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="quiz-card">

                        @php
                        $currentQuestion = $this->getCurrentQuestion();
                        @endphp

                        <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-semibold text-spiritual-900 mb-2">
                                    {{ $currentQuestion['question'] }}
                                </h2>
                                @if(isset($currentQuestion['arabicText']))
                                <p class="text-lg font-arabic text-right text-spiritual-700 bg-spiritual-50 p-4 rounded-xl">
                                    {{ $currentQuestion['arabicText'] }}
                                </p>
                                @endif
                            </div>

                            <!-- Answer Options -->
                            <div class="space-y-3">
                                @if($currentQuestion['type'] === 'mcq' && isset($currentQuestion['choices']))
                                @foreach($currentQuestion['choices'] as $index => $choice)
                                <button
                                    wire:click="answerQuestion({{ $index }})"
                                    type="button"
                                    class="w-full p-4 text-left rounded-xl border-2 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]
                                            {{ $selectedAnswer === $index 
                                                ? 'border-primary-500 bg-primary-50 text-primary-700' 
                                                : 'border-spiritual-200 bg-white hover:border-spiritual-300' }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all
                                                {{ $selectedAnswer === $index 
                                                    ? 'border-primary-500 bg-primary-500' 
                                                    : 'border-spiritual-300' }}">
                                            @if($selectedAnswer === $index)
                                            <div class="w-2 h-2 bg-white rounded-full"></div>
                                            @endif
                                        </div>
                                        <span class="font-medium">{{ $choice }}</span>
                                    </div>
                                </button>
                                @endforeach
                                @endif

                                @if($currentQuestion['type'] === 'fill-blank')
                                <div>
                                    <input
                                        type="text"
                                        wire:model.blur="selectedAnswer"
                                        placeholder="Type your answer here..."
                                        class="input-field text-lg"
                                        autocomplete="off">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex items-center justify-between">
                        <button
                            wire:click="previousQuestion"
                            {{ $currentQuestionIndex === 0 ? 'disabled' : '' }}
                            class="bg-white text-spiritual-700 font-medium py-3 px-6 rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 border border-spiritual-200 hover:border-spiritual-300 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spiritual-500/50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <x-lucide-arrow-left class="w-4 h-4 mr-2" />
                            Previous
                        </button>

                        @if($this->isLastQuestion())
                        <button
                            wire:click="openConfirmModal"
                            {{ !$this->canGoNext() ? 'disabled' : '' }}
                            class="bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium py-3 px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <x-lucide-flag class="w-4 h-4 mr-2" />
                            Submit Quiz
                        </button>
                        @else
                        <button
                            wire:click="nextQuestion"
                            {{ !$this->canGoNext() ? 'disabled' : '' }}
                            class="bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium py-3 px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50 disabled:opacity-50 disabled:cursor-not-allowed">
                            Next
                            <x-lucide-arrow-right class="w-4 h-4 ml-2" />
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">

                    <!-- ScoreBoard -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-soft border border-white/20">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-center">
                                <div class="flex items-center justify-center space-x-1 text-primary-600 mb-1">
                                    <x-lucide-star class="w-4 h-4" />
                                    <span class="text-xs font-medium">Score</span>
                                </div>
                                <div class="text-xl font-bold text-spiritual-900">{{ $score }}</div>
                            </div>

                            <div class="text-center">
                                <div class="flex items-center justify-center space-x-1 text-success-600 mb-1">
                                    <x-lucide-target class="w-4 h-4" />
                                    <span class="text-xs font-medium">Accuracy</span>
                                </div>
                                <div class="text-xl font-bold text-spiritual-900">{{ $this->getAccuracy() }}%</div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <!-- Progress -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs font-medium text-spiritual-600">Progress</span>
                                    <span class="text-xs text-spiritual-500">{{ $currentQuestionIndex + 1 }}/{{ count($exam['questions']) }}</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $this->getProgress() }}%;"></div>
                                </div>
                            </div>

                            <!-- Time Remaining -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-1 text-warning-600">
                                    <x-lucide-clock class="w-4 h-4" />
                                    <span class="text-xs font-medium">Time</span>
                                </div>
                                <span class="text-sm font-mono font-bold"
                                    :class="timeRemaining < 60 ? 'text-error-600' : 'text-spiritual-700'"
                                    x-text="formatTime(timeRemaining)"></span>
                            </div>

                            <!-- Correct Answers -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-1 text-success-600">
                                    <x-lucide-trophy class="w-4 h-4" />
                                    <span class="text-xs font-medium">Correct</span>
                                </div>
                                <span class="text-sm font-bold text-spiritual-700">
                                    {{ $this->getCorrectAnswersCount() }}/{{ $currentQuestionIndex + 1 }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Question Navigator -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-soft border border-white/20">
                        <h3 class="font-semibold text-spiritual-900 mb-4">Questions</h3>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($exam['questions'] as $index => $question)
                            <button
                                wire:click="goToQuestion({{ $index }})"
                                class="w-10 h-10 rounded-lg text-sm font-medium transition-all
                                    {{ $index === $currentQuestionIndex 
                                        ? 'bg-primary-500 text-white' 
                                        : ($answers[$question['id']] !== null && $answers[$question['id']] !== ''
                                            ? 'bg-success-100 text-success-700 border border-success-300'
                                            : 'bg-spiritual-100 text-spiritual-600 hover:bg-spiritual-200') }}">
                                {{ $index + 1 }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        @if($showConfirmModal)
        <div x-data="{ open: true }"
            x-show="open"
            @click.self="$wire.closeConfirmModal()"
            style="display: none;"
            x-init="$nextTick(() => { open = true })"
            class="fixed inset-0 z-50 flex items-center justify-center p-4">

            <!-- Backdrop -->
            <div x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

            <!-- Modal -->
            <div x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-5"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-5"
                @click.stop
                class="relative w-full max-w-md bg-white rounded-2xl shadow-strong overflow-hidden z-10">

                <div class="flex items-center justify-between p-6 border-b border-spiritual-200">
                    <h3 class="text-lg font-semibold text-spiritual-900">Submit Quiz</h3>
                    <button
                        wire:click="closeConfirmModal"
                        class="p-2 text-spiritual-400 hover:text-spiritual-600 hover:bg-spiritual-100 rounded-lg transition-colors">
                        <x-lucide-x class="w-5 h-5" />
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <p class="text-spiritual-600">
                        Are you sure you want to submit your quiz? You won't be able to change your answers after submission.
                    </p>
                    <div class="flex space-x-3">
                        <button
                            wire:click="closeConfirmModal"
                            class="flex-1 bg-white text-spiritual-700 font-medium py-3 px-6 rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 border border-spiritual-200 hover:border-spiritual-300 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spiritual-500/50">
                            Cancel
                        </button>
                        <button
                            wire:click="submitExam"
                            class="flex-1 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium py-3 px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @else
    <!-- Quiz Completed -->
    <div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 flex items-center justify-center p-4"
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 100)">
        <div x-show="show"
            x-transition:enter="transition ease-out duration-600"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            class="w-full max-w-md bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-strong text-center">

            <div class="w-20 h-20 bg-gradient-to-br from-success-500 to-success-600 rounded-full mx-auto mb-6 flex items-center justify-center animate-bounce-gentle">
                <x-lucide-check-circle class="w-10 h-10 text-white" />
            </div>

            <h2 class="text-2xl font-bold text-spiritual-900 mb-2">Quiz Completed!</h2>
            <p class="text-spiritual-600 mb-6">Congratulations! You have completed the quiz.</p>

            <div class="space-y-4 mb-8">
                <div class="flex justify-between items-center py-2 border-b border-spiritual-200">
                    <span class="text-spiritual-600">Final Score:</span>
                    <span class="font-bold text-primary-600">{{ $score }} points</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-spiritual-200">
                    <span class="text-spiritual-600">Correct Answers:</span>
                    <span class="font-bold text-success-600">{{ $correctAnswersCount }}/{{ count($exam['questions']) }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-spiritual-600">Accuracy:</span>
                    <span class="font-bold text-spiritual-900">
                        {{ round(($correctAnswersCount / count($exam['questions'])) * 100) }}%
                    </span>
                </div>
            </div>

            <div class="space-y-3">
                <a href="{{ route('welcome') }}"
                    class="w-full bg-gradient-to-r from-primary-500 to-primary-600 text-white font-medium py-3 px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500/50">
                    View Results
                </a>
                <button
                    wire:click="playAgain"
                    class="w-full bg-white text-spiritual-700 font-medium py-3 px-6 rounded-xl shadow-soft hover:shadow-medium transition-all duration-300 border border-spiritual-200 hover:border-spiritual-300 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-spiritual-500/50">
                    Play Again
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
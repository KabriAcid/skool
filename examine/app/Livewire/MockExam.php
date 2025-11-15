<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class MockExam extends Component
{
    // Quiz State
    public $exam;
    public $currentQuestionIndex = 0;
    public $answers = [];
    public $timeRemaining;
    public $isCompleted = false;
    public $score = 0;
    public $correctAnswersCount = 0;
    public $startTime;

    // UI State
    public $selectedAnswer = '';
    public $showConfirmModal = false;

    public function updatedSelectedAnswer($value)
    {
        // When selectedAnswer changes (for fill-blank inputs), update answers array
        $currentQuestion = $this->getCurrentQuestion();
        if ($currentQuestion && $currentQuestion['type'] === 'fill-blank') {
            $this->answers[$currentQuestion['id']] = $value;
        }
    }

    public function mount($examId = null)
    {
        // Mock quiz data - matches React version exactly
        $this->exam = [
            'id' => '1',
            'title' => 'Quran Knowledge Test',
            'description' => 'Test your knowledge of the Holy Quran',
            'timeLimit' => 600, // 10 minutes
            'category' => 'quran',
            'difficulty' => 'medium',
            'totalPoints' => 500,
            'questions' => [
                [
                    'id' => '1',
                    'type' => 'mcq',
                    'question' => 'How many chapters (Surahs) are there in the Quran?',
                    'choices' => ['112', '113', '114', '115'],
                    'correctAnswer' => 2,
                    'explanation' => 'The Quran contains 114 chapters (Surahs).',
                    'difficulty' => 'easy',
                    'category' => 'quran',
                    'points' => 10,
                ],
                [
                    'id' => '2',
                    'type' => 'mcq',
                    'question' => 'Which Surah is known as the "Heart of the Quran"?',
                    'choices' => ['Al-Fatiha', 'Yasin', 'Al-Baqarah', 'Al-Ikhlas'],
                    'correctAnswer' => 1,
                    'explanation' => 'Surah Yasin is often referred to as the "Heart of the Quran".',
                    'difficulty' => 'medium',
                    'category' => 'quran',
                    'points' => 15,
                ],
                [
                    'id' => '3',
                    'type' => 'fill-blank',
                    'question' => 'Complete the verse: "And whoever relies upon Allah - then He is _______ for him."',
                    'correctAnswer' => 'sufficient',
                    'explanation' => 'The complete verse is from Surah At-Talaq (65:3).',
                    'difficulty' => 'medium',
                    'category' => 'quran',
                    'points' => 20,
                ],
            ],
        ];

        $this->timeRemaining = $this->exam['timeLimit'];
        $this->startTime = now();

        // Initialize answers array
        foreach ($this->exam['questions'] as $question) {
            $this->answers[$question['id']] = null;
        }
    }

    public function answerQuestion($answer)
    {
        $currentQuestion = $this->getCurrentQuestion();
        if ($currentQuestion) {
            $this->answers[$currentQuestion['id']] = $answer;
            $this->selectedAnswer = $answer;
        }
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->exam['questions']) - 1) {
            $this->currentQuestionIndex++;
            $this->loadCurrentAnswer();
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
            $this->loadCurrentAnswer();
        }
    }

    public function goToQuestion($index)
    {
        $this->currentQuestionIndex = $index;
        $this->loadCurrentAnswer();
    }

    public function loadCurrentAnswer()
    {
        $currentQuestion = $this->getCurrentQuestion();
        if ($currentQuestion) {
            $this->selectedAnswer = $this->answers[$currentQuestion['id']] ?? '';
        }
    }

    public function openConfirmModal()
    {
        $this->showConfirmModal = true;
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
    }

    public function submitExam()
    {
        $this->calculateScore();
        $this->isCompleted = true;
        $this->showConfirmModal = false;
    }

    public function calculateScore()
    {
        $totalScore = 0;
        $correctCount = 0;

        foreach ($this->exam['questions'] as $question) {
            $userAnswer = $this->answers[$question['id']] ?? null;

            if ($question['type'] === 'fill-blank') {
                // Case-insensitive comparison for fill-in-the-blank
                if (strtolower(trim($userAnswer)) === strtolower(trim($question['correctAnswer']))) {
                    $totalScore += $question['points'];
                    $correctCount++;
                }
            } else {
                // Exact match for MCQ
                if ($userAnswer === $question['correctAnswer']) {
                    $totalScore += $question['points'];
                    $correctCount++;
                }
            }
        }

        $this->score = $totalScore;
        $this->correctAnswersCount = $correctCount;
    }

    public function playAgain()
    {
        return redirect()->route('mock.exam', ['examId' => $this->exam['id']]);
    }

    public function getCurrentQuestion()
    {
        return $this->exam['questions'][$this->currentQuestionIndex] ?? null;
    }

    public function getProgress()
    {
        return (($this->currentQuestionIndex + 1) / count($this->exam['questions'])) * 100;
    }

    public function getCorrectAnswersCount()
    {
        $correctCount = 0;
        $answeredCount = 0;

        foreach ($this->exam['questions'] as $index => $question) {
            // Only count questions up to current index
            if ($index > $this->currentQuestionIndex) {
                break;
            }

            $userAnswer = $this->answers[$question['id']] ?? null;
            if ($userAnswer !== null && $userAnswer !== '') {
                $answeredCount++;

                if ($question['type'] === 'fill-blank') {
                    if (strtolower(trim($userAnswer)) === strtolower(trim($question['correctAnswer']))) {
                        $correctCount++;
                    }
                } else {
                    if ($userAnswer === $question['correctAnswer']) {
                        $correctCount++;
                    }
                }
            }
        }

        return $correctCount;
    }

    public function getAccuracy()
    {
        $answeredCount = 0;
        foreach ($this->answers as $answer) {
            if ($answer !== null && $answer !== '') {
                $answeredCount++;
            }
        }

        if ($answeredCount === 0) {
            return 0;
        }

        return round(($this->getCorrectAnswersCount() / $answeredCount) * 100);
    }

    public function isLastQuestion()
    {
        return $this->currentQuestionIndex === count($this->exam['questions']) - 1;
    }

    public function canGoNext()
    {
        return $this->selectedAnswer !== '' && $this->selectedAnswer !== null;
    }

    public function render()
    {
        return view('livewire.mock-exam', [
            'pageTitle' => 'Practice Quiz',
            'currentPage' => 'mock-exam',
            'pageDescription' => $this->exam['title'] ?? 'Take a practice quiz'
        ]);
    }
}

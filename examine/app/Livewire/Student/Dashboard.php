<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.student')]
#[Title('Dashboard - Examine CBT')]
class Dashboard extends Component
{
    public $stats = [];
    public $upcomingExams = [];
    public $recentResults = [];
    public $isLoading = true;

    public function mount()
    {
        $this->loadStats();
        $this->loadUpcomingExams();
        $this->loadRecentResults();
        $this->isLoading = false;
    }

    public function loadStats()
    {
        // TODO: Get real data from database
        $this->stats = [
            'total_exams' => 12,
            'completed' => 8,
            'average_score' => 75,
            'total_time' => '24 hrs',
            'best_subject' => 'Mathematics',
            'rank' => 15,
        ];
    }

    public function loadUpcomingExams()
    {
        // TODO: Get real upcoming exams from database
        $this->upcomingExams = [
            [
                'id' => 1,
                'title' => 'JAMB Physics 2025 Mock',
                'subject' => 'Physics',
                'duration' => '2 hours',
                'questions' => 40,
                'scheduled_at' => now()->addDays(2),
            ],
            [
                'id' => 2,
                'title' => 'WAEC Chemistry Practice',
                'subject' => 'Chemistry',
                'duration' => '1.5 hours',
                'questions' => 30,
                'scheduled_at' => now()->addDays(5),
            ],
        ];
    }

    public function loadRecentResults()
    {
        // TODO: Get real recent results from database
        $this->recentResults = [
            [
                'exam' => 'Mathematics JAMB',
                'score' => 85,
                'total' => 100,
                'percentage' => 85,
                'date' => now()->subDays(2),
                'status' => 'passed',
            ],
            [
                'exam' => 'English WAEC',
                'score' => 72,
                'total' => 100,
                'percentage' => 72,
                'date' => now()->subDays(5),
                'status' => 'passed',
            ],
        ];
    }

    public function startExam($examId)
    {
        return redirect()->route('mock.exam', ['examId' => $examId]);
    }

    public function render()
    {
        return view('livewire.student.dashboard', [
            'pageTitle' => 'Dashboard',
            'currentPage' => 'dashboard',
        ]);
    }
}

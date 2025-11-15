<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class MobileMore extends Component
{
    public function render()
    {
        return view('livewire.student.mobile-more', [
            'pageTitle' => 'More Options',
            'currentPage' => 'more'
        ]);
    }
}

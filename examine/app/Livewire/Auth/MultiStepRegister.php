<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\School;
use App\Models\State;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use App\Mail\SchoolRegistrationMail;

#[Layout('components.guest-layout')]
class MultiStepRegister extends Component
{
    // Account Type
    public $accountType = ''; // student or school_admin

    // Step tracking
    public $currentStep = 0;
    public $totalSteps = 0; // Changes based on account type

    // Student fields (Step 1-3)
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    // School admin fields (Step 1-5)
    public $adminName = '';
    public $adminPhone = '';
    public $adminEmail = '';
    public $schoolName = '';
    public $schoolPhone = '';
    public $schoolEmail = '';
    public $schoolState = '';
    public $schoolCity = '';
    public $schoolAddress = '';
    public $numberOfStudents = 50;
    public $adminPassword = '';
    public $adminPassword_confirmation = '';
    public $agreeToTerms = false;

    // States list
    public $states = [];

    // Success modal
    public $showSuccessModal = false;
    public $registrationData = [];

    protected function rules()
    {
        if ($this->accountType === 'student') {
            return $this->getStudentRules();
        }

        return $this->getSchoolAdminRules();
    }

    protected function getStudentRules()
    {
        $rules = [];

        if ($this->currentStep === 1) {
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
            ];
        }

        if ($this->currentStep === 2) {
            $rules = [
                'password' => ['required', 'confirmed', Password::min(8)],
            ];
        }

        if ($this->currentStep === 3) {
            $rules = [
                'agreeToTerms' => ['accepted'],
            ];
        }

        return $rules;
    }

    protected function getSchoolAdminRules()
    {
        $rules = [];

        if ($this->currentStep === 1) {
            $rules = [
                'adminName' => ['required', 'string', 'max:255'],
                'adminPhone' => ['required', 'string', 'max:20'],
                'adminEmail' => ['required', 'email', 'unique:users,email'],
            ];
        }

        if ($this->currentStep === 2) {
            $rules = [
                'schoolName' => ['required', 'string', 'max:255'],
                'schoolPhone' => ['required', 'string', 'max:20'],
                'schoolEmail' => ['required', 'email', 'unique:schools,email'],
                'schoolState' => ['required', 'string'],
                'schoolCity' => ['required', 'string', 'max:255'],
            ];
        }

        if ($this->currentStep === 3) {
            $rules = [
                'schoolAddress' => ['required', 'string', 'max:500'],
                'numberOfStudents' => ['required', 'integer', 'min:10', 'max:10000'],
            ];
        }

        if ($this->currentStep === 4) {
            $rules = [
                'adminPassword' => ['required', 'confirmed', Password::min(8)],
            ];
        }

        if ($this->currentStep === 5) {
            $rules = [
                'agreeToTerms' => ['accepted'],
            ];
        }

        return $rules;
    }

    public function mount()
    {
        $this->loadStates();

        // Auto-select role from URL query if provided (?role=student or ?role=school_admin)
        $roleParam = request()->query('role');
        if (in_array($roleParam, ['student', 'school_admin'])) {
            $this->accountType = $roleParam;
            $this->currentStep = 1; // Start at first step immediately
            $this->updateTotalSteps();
        }
    }

    protected function loadStates()
    {
        $this->states = State::orderBy('state_name')->pluck('state_name', 'id')->toArray();
    }

    public function updatedAccountType($value)
    {
        if ($value) {
            $this->currentStep = 1;
            $this->updateTotalSteps();
            $this->resetValidation();
        }
    }

    protected function updateTotalSteps()
    {
        $this->totalSteps = $this->accountType === 'student' ? 3 : 5;
    }

    public function nextStep()
    {
        $this->validate();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->resetValidation();
        }
    }

    public function register()
    {
        $this->validate();

        if ($this->accountType === 'student') {
            $this->registerStudent();
        } else {
            $this->registerSchoolAdmin();
        }
    }

    protected function registerStudent()
    {
        DB::transaction(function () {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'student',
            ]);

            Auth::login($user);
        });

        return redirect()->route('student.dashboard');
    }

    protected function registerSchoolAdmin()
    {
        DB::transaction(function () {
            // Create school
            $school = School::create([
                'name' => $this->schoolName,
                'code' => $this->generateSchoolCode(),
                'email' => $this->schoolEmail,
                'phone' => $this->schoolPhone,
                'state' => $this->schoolState,
                'city' => $this->schoolCity,
                'address' => $this->schoolAddress,
                'status' => 'pending',
                'max_students' => $this->numberOfStudents,
                'current_students' => 0,
            ]);

            // Create admin user
            $admin = User::create([
                'name' => $this->adminName,
                'email' => $this->adminEmail,
                'password' => Hash::make($this->adminPassword),
                'role' => 'school_admin',
                'school_id' => $school->id,
            ]);

            // Calculate amount (₦1000 per student)
            $amount = $this->numberOfStudents * 1000;

            $this->registrationData = [
                'school_name' => $school->name,
                'school_code' => $school->code,
                'admin_name' => $admin->name,
                'admin_email' => $admin->email,
                'number_of_students' => $this->numberOfStudents,
                'amount' => $amount,
                'formatted_amount' => '₦' . number_format($amount, 2),
            ];

            // Send email with payment instructions
            try {
                Mail::to($admin->email)->send(new SchoolRegistrationMail($school, $admin, $amount));
            } catch (\Exception $e) {
                // Log error but don't fail registration
                \Log::error('Failed to send school registration email: ' . $e->getMessage());
            }

            $this->showSuccessModal = true;
        });
    }

    protected function generateSchoolCode()
    {
        do {
            $code = 'SCH' . strtoupper(Str::random(6));
        } while (School::where('code', $code)->exists());

        return $code;
    }

    public function render()
    {
        return view('livewire.auth.multi-step-register', [
            'states' => $this->states,
        ]);
    }
}

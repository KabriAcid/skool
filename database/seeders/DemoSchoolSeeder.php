<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{School, User, Student, Subject};

class DemoSchoolSeeder extends Seeder
{
    public function run(): void
    {
        // Create demo school
        $school = School::create([
            'name' => 'Demo High School',
            'code' => 'DEMO001',
            'email' => 'admin@demoschool.com',
            'phone' => '08012345678',
            'address' => '123 Education Avenue, Lagos, Nigeria',
            'status' => 'active',
            'max_students' => 200,
            'current_students' => 0,
        ]);

        // Create Super Admin
        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@examine.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'school_id' => null,
            'is_active' => true,
        ]);

        // Create School Admin
        User::create([
            'name' => 'School Administrator',
            'email' => 'admin@demoschool.com',
            'password' => Hash::make('password'),
            'role' => 'school_admin',
            'school_id' => $school->id,
            'is_active' => true,
        ]);

        // Create Demo Student
        $studentUser = User::create([
            'name' => 'Demo Student',
            'email' => 'student@demoschool.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'school_id' => $school->id,
            'is_active' => true,
        ]);

        // Get first 4 science subjects for demo
        $subjects = Subject::whereIn('code', ['MTH', 'PHY', 'CHM', 'BIO'])->pluck('id')->toArray();

        Student::create([
            'school_id' => $school->id,
            'user_id' => $studentUser->id,
            'student_id' => 'STU001',
            'full_name' => 'Demo Student',
            'class' => 'SS3',
            'department' => 'Science',
            'exam_type' => 'JAMB',
            'selected_subjects' => json_encode($subjects),
            'total_exams_taken' => 0,
            'average_score' => 0,
        ]);

        $school->update(['current_students' => 1]);

        $this->command->info('✅ Demo school created successfully!');
        $this->command->info('📧 Login Credentials:');
        $this->command->line('');
        $this->command->info('Super Admin:');
        $this->command->line('Email: superadmin@examine.com');
        $this->command->line('Password: password');
        $this->command->line('');
        $this->command->info('School Admin:');
        $this->command->line('Email: admin@demoschool.com');
        $this->command->line('Password: password');
        $this->command->line('');
        $this->command->info('Student:');
        $this->command->line('Email: student@demoschool.com');
        $this->command->line('Password: password');
    }
}

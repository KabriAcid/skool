<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            // Science Subjects
            ['name' => 'Mathematics', 'code' => 'MTH', 'category' => 'science', 'description' => 'Pure and Applied Mathematics'],
            ['name' => 'Physics', 'code' => 'PHY', 'category' => 'science', 'description' => 'Physical Sciences'],
            ['name' => 'Chemistry', 'code' => 'CHM', 'category' => 'science', 'description' => 'Chemical Sciences'],
            ['name' => 'Biology', 'code' => 'BIO', 'category' => 'science', 'description' => 'Biological Sciences'],
            ['name' => 'Agricultural Science', 'code' => 'AGR', 'category' => 'science', 'description' => 'Agriculture'],
            ['name' => 'Computer Science', 'code' => 'CSC', 'category' => 'science', 'description' => 'Computing'],

            // Arts Subjects
            ['name' => 'English Language', 'code' => 'ENG', 'category' => 'general', 'description' => 'Language and Literature'],
            ['name' => 'Literature in English', 'code' => 'LIT', 'category' => 'arts', 'description' => 'Literature Studies'],
            ['name' => 'Government', 'code' => 'GOV', 'category' => 'arts', 'description' => 'Political Science'],
            ['name' => 'History', 'code' => 'HIS', 'category' => 'arts', 'description' => 'Historical Studies'],
            ['name' => 'Geography', 'code' => 'GEO', 'category' => 'arts', 'description' => 'Physical and Human Geography'],
            ['name' => 'Christian Religious Studies', 'code' => 'CRS', 'category' => 'arts', 'description' => 'Christian Studies'],
            ['name' => 'Islamic Religious Studies', 'code' => 'IRS', 'category' => 'arts', 'description' => 'Islamic Studies'],

            // Commercial Subjects
            ['name' => 'Economics', 'code' => 'ECO', 'category' => 'commercial', 'description' => 'Economic Sciences'],
            ['name' => 'Commerce', 'code' => 'COM', 'category' => 'commercial', 'description' => 'Business and Trade'],
            ['name' => 'Accounting', 'code' => 'ACC', 'category' => 'commercial', 'description' => 'Financial Accounting'],
            ['name' => 'Business Studies', 'code' => 'BUS', 'category' => 'commercial', 'description' => 'Business Management'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}

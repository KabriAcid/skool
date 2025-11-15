<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_id')->unique()->comment('School-specific student ID');
            $table->string('full_name');
            $table->string('class')->nullable();
            $table->string('department')->nullable();
            $table->string('exam_type')->nullable()->comment('JAMB, WAEC, NECO');
            $table->json('selected_subjects')->nullable()->comment('4 subjects array');
            $table->integer('total_exams_taken')->default(0);
            $table->decimal('average_score', 5, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

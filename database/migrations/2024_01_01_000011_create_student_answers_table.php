<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_attempt_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained();
            $table->char('selected_answer', 1)->nullable()->comment('A, B, C, D, or E');
            $table->boolean('is_correct')->default(false);
            $table->boolean('is_flagged')->default(false);
            $table->integer('time_spent')->nullable();
            $table->timestamps();

            $table->unique(['exam_attempt_id', 'question_id']);
            $table->index('subject_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};

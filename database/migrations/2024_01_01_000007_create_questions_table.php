<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->text('question');
            $table->json('options')->comment('JSON: {A: "", B: "", C: "", D: "", E: ""}');
            $table->char('correct_answer', 1)->comment('A, B, C, D, or E');
            $table->text('explanation')->nullable();
            $table->string('topic')->nullable();
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium');
            $table->enum('source', ['ai_generated', 'manual', 'csv_upload'])->default('manual');
            $table->string('ai_prompt_id')->nullable()->comment('Reference to AI prompt if generated');
            $table->integer('usage_count')->default(0)->comment('Times used in exams');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'subject_id']);
            $table->index('source');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_schedule_id')->constrained()->onDelete('cascade');
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->integer('time_spent')->nullable()->comment('Seconds');
            $table->json('subject_timers')->nullable()->comment('Time spent per subject');
            $table->integer('total_score')->default(0);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->json('subject_scores')->nullable()->comment('Score breakdown per subject');
            $table->enum('status', ['in_progress', 'completed', 'auto_submitted', 'abandoned'])->default('in_progress');
            $table->timestamps();

            $table->index(['student_id', 'status']);
            $table->index('exam_schedule_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};

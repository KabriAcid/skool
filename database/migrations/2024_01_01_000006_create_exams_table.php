<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('exam_type', ['jamb', 'waec', 'neco', 'custom'])->default('jamb');
            $table->integer('duration_minutes')->default(120)->comment('Total exam time');
            $table->integer('subject_duration_minutes')->default(30);
            $table->integer('questions_per_subject')->default(40);
            $table->integer('total_marks')->default(400)->comment('100 per subject');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

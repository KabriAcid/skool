<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->json('subject_ids')->comment('Array of 4 subject IDs');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_active')->default(true);
            $table->text('instructions')->nullable();
            $table->timestamps();

            $table->index(['exam_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            // Drop the existing enum column
            $table->dropColumn('status');
        });

        Schema::table('schools', function (Blueprint $table) {
            // Add the new enum column with pending status
            $table->enum('status', ['pending', 'active', 'suspended', 'expired'])->default('pending')->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('schools', function (Blueprint $table) {
            $table->enum('status', ['active', 'suspended', 'expired'])->default('active')->after('logo');
        });
    }
};

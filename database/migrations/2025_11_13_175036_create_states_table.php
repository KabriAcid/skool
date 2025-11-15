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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state_name');
            $table->string('capital')->nullable();
            $table->timestamps();
        });

        // Insert Nigerian states
        DB::table('states')->insert([
            ['state_name' => 'Abia', 'capital' => 'Umuahia'],
            ['state_name' => 'Adamawa', 'capital' => 'Yola'],
            ['state_name' => 'Akwa Ibom', 'capital' => 'Uyo'],
            ['state_name' => 'Anambra', 'capital' => 'Awka'],
            ['state_name' => 'Bauchi', 'capital' => 'Bauchi'],
            ['state_name' => 'Bayelsa', 'capital' => 'Yenagoa'],
            ['state_name' => 'Benue', 'capital' => 'Makurdi'],
            ['state_name' => 'Borno', 'capital' => 'Maiduguri'],
            ['state_name' => 'Cross River', 'capital' => 'Calabar'],
            ['state_name' => 'Delta', 'capital' => 'Asaba'],
            ['state_name' => 'Ebonyi', 'capital' => 'Abakaliki'],
            ['state_name' => 'Edo', 'capital' => 'Benin City'],
            ['state_name' => 'Ekiti', 'capital' => 'Ado-Ekiti'],
            ['state_name' => 'Enugu', 'capital' => 'Enugu'],
            ['state_name' => 'Gombe', 'capital' => 'Gombe'],
            ['state_name' => 'Imo', 'capital' => 'Owerri'],
            ['state_name' => 'Jigawa', 'capital' => 'Dutse'],
            ['state_name' => 'Kaduna', 'capital' => 'Kaduna'],
            ['state_name' => 'Kano', 'capital' => 'Kano'],
            ['state_name' => 'Katsina', 'capital' => 'Katsina'],
            ['state_name' => 'Kebbi', 'capital' => 'Birnin Kebbi'],
            ['state_name' => 'Kogi', 'capital' => 'Lokoja'],
            ['state_name' => 'Kwara', 'capital' => 'Ilorin'],
            ['state_name' => 'Lagos', 'capital' => 'Ikeja'],
            ['state_name' => 'Nasarawa', 'capital' => 'Lafia'],
            ['state_name' => 'Niger', 'capital' => 'Minna'],
            ['state_name' => 'Ogun', 'capital' => 'Abeokuta'],
            ['state_name' => 'Ondo', 'capital' => 'Akure'],
            ['state_name' => 'Osun', 'capital' => 'Osogbo'],
            ['state_name' => 'Oyo', 'capital' => 'Ibadan'],
            ['state_name' => 'Plateau', 'capital' => 'Jos'],
            ['state_name' => 'Rivers', 'capital' => 'Port Harcourt'],
            ['state_name' => 'Sokoto', 'capital' => 'Sokoto'],
            ['state_name' => 'Taraba', 'capital' => 'Jalingo'],
            ['state_name' => 'Yobe', 'capital' => 'Damaturu'],
            ['state_name' => 'Zamfara', 'capital' => 'Gusau'],
            ['state_name' => 'FCT', 'capital' => 'Abuja'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};

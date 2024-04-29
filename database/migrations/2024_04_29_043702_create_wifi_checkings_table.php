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
        Schema::create('wifi_checkings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('building_id')->constrained('buildings');
            $table->json('floor_1')->nullable();
            $table->json('floor_2')->nullable();
            $table->json('floor_3')->nullable();
            $table->json('floor_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wifi_checkings');
    }
};

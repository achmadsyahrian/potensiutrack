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
        Schema::create('wifi_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('floor_id')->constrained('floors');
            $table->string('accesspoint');
            $table->string('device_name')->nullable();
            $table->string('device_condition')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wifi_checks');
    }
};

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
        Schema::create('app_checkings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_app_id')->constrained('web_apps')->onDelete('cascade')->nullable();
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->json('result')->nullable();
            $table->timestamps();
            
            $table->unique(['month', 'year', 'web_app_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_checkings');
    }
};






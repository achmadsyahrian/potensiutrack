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
            // $table->foreignId('web_app_id')->constrained('web_apps')->onDelete('cascade');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->json('result')->nullable();
            $table->string('kabag_signature')->nullable();
            $table->string('wakil_rektor_signature')->nullable();
            $table->string('puskom_signature')->nullable();
            $table->timestamps();
            
            $table->unique(['month', 'year']);
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






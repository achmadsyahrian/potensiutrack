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
        Schema::create('lab_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_id')->constrained()->onDelete('cascade');
            $table->foreignId('lecturer_id')->constrained('users')->onDelete('cascade');
            $table->string('course'); //mata kuliah
            $table->string('course_topic'); // materi kuliah
            $table->string('course_credits'); //sks
            $table->string('class');
            $table->date('date');
            $table->time('time');
            $table->string('lecturer_signature')->nullable();
            $table->string('lab_assistant_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_usages');
    }
};

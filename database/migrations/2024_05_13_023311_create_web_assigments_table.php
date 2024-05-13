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
        Schema::create('web_assignments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('programmer_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('web_app_id')->constrained('web_apps')->onDelete('cascade');
            $table->string('application');
            $table->enum('assignment_type', ['maintenance', 'development']);
            $table->date('finish_date')->nullable();
            $table->string('programmer_signature')->nullable();
            $table->string('kabag_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_assignments');
    }
};

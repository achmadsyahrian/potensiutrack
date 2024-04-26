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
        Schema::create('web_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->foreignId('reported_by_id')->constrained('users');
            $table->text('error');
            $table->text('puskom_signature');
            $table->text('handling')->nullable();
            $table->text('reporter_signature')->nullable();
            $table->date('finish_date')->nullable();
            $table->enum('status', [1, 2, 3])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_maintenances');
    }
};

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
        Schema::create('lab_daily_check_monthly_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_id')->constrained()->onDelete('cascade');
            $table->unsignedSmallInteger('month');
            $table->unsignedSmallInteger('year');
            $table->string('kabag_signature')->nullable();
            $table->string('wakil_rektor_signature')->nullable();
            $table->string('teknisi_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_daily_check_monthly_reports');
    }
};

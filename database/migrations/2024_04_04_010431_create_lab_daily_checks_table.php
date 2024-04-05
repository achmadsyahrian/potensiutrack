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
        Schema::create('lab_daily_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id');
            $table->date('date');
            $table->json('results');
            $table->json('descriptions');
            $table->unsignedBigInteger('optional_user_id')->nullable();
            $table->unsignedBigInteger('mandatory_user_id');
            $table->timestamps();
    
            $table->foreign('lab_id')->references('id')->on('labs');
            $table->foreign('optional_user_id')->references('id')->on('users')->onDelete('set null');;
            $table->foreign('mandatory_user_id')->references('id')->on('users');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_daily_checks');
    }
};

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
        Schema::create('network_assignments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('engineer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade');
            $table->enum('assignment_type', ['troubleshooting', 'development']);
            $table->date('finish_date')->nullable();
            $table->string('engineer_signature')->nullable();
            $table->string('kabag_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_assignments');
    }
};

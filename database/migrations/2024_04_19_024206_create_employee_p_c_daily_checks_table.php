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
        Schema::create('employee_pc_daily_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('monitor_inventory_code');
            $table->string('cpu_inventory_code');
            $table->boolean('keyboard_condition');
            $table->boolean('mouse_condition');
            $table->boolean('monitor_condition');
            $table->boolean('cpu_condition');
            $table->boolean('internet_condition');
            $table->boolean('printer_condition');
            $table->boolean('scanner_condition');
            $table->string('complaint')->nullable();
            $table->string('technician_signature')->nullable();
            $table->string('employee_signature')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_pc_daily_checks');
    }
};

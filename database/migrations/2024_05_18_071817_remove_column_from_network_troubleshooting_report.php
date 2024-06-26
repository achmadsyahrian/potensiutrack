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
        Schema::table('network_troubleshooting_monthly_reports', function (Blueprint $table) {
            $table->dropColumn('month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('network_troubleshooting_monthly_reports', function (Blueprint $table) {
            $table->unsignedSmallInteger('month');
        });
    }
};

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
        Schema::table('web_maintenances', function (Blueprint $table) {
            $table->foreignId('web_app_id')->constrained('web_apps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_maintenances', function (Blueprint $table) {
            $table->dropColumn('web_app_id');
        });
    }
};

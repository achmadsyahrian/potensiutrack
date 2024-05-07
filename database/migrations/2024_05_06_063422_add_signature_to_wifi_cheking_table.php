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
        Schema::table('wifi_checkings', function (Blueprint $table) {
            $table->string('kabag_signature')->nullable();
            $table->string('wakil_rektor_signature')->nullable();
            $table->string('puskom_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wifi_checkings', function (Blueprint $table) {
            $table->dropColumn('kabag_signature');
            $table->dropColumn('wakil_rektor_signature');
            $table->dropColumn('puskom_signature');
        });
    }
};

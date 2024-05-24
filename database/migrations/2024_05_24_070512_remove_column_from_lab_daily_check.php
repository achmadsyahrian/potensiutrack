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
        Schema::table('lab_daily_checks', function (Blueprint $table) {
            $table->dropForeign(['optional_user_id']);
            $table->dropColumn('optional_user_id');
            $table->dropForeign(['mandatory_user_id']);
            $table->dropColumn('mandatory_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lab_daily_checks', function (Blueprint $table) {
            $table->unsignedBigInteger('optional_user_id');
            $table->unsignedBigInteger('mandatory_user_id');
        });
    }
};

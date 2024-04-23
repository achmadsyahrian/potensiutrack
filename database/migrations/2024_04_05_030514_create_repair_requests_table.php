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
        Schema::create('repair_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade'); // Karyawan yang merupakan pemohon perbaikan (dari relasi user)
            $table->foreignId('technician_id')->nullable()->constrained('users')->onDelete('set null'); // Teknisi yang ditugaskan (dari relasi user)
            $table->foreignId('division_id')->nullable()->constrained('divisions')->onDelete('set null'); // Divisi yang terkait
            $table->foreignId('item_inventory_id')->constrained('item_inventories')->onDelete('cascade'); // Divisi yang terkait
            $table->string('inventory_code'); // Kode inventaris barang yang rusak
            $table->string('fault_description')->nullable(); // Deskripsi kerusakan barang
            $table->text('repair_solution')->nullable(); // Solusi perbaikan
            $table->string('employee_signature')->nullable();
            $table->string('technician_signature')->nullable();
            $table->date('date');
            $table->date('return_date')->nullable(); // Tanggal pengembalian
            $table->enum('status', [1, 2, 3, 4, 5])->default(1);
            // 1 = Baru
            // 2 = Sudah diperbaiki / diberikan
            // 3 = Sudah diterima
            // 4 = Sudah disetujui
            // 5 = Tidak disetujui

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_requests');
    }
};

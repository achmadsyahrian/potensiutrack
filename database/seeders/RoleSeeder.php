<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrator',
            'description' => 'Administrator memiliki hak akses tertinggi dan kontrol penuh atas sistem.'
        ]);

        Role::create([
            'name' => 'Kabag',
            'description' => 'Kabag memiliki wewenang untuk mengkonfirmasi tindakan dan keputusan.'
        ]);

        Role::create([
            'name' => 'Asisten Lab',
            'description' => 'Asisten Lab membantu dalam kegiatan laboratorium dan mendukung proses pengajaran.'
        ]);

        Role::create([
            'name' => 'Teknisi',
            'description' => 'Teknisi bertanggung jawab untuk menangani perbaikan dan pemeliharaan teknis.'
        ]);

        Role::create([
            'name' => 'Karyawan',
            'description' => 'Karyawan hanya bertugas melihat dan memverifikasi daftar permohonan perawatan perangkat.'
        ]);
    }
}

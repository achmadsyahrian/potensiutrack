<?php

namespace Database\Seeders;

use App\Models\WebApp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebApp::create([
            'name' => 'Potensi Utama',
            'url' => 'https://potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'CSRID',
            'url' => 'https://csrid.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Sister',
            'url' => 'http://sister.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Sista',
            'url' => 'https://sista.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Portal',
            'url' => 'http://portal.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Portal Alumni',
            'url' => 'http://portalalumni.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Digital Library',
            'url' => 'http://digilib.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Portal PMB',
            'url' => 'http://pmb.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Admin Kuesioner',
            'url' => 'https://adminkuesioner.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Kuesioner',
            'url' => 'http://kuesioner.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Siku',
            'url' => 'http://siku.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'SDM',
            'url' => 'http://sdm.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Inventory',
            'url' => 'https://inventori.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'USM',
            'url' => 'http://usm.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Siman',
            'url' => 'http://siman.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Akademik',
            'url' => 'https://akademik.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Portal Riset',
            'url' => 'https://portalriset.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Repository',
            'url' => 'http://repository.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Fakultas Seni Desain',
            'url' => 'http://fsd.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Fakultas Teknik Ilmu Komputer',
            'url' => 'http://ftik.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'FPIK',
            'url' => 'http://fpik.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Fakultas Psikologi',
            'url' => 'http://fpsi.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Fakultas Ekonomi Bisnis',
            'url' => 'http://feb.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Fakultas Hukum',
            'url' => 'http://fh.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Lapor',
            'url' => 'http://lapor.potensi-utama.ac.id/',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Sistem Pengontrolan Pegawai',
            'url' => '',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Sistem Peminjaman Proyektor',
            'url' => '',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'Aplikasi Mini Bank Potensi Utama',
            'url' => '',
            'description' => '-'
        ]);
        WebApp::create([
            'name' => 'SKPI',
            'url' => 'https://skpi.potensi-utama.org/',
            'description' => '-'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Lab;
use App\Models\Programmer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Programmer::create([
            'name' => 'Briyandana',
        ]);
        Programmer::create([
            'name' => 'Achmad Syahrian',
        ]);
    }
}

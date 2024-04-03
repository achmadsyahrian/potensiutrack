<?php

namespace Database\Seeders;

use App\Models\Computer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($lab_id = 1; $lab_id <= 4; $lab_id++) {
            for ($computer_num = 1; $computer_num <= 41; $computer_num++) {
                Computer::create([
                    'lab_id' => $lab_id,
                    'name' => 'Computer ' . $computer_num,
                ]);
            }
        }
    }
}

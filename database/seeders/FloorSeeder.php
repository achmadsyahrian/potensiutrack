<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Lab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($building_id = 1; $building_id <= 2; $building_id++) {
            for ($floor_num = 1; $floor_num <= 4; $floor_num++) {
                Floor::create([
                    'building_id' => $building_id,
                    'name' => 'Lantai ' . $floor_num,
                ]);
            }
        }
    }
}

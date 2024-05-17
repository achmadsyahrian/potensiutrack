<?php

namespace Database\Seeders;

use App\Models\HeadLabAssistant as ModelsHeadLabAssistant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeadLabAssistant extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsHeadLabAssistant::create([
            'user_id' => '12',
            'lab_id' => '1',
        ]);
        ModelsHeadLabAssistant::create([
            'user_id' => '13',
            'lab_id' => '2',
        ]);
        ModelsHeadLabAssistant::create([
            'user_id' => '14',
            'lab_id' => '3',
        ]);
        ModelsHeadLabAssistant::create([
            'user_id' => '15',
            'lab_id' => '4',
        ]);
        ModelsHeadLabAssistant::create([
            'user_id' => '16',
            'lab_id' => '5',
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ComputerSeeder::class);
        $this->call(LabSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(FloorSeeder::class);
    }
}

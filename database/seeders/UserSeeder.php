<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Achmad Syahrian',
            'email' => 'achmadsyahrian1@gmail.com',
            'username' => 'administrator',
            'phone' => '0895423336075',
            'password' => Hash::make('administrator'),
            'role_id' => 1,
        ]);
    }
}

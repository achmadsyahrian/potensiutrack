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
        User::create([
            'name' => 'Soeheri, M.Kom',
            'email' => null,
            'username' => 'kabag',
            'phone' => null,
            'password' => Hash::make('kabag'),
            'role_id' => 2,
        ]);
        User::create([
            'name' => 'Asisten Lab',
            'email' => null,
            'username' => 'aslab',
            'phone' => null,
            'password' => Hash::make('aslab'),
            'role_id' => 3,
        ]);
        User::create([
            'name' => 'Ahmad Jihad Alfayed',
            'email' => null,
            'username' => 'teknisi',
            'phone' => null,
            'password' => Hash::make('teknisi'),
            'role_id' => 4,
        ]);
        User::create([
            'name' => 'M. Irfan',
            'email' => null,
            'username' => 'puskom',
            'phone' => null,
            'password' => Hash::make('puskom'),
            'role_id' => 7,
        ]);
        User::create([
            'name' => 'Daifiria, M.Kom',
            'email' => null,
            'username' => 'wakilrektor2',
            'phone' => null,
            'password' => Hash::make('wakilrektor2'),
            'role_id' => 8,
        ]);
        User::create([
            'name' => 'Lili Tanti, M.Kom',
            'email' => null,
            'username' => 'wakilrektor1',
            'phone' => null,
            'password' => Hash::make('wakilrektor1'),
            'role_id' => 9,
        ]);
        User::create([
            'name' => 'Briyandana',
            'email' => null,
            'username' => 'briyandana',
            'phone' => null,
            'password' => Hash::make('potensiutama'),
            'role_id' => 10,
        ]);
        User::create([
            'name' => 'Achmad Syahrian',
            'email' => null,
            'username' => 'achrian',
            'phone' => null,
            'password' => Hash::make('achrian'),
            'role_id' => 10,
        ]);
        User::create([
            'name' => 'M. Irfan',
            'email' => null,
            'username' => 'mirfan',
            'phone' => null,
            'password' => Hash::make('potensiutama'),
            'role_id' => 11,
        ]);
        User::create([
            'name' => 'Andra',
            'email' => null,
            'username' => 'andra',
            'phone' => null,
            'password' => Hash::make('potensiutama'),
            'role_id' => 11,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Vartotojas',
            'email' => 'vartotojas@pastas',
            'password' => Hash::make('slaptazodis'),
            'role' => 'user',
            'email_verified_at' => '2020-12-29 00:00:00'
        ]);

        User::create([
            'name' => 'Valdytojas',
            'email' => 'valdytojas@pastas',
            'password' => Hash::make('slaptazodis'),
            'role' => 'moderator',
            'email_verified_at' => '2020-12-29 00:00:00'
        ]);

        User::create([
            'name' => 'Administratorius',
            'email' => 'administratorius@pastas',
            'password' => Hash::make('slaptazodis'),
            'role' => 'admin',
            'email_verified_at' => '2020-12-29 00:00:00'
        ]);
    }
}
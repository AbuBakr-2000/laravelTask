<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Manager',
            'email' => 'email@company.com',
            'password' => Hash::make('111111'),
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'User',
            'email' => 'client@company.com',
            'password' => Hash::make('111111'),
        ]);
    }
}

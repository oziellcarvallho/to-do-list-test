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
        User::firstOrCreate([
            'id' => 1, 
            'name' => 'Super Admin',
            'email' => 'super@admin.com'
        ],[ 'password' => Hash::make('123456') ]);

        User::firstOrCreate([
            'id' => 2, 
            'name' => 'Administrador',
            'email' => 'admin@test.com'
        ],[ 'password' => Hash::make('123456') ]);

        User::firstOrCreate([
            'id' => 3, 
            'name' => 'Usuário',
            'email' => 'user@test.com'
        ],[ 'password' => Hash::make('123456') ]);
    }
}

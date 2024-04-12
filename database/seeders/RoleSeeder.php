<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permissions\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'id' => 1, 
            'name' => 'Super Usuário'
        ]);

        Role::firstOrCreate([
            'id' => 2, 
            'name' => 'Administrador'
        ]);

        Role::firstOrCreate([
            'id' => 3, 
            'name' => 'Usuário'
        ]);
    }
}

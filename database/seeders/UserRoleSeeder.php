<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Super Admin - Todas as permissões
        User::findOrFail(1)->roles()->attach([1]);

        //Administrador - Usuários e Tarefas
        User::findOrFail(2)->roles()->attach([2]);

        //Usuário - Tarefas
        User::findOrFail(3)->roles()->attach([3]);
    }
}

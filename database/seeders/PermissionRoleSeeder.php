<?php

namespace Database\Seeders;

use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Super Admin - Todas as permissões
        Role::findOrFail(1)->permissions()->attach(Permission::get()->pluck('id'));

        //Administrador - Usuários e Tarefas
        Role::findOrFail(2)->permissions()->attach(Permission::whereIn('group_id', [1, 2])->get()->pluck('id'));

        //Usuário - Tarefas
        Role::findOrFail(3)->permissions()->attach(Permission::where('group_id', 2)->get()->pluck('id'));
    }
}

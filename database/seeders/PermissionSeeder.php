<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permissions\Group;
use App\Models\Permissions\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuários
        $users = Group::firstOrCreate([
            'name' => 'Usuários'
        ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-view',
                'display_name' => 'Visualizar Usuários'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-create',
                'display_name' => 'Adicionar Usuários'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-edit',
                'display_name' => 'Editar Usuários'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $users->id,
                'name' => 'user-delete',
                'display_name' => 'Deletar Usuários'
            ]);
        

        // Tarefas
        $tasks = Group::firstOrCreate([
            'name' => 'Tarefas'
        ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-view',
                'display_name' => 'Visualizar Tarefas'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-create',
                'display_name' => 'Adicionar Tarefas'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-edit',
                'display_name' => 'Editar Tarefas'
            ]);
  
            Permission::firstOrCreate([
                'group_id' => $tasks->id,
                'name' => 'task-delete',
                'display_name' => 'Deletar Tarefas'
            ]);
    }
}

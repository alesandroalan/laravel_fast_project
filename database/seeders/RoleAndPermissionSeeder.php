<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Administrador']);
        $permission = Permission::create(['name' => 'menu_users', 'description' => 'Menu Usuários']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'menu_groups', 'description' => 'Menu Grupos']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'menu_manager', 'description' => 'Menu Gerenciar']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'menu_permissions', 'description' => 'Menu Permissões']);
        $role->givePermissionTo($permission);
        echo "Roles and Permissions OK\n";
    }
}

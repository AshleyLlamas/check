<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Coordinador']);
        $role3 = Role::create(['name' => 'Usuario']);

        //ADMIN
        $permission = Permission::create(['name' => 'admin.home',
        'description' => 'Acceso al panel administrativo.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.home.info',
        'description' => 'Ver información del inicio del panel administrativo.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.home.routes',
        'description' => 'Ver rutas en el inicio del panel administrativo.'])->syncRoles([$role1, $role2]);

        //USER
        $permission = Permission::create(['name' => 'admin.users.index',
        'description' => 'Ver todos los usuarios'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.show',
        'description' => 'Ver usuario.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.edit',
        'description' => 'Editar usuario.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.create',
        'description' => 'Crear usuario.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.destroy',
        'description' => 'Eliminar usuario.'])->syncRoles([$role1, $role2]);

        //CHECKS
        $permission = Permission::create(['name' => 'admin.checks.index',
        'description' => 'Ver checadores'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.checks.show',
        'description' => 'Ver checador.'])->syncRoles([$role1, $role2]);

        //ROLES
        $permission = Permission::create(['name' => 'admin.roles.show',
        'description' => 'Ver todos los roles de la lista roles'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.roles.edit',
        'description' => 'Editar Rol'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.roles.create',
        'description' => 'Crear Rol'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.roles.destroy',
        'description' => 'Eliminar Rol'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.roles.user',
        'description' => 'Cambiar el rol de los usuarios'])->syncRoles([$role1, $role2]);
    }
}

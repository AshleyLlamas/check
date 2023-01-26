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
        $role2 = Role::create(['name' => 'Director']);
        $role3 = Role::create(['name' => 'Usuario']);

        //ADMIN
        $permission = Permission::create(['name' => 'admin.home',
        'description' => 'Acceso al panel administrativo.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.home.info',
        'description' => 'Ver información del inicio del panel administrativo.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.home.routes',
        'description' => 'Ver rutas en el inicio del panel administrativo.'])->syncRoles([$role1]);

        //USER
        $permission = Permission::create(['name' => 'admin.users.index',
        'description' => 'Ver todos los usuarios.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.show',
        'description' => 'Ver usuario.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.edit',
        'description' => 'Editar usuario.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.create',
        'description' => 'Crear usuario.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.users.destroy',
        'description' => 'Eliminar usuario.'])->syncRoles([$role1, $role2]);

        //RECLUTA
        $permission = Permission::create(['name' => 'admin.reclutas.index',
        'description' => 'Ver todos los reclutados.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.reclutas.show',
        'description' => 'Ver reclutado.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.reclutas.edit',
        'description' => 'Editar reclutado.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.reclutas.create',
        'description' => 'Crear reclutado.'])->syncRoles([$role1, $role2]);

        $permission = Permission::create(['name' => 'admin.reclutas.destroy',
        'description' => 'Eliminar reclutado.'])->syncRoles([$role1, $role2]);

        //AREAS
        $permission = Permission::create(['name' => 'admin.areas.index',
        'description' => 'Ver todas las áreas.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.areas.show',
        'description' => 'Ver área.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.areas.edit',
        'description' => 'Editar área.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.areas.create',
        'description' => 'Crear área.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.areas.destroy',
        'description' => 'Eliminar área.'])->syncRoles([$role1]);

        //CHECKS
        $permission = Permission::create(['name' => 'admin.checks.index',
        'description' => 'Ver checadores.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.checks.show',
        'description' => 'Ver checador.'])->syncRoles([$role1]);

        //vacationS
        $permission = Permission::create(['name' => 'admin.vacations.index',
        'description' => 'Ver solicitudes de vacaciones.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.vacations.show',
        'description' => 'Ver solicutud de vacaciones.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.vacations.create',
        'description' => 'Ver crear solicitud de vacaciones.'])->syncRoles([$role1]);

        //Center cost
        $permission = Permission::create(['name' => 'admin.cost_centers.index',
        'description' => 'Ver todos los centros de costos.'])->syncRoles([$role1]);
        
        $permission = Permission::create(['name' => 'admin.cost_centers.show',
        'description' => 'Ver centro de costo.'])->syncRoles([$role1]);
        
        $permission = Permission::create(['name' => 'admin.cost_centers.edit',
        'description' => 'Editar centro de costo.'])->syncRoles([$role1]);
        
        $permission = Permission::create(['name' => 'admin.cost_centers.create',
        'description' => 'Crear centro de costo.'])->syncRoles([$role1]);
        
        $permission = Permission::create(['name' => 'admin.cost_centers.destroy',
        'description' => 'Eliminar centro de costo.'])->syncRoles([$role1]);

        //Assistances
        $permission = Permission::create(['name' => 'admin.assistances.index',
        'description' => 'Ver todas las asistencias.'])->syncRoles([$role1]);
        
        $permission = Permission::create(['name' => 'admin.assistances.show',
        'description' => 'Ver asistencia.'])->syncRoles([$role1]);

        //ADMONITIONS
        $permission = Permission::create(['name' => 'admin.admonitions.index',
        'description' => 'Ver todas las amonestaciónes.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonitions.show',
        'description' => 'Ver amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonitions.edit',
        'description' => 'Editar amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonitions.create',
        'description' => 'Crear amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonitions.destroy',
        'description' => 'Eliminar amonestación.'])->syncRoles([$role1]);

        //ADMINISTRATIVE RECORDS
        $permission = Permission::create(['name' => 'admin.administrative_records.index',
        'description' => 'Ver todas las amonestaciónes.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.show',
        'description' => 'Ver amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.edit',
        'description' => 'Editar amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.create',
        'description' => 'Crear amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.destroy',
        'description' => 'Eliminar amonestación.'])->syncRoles([$role1]);

        //ROLES
        $permission = Permission::create(['name' => 'admin.roles.index',
        'description' => 'Ver todas los roles.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.roles.show',
        'description' => 'Ver todos los roles de la lista roles.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.roles.edit',
        'description' => 'Editar Rol.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.roles.create',
        'description' => 'Crear Rol.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.roles.destroy',
        'description' => 'Eliminar Rol.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.roles.user',
        'description' => 'Cambiar el rol de los usuarios.'])->syncRoles([$role1]);
    }
}

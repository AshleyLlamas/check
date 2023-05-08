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
        'description' => 'Ver solicitud de vacaciones.'])->syncRoles([$role1]);

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

        $permission = Permission::create(['name' => 'admin.admonitions.pdfs',
        'description' => 'Ver pdf de la amonestación.'])->syncRoles([$role1]);

        //ADMONITION TYPES
        $permission = Permission::create(['name' => 'admin.admonition_types.index',
        'description' => 'Ver todos los tipos de amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonition_types.show',
        'description' => 'Ver tipo de amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonition_types.edit',
        'description' => 'Editar tipo de amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonition_types.create',
        'description' => 'Crear tipo de amonestación.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.admonition_types.destroy',
        'description' => 'Eliminar tipo de amonestación.'])->syncRoles([$role1]);

        //ADMINISTRATIVE RECORDS
        $permission = Permission::create(['name' => 'admin.administrative_records.index',
        'description' => 'Ver todas las actas administrativas.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.show',
        'description' => 'Ver acta administrativa.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.edit',
        'description' => 'Editar acta administrativa.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.create',
        'description' => 'Crear acta administrativa.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.destroy',
        'description' => 'Eliminar acta administrativa.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.administrative_records.pdfs',
        'description' => 'Ver pdf de las actas administrativas.'])->syncRoles([$role1]);


        //ADMONITIONS
        $permission = Permission::create(['name' => 'admin.inventories.index',
        'description' => 'Ver todo el inventario.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.inventories.show',
        'description' => 'Ver inventario.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.inventories.edit',
        'description' => 'Editar inventario.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.inventories.create',
        'description' => 'Crear inventario.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.inventories.destroy',
        'description' => 'Eliminar inventario.'])->syncRoles([$role1]);

        //Calendario (dias no laborales)
        $permission = Permission::create(['name' => 'admin.calendars.index',
        'description' => 'Ver todos los días no laborales.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.calendars.show',
        'description' => 'Ver día no laboral.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.calendars.edit',
        'description' => 'Editar día no laboral.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.calendars.create',
        'description' => 'Crear día no laboral.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.calendars.destroy',
        'description' => 'Eliminar día no laboral.'])->syncRoles([$role1]);

        //Horas extras
        $permission = Permission::create(['name' => 'admin.extra_hours.index',
        'description' => 'Ver todas las horas extras.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.extra_hours.show',
        'description' => 'Ver hora extra.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.extra_hours.edit',
        'description' => 'Editar hora extra.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.extra_hours.create',
        'description' => 'Crear hora extra.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.extra_hours.destroy',
        'description' => 'Eliminar hora extra.'])->syncRoles([$role1]);

        //Horarios predeterminados
        $permission = Permission::create(['name' => 'admin.default_schedules.index',
        'description' => 'Ver todos los horarios predeterminados.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.default_schedules.show',
        'description' => 'Ver horario predeterminado.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.default_schedules.edit',
        'description' => 'Editar horario predeterminado.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.default_schedules.create',
        'description' => 'Crear horario predeterminado.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.default_schedules.destroy',
        'description' => 'Eliminar horario predeterminado.'])->syncRoles([$role1]);

        //PRINTERS
        $permission = Permission::create(['name' => 'admin.printers.index',
        'description' => 'Ver todas las impresoras.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.printers.show',
        'description' => 'Ver impresora.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.printers.edit',
        'description' => 'Editar impresora.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.printers.create',
        'description' => 'Crear impresora.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.printers.destroy',
        'description' => 'Eliminar impresora.'])->syncRoles([$role1]);

        //COMPUTERS
        $permission = Permission::create(['name' => 'admin.computers.index',
        'description' => 'Ver todas las computadoras.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.computers.show',
        'description' => 'Ver computadora.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.computers.edit',
        'description' => 'Editar computadora.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.computers.create',
        'description' => 'Crear computadora.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.computers.destroy',
        'description' => 'Eliminar computadora.'])->syncRoles([$role1]);

        //DEVICES
        $permission = Permission::create(['name' => 'admin.devices.index',
        'description' => 'Ver todos los dispositivos.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.devices.show',
        'description' => 'Ver dispositivo.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.devices.edit',
        'description' => 'Editar dispositivo.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.devices.create',
        'description' => 'Crear dispositivo.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.devices.destroy',
        'description' => 'Eliminar dispositivo.'])->syncRoles([$role1]);

        //SAFETIES
        $permission = Permission::create(['name' => 'admin.safeties.index',
        'description' => 'Ver todos los atecedentes de seguridad e higienes.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.safeties.show',
        'description' => 'Ver atecedente de seguridad e higiene.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.safeties.edit',
        'description' => 'Editar atecedente de seguridad e higiene.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.safeties.create',
        'description' => 'Crear atecedente de seguridad e higiene.'])->syncRoles([$role1]);

        $permission = Permission::create(['name' => 'admin.safeties.destroy',
        'description' => 'Eliminar atecedente de seguridad e higiene.'])->syncRoles([$role1]);

        //ROLES
        $permission = Permission::create(['name' => 'admin.roles.index',
        'description' => 'Ver todos los roles.'])->syncRoles([$role1]);

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

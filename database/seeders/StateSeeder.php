<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'nombre_del_estado' => 'Aguascalientes',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Baja California',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Baja California Sur',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Campeche',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Chiapas',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Chihuahua',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Ciudad de México',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Coahuila',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Colima',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Durango',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Estado de México',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Guanajuato',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Guerrero',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Hidalgo',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Jalisco',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Michoacán',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Morelos',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Nayarit',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Nuevo León',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Oaxaca',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Puebla',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Querétaro',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Quintana Roo',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'San Luis Potosí',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Sinaloa',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Sonora',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Tabasco',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Tamaulipas',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Tlaxcala',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Veracruz',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Yucatán',
        ]);

        DB::table('states')->insert([
            'nombre_del_estado' => 'Zacatecas',
        ]);
    }
}
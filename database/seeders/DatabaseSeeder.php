<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/fotos');
        Storage::makeDirectory('public/fotos');

        Storage::deleteDirectory('public/identificaciones_oficiales');
        Storage::makeDirectory('public/identificaciones_oficiales');

        Storage::deleteDirectory('public/comprobantes_de_domicilio');
        Storage::makeDirectory('public/comprobantes_de_domicilio');

        Storage::deleteDirectory('public/documentos_de_no_antecedentes_penales');
        Storage::makeDirectory('public/documentos_de_no_antecedentes_penales');

        Storage::deleteDirectory('public/licencias_de_conducir');
        Storage::makeDirectory('public/licencias_de_conducir');

        Storage::deleteDirectory('public/cedulas_profesionales');
        Storage::makeDirectory('public/cedulas_profesionales');

        Storage::deleteDirectory('public/cartas_de_pasantes');
        Storage::makeDirectory('public/cartas_de_pasantes');

        Storage::deleteDirectory('public/curriculums_vitaes');
        Storage::makeDirectory('public/curriculums_vitaes');

        $this->call([
            RoleSeeder::class,
            CompanySeeder::class,
            StateSeeder::class,
            MunicipalitySeeder::class,
            UserSeeder::class,
        ]);
    }
}

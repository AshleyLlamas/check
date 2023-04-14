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

        Storage::deleteDirectory('identificaciones_oficiales');
        Storage::makeDirectory('identificaciones_oficiales');

        Storage::deleteDirectory('comprobantes_de_domicilio');
        Storage::makeDirectory('comprobantes_de_domicilio');

        Storage::deleteDirectory('documentos_de_no_antecedentes_penales');
        Storage::makeDirectory('documentos_de_no_antecedentes_penales');

        Storage::deleteDirectory('licencias_de_conducir');
        Storage::makeDirectory('licencias_de_conducir');

        Storage::deleteDirectory('cedulas_profesionales');
        Storage::makeDirectory('public/cedulas_profesionales');

        Storage::deleteDirectory('cartas_de_pasantes');
        Storage::makeDirectory('cartas_de_pasantes');

        Storage::deleteDirectory('curriculums_vitaes');
        Storage::makeDirectory('curriculums_vitaes');

        $this->call([
            RoleSeeder::class,
            CompanySeeder::class,
            StateSeeder::class,
            MunicipalitySeeder::class,
            UserSeeder::class,
            DeviceSeeder::class
        ]);
    }
}

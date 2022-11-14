<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'nombre_de_la_compañia' => 'OCIVSA',
        ]);

        Company::create([
            'nombre_de_la_compañia' => 'TRITU ASFALTOS',
        ]);

        Company::create([
            'nombre_de_la_compañia' => 'Administradora de Obras y Concesiones',
        ]);

        Company::create([
            'nombre_de_la_compañia' => 'ANEMO ENERGY',
        ]);

        Company::create([
            'nombre_de_la_compañia' => 'MAGNAMAQ',
        ]);
    }
}

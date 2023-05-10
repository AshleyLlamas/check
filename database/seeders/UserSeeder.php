<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'PRUEBAS',
            'email' => 'example.program.view@gmail.com',
            'password' => bcrypt('servidordepruebas'),
            'slug' => 'DEHr98Xn03WscWHh3eoN'
        ])->assignRole('Admin');
    }
}

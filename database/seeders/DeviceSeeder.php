<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::create([
            'name' => 'DISPOSITIVO MASTER',
            'email' => 'example.program.view@gmail.com',
            'password' => bcrypt('servidordepruebas'),
            'user_id' => 1,
            'descripción' => 'Primera cuenta',
            'slug' => Str::random(30)
        ]);
    }
}

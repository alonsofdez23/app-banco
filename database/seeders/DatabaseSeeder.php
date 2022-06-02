<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Crea user "admin", password "adminadmin"
        $this->call(UserSeeder::class);

        Cliente::factory(10)->create();
        $this->call(CuentaSeeder::class);
    }
}

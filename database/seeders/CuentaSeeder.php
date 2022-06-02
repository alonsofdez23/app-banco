<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cuentas = Cuenta::factory(5)->create();

        foreach ($cuentas as $cuenta) {
            $cuenta->clientes()->attach([
                Cliente::adultos()->random()->id,
            ]);
        }
    }
}

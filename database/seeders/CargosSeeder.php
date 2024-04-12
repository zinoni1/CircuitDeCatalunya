<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cargos;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargos = [
            'Gerente',
            'Jefe de área',
            'Supervisor',
            'Coordinador',
            'Analista',
            'Asistente',
            'Operador',
            'Auxiliar',
            'Practicante',
            'Administrador'
        ];

        foreach ($cargos as $cargo) {
            \App\Models\Cargos::create([
                'nombre' => $cargo,
            ]);
        }
    }
}

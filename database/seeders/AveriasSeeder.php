<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\averias;

class AveriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunas averías ficticias
        averias::create([
            'Incidencia' => 'Fallo de red',
            'descripcion' => 'La red se ha caído en el área X',
            'data_inicio' => now(),
            'data_fin' => now()->addDays(3),
            'prioridad' => 'alta',
            'imagen' => 'ruta/a/imagen1.jpg',
            'creator_id' => 1, // ID del creador de la avería
            'tecnico_asignado_id' => 2, // ID del técnico asignado
            'asignador' => 3, // ID del usuario que asignó la avería
            'zona_id' => 1, // ID de la zona afectada
            'tipo_averias_id' => 1, // ID del tipo de avería
        ]);

        averias::create([
            'Incidencia' => 'Fallo de hardware',
            'descripcion' => 'El servidor ha dejado de funcionar',
            'data_inicio' => now(),
            'data_fin' => now()->addDays(2),
            'prioridad' => 'media',
            'imagen' => 'ruta/a/imagen2.jpg',
            'creator_id' => 2,
            'tecnico_asignado_id' => 3,
            'asignador' => 1,
            'zona_id' => 2,
            'tipo_averias_id' => 2,
        ]);

        // Puedes crear más averías según sea necesario
    }
}

<?php

namespace Database\Seeders;

use App\Models\tipo_averias;
use Illuminate\Database\Seeder;

class TipoAveriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tipo_averias::create(['nombre' => 'Correctiu']);
        tipo_averias::create(['nombre' => 'Preventiu']);
    }
}

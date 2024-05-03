<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\zonas;


class ZonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        zonas::create(['nombre' => 'pista']);
        zonas::create(['nombre' => 'organitzacio pado']);
        zonas::create(['nombre' => 'public nord']);
        zonas::create(['nombre' => 'public sud']);
        zonas::create(['nombre' => 'public este']);
        zonas::create(['nombre' => 'public oeste']);
        zonas::create(['nombre' => 'aparcament']);
    }
}
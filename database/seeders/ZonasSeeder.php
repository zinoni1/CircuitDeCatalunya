<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Zona::create(['nombre' => 'pista']);
        Zona::create(['nombre' => 'organitzacio pado']);
        Zona::create(['nombre' => 'public nord']);
        Zona::create(['nombre' => 'public sud']);
        Zona::create(['nombre' => 'public este']);
        Zona::create(['nombre' => 'public oeste']);
        Zona::create(['nombre' => 'aparcament']);
    }
}
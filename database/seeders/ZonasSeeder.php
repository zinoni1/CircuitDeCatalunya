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
        zonas::create(['nombre' => 'Pista']);
        zonas::create(['nombre' => 'Organitzacio Padock']);
        zonas::create(['nombre' => 'Public Nord']);
        zonas::create(['nombre' => 'Public Sud']);
        zonas::create(['nombre' => 'Public Este']);
        zonas::create(['nombre' => 'Public Oeste']);
        zonas::create(['nombre' => 'Aparcament']);
    }
}
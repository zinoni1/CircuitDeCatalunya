<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\sectors;

class SectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        sectors::create(['nombre' => 'sector 1', 'zona_id' => 1]);
        sectors::create(['nombre' => 'sector 2', 'zona_id' => 2]);
        sectors::create(['nombre' => 'sector 3','zona_id' => 3]);
    }
}

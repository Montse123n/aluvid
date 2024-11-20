<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sectores')->insert([
            ['name' => 'Aluminios', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vidrios', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Herrajes', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

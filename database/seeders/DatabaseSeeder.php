<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Agrega aquí los seeders que existan en tu proyecto
        // Si no tienes el SectorSeeder, elimina la línea correspondiente
        $this->call([
            SectorSeeder::class,
        ]);
        
    }
}

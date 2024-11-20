<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define los sectores
        $sectores = [
            ['nombre' => 'Aluminio', 'descripcion' => 'Sector especializado en productos de aluminio.'],
            ['nombre' => 'Vidrio', 'descripcion' => 'Sector especializado en productos de vidrio.'],
            ['nombre' => 'Herrajes', 'descripcion' => 'Sector especializado en herrajes para diferentes usos.'],
        ];

        // Inserta los sectores en la base de datos
        foreach ($sectores as $sector) {
            Sector::create($sector);
        }
    }
}

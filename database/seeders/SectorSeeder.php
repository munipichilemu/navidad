<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Urbanos */
        Sector::insert([
            ['name' => 'Agustín Ross', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alto Las Cumbres', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alto Lafquén', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alto Pucalán I', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alto Pucalán II', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alto Pucará', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arauco', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Atardecer', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Avenida Cáhuil', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bicentenario', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bosques del Mar', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cuatro Colinas', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Badillo', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Bajo Estación', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Descanso', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Llano', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Olimpo', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Infiernillo', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Alborada', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Caleta', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Paz', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laguna El Ancho', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Las Américas', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Las Araucarias', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Las Palmeras', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Las Proteas', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Andes', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Cipreses', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Cisnes del Ancho', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Jardines', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Lagos', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Navegantes', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Nogales', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Poetas', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Profesores', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Robles', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lomas del Valle', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mar Azul', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nueva Ilusión', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pichilemu Centro', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Playa Hermosa', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rayito de Sol', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Reina del Mar', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Padre Hurtado', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pavez Polanco', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pueblo de Viudas', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Puente Negro', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Punta del Sol', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Andrés', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Antonio', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Francisco', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'San Jorge', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Gemita', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Santa Teresita', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Villa Pichilemu', 'group' => 'urbano', 'created_at' => now(), 'updated_at' => now()],
        ]);

        /* Rurales */
        Sector::insert([
            ['name' => 'Alto Colorado', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alto Ramírez', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Barrancas', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Buenos Aires', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cáhuil', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cardonal de Panilonco', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Catrianca', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ciruelos', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cóguil', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Boldo', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Maqui', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'El Pangal', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Espinillo', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Las Comillas', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Aguada', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Palmilla', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Plaza', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Quebrada', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'La Villa', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lo Gallardo', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Los Curicanos', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nuevo Reino', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pañul', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Punta de Lobos', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rodeíllo', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tanumé', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Villa Esperanza', 'group' => 'rural', 'created_at' => now(), 'updated_at' => now()],
        ]);

        /* Otros */
        Sector::insert([
            ['name' => 'UNPADE', 'group' => 'otro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Otro', 'group' => 'otro', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

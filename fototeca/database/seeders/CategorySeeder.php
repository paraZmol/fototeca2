<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $arq = Category::create(['name' => 'Arquitectura y Espacios Urbanos', 'slug' => 'arquitectura', 'icon' => '🏛️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Iglesias y Templos',   'slug' => 'iglesias',   'icon' => '⛪']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Plazas y Parques',     'slug' => 'plazas',     'icon' => '🏟️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Mercados',              'slug' => 'mercados',   'icon' => '🛒']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Calles y Barrios',      'slug' => 'calles',     'icon' => '🏘️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Edificios Públicos',    'slug' => 'edificios',  'icon' => '🏢']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Puentes',               'slug' => 'puentes',    'icon' => '🌉']);

        $pai = Category::create(['name' => 'Paisaje y Naturaleza', 'slug' => 'paisaje', 'icon' => '🏔️']);
        Category::create(['parent_id' => $pai->id, 'name' => 'Panorámicas y Vistas',  'slug' => 'panoramicas', 'icon' => '🌅']);
        Category::create(['parent_id' => $pai->id, 'name' => 'Montañas y Nevados',    'slug' => 'nevados',     'icon' => '⛰️']);
        Category::create(['parent_id' => $pai->id, 'name' => 'Ríos y Quebradas',      'slug' => 'rios',        'icon' => '🏞️']);

        $vid = Category::create(['name' => 'Vida Social y Cultural', 'slug' => 'vida-social', 'icon' => '👥']);
        Category::create(['parent_id' => $vid->id, 'name' => 'Fiestas y Celebraciones', 'slug' => 'fiestas',   'icon' => '🎉']);
        Category::create(['parent_id' => $vid->id, 'name' => 'Retratos y Personas',     'slug' => 'retratos',  'icon' => '🧑']);
        Category::create(['parent_id' => $vid->id, 'name' => 'Comercio Tradicional',    'slug' => 'comercio',  'icon' => '⚖️']);
        Category::create(['parent_id' => $vid->id, 'name' => 'Educación y Escuelas',    'slug' => 'educacion', 'icon' => '🏫']);

        $his = Category::create(['name' => 'Historia y Memoria', 'slug' => 'historia', 'icon' => '📜']);
        Category::create(['parent_id' => $his->id, 'name' => 'Antes del Terremoto',   'slug' => 'pre-terremoto',    'icon' => '🕰️']);
        Category::create(['parent_id' => $his->id, 'name' => 'El Terremoto de 1970',  'slug' => 'terremoto-1970',   'icon' => '🏚️']);
        Category::create(['parent_id' => $his->id, 'name' => 'Reconstrucción',         'slug' => 'reconstruccion',   'icon' => '🔨']);
        Category::create(['parent_id' => $his->id, 'name' => 'Época Contemporánea',   'slug' => 'contemporaneo',    'icon' => '🏙️']);
    }
}

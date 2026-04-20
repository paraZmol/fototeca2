<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $cats = Category::pluck('id', 'slug');

        $data = [
            // subcategorias de puentes (geo)
            'puentes' => [
                ['name' => 'Puente Bedoya',      'slug' => 'puente-bedoya',    'icon' => '🌉'],
                ['name' => 'Puente Villón',      'slug' => 'puente-villon',    'icon' => '🌉'],
                ['name' => 'Puente Quillcay',    'slug' => 'puente-quillcay',  'icon' => '🌉'],
                ['name' => 'Puente La Soledad',  'slug' => 'puente-soledad',   'icon' => '🌉'],
            ],
            // subcategorias de calles (geo)
            'calles' => [
                ['name' => 'Jirón Luzuriaga',     'slug' => 'jr-luzuriaga',   'icon' => '🛤️'],
                ['name' => 'Jirón Sucre',          'slug' => 'jr-sucre',       'icon' => '🛤️'],
                ['name' => 'Av. Raymondi',         'slug' => 'av-raymondi',    'icon' => '🛤️'],
                ['name' => 'Av. Fitzcarrald',      'slug' => 'av-fitzcarrald', 'icon' => '🛤️'],
            ],
            // subcategorias de casas-edificios (geo)
            'casas-edificios' => [
                ['name' => 'Casa Hacienda',        'slug' => 'casa-hacienda',  'icon' => '🏠'],
                ['name' => 'Edificios Públicos',   'slug' => 'edif-publicos',  'icon' => '🏢'],
                ['name' => 'Hoteles y Comercios',  'slug' => 'hoteles-comerc', 'icon' => '🏨'],
            ],
            // subcategorias de plaza-armas-catedral (geo)
            'plaza-armas-catedral' => [
                ['name' => 'Plaza de Armas de Huaraz',   'slug' => 'plaza-huaraz',  'icon' => '🏟️'],
                ['name' => 'Catedral de Huaraz',          'slug' => 'catedral-huaraz','icon' => '⛪'],
                ['name' => 'Plaza de Armas de Yungay',   'slug' => 'plaza-yungay',  'icon' => '🏟️'],
                ['name' => 'Plaza de Armas de Carhuaz',  'slug' => 'plaza-carhuaz', 'icon' => '🏟️'],
                ['name' => 'Plaza de Armas de Recuay',   'slug' => 'plaza-recuay',  'icon' => '🏟️'],
            ],
            // colecciones tematicas de fotografos: tradiciones (dinamicas)
            'col-tradiciones' => [
                ['name' => 'Fiesta del Señor de La Soledad', 'slug' => 'col-trad-soledad',          'icon' => '🪅'],
                ['name' => 'Semana Santa Huaracina',          'slug' => 'col-trad-semana-santa',     'icon' => '✝️'],
                ['name' => 'Fiesta de Cruces',                'slug' => 'col-trad-cruces',           'icon' => '🎊'],
                ['name' => 'Carnavales Ancashinos',           'slug' => 'col-trad-carnavales',       'icon' => '🎊'],
            ],
            // especiales: circuitos PNH
            'pnh-circuitos' => [
                ['name' => 'Circuito Santa Cruz',       'slug' => 'circ-santa-cruz',  'icon' => '🥾'],
                ['name' => 'Circuito Huayhuash',        'slug' => 'circ-huayhuash',   'icon' => '🥾'],
                ['name' => 'Lagunas de Llanganuco',     'slug' => 'lag-llanganuco',   'icon' => '💧'],
                ['name' => 'Laguna 69',                 'slug' => 'lag-69',           'icon' => '💧'],
            ],
        ];

        foreach ($data as $categorySlug => $subs) {
            $categoryId = $cats[$categorySlug] ?? null;
            if (!$categoryId) {
                continue;
            }
            foreach ($subs as $sub) {
                Subcategory::create([
                    'category_id' => $categoryId,
                    'name'        => $sub['name'],
                    'slug'        => $sub['slug'],
                    'icon'        => $sub['icon'] ?? null,
                ]);
            }
        }
    }
}

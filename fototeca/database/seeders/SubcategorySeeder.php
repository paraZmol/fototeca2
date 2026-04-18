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

        $subcategories = [
            // subcategorias de iglesias
            'iglesias' => [
                ['name' => 'Catedral Santiago Apóstol',   'slug' => 'catedral-santiago',   'icon' => '⛪'],
                ['name' => 'Iglesia La Soledad',          'slug' => 'iglesia-soledad',     'icon' => '⛪'],
                ['name' => 'Capilla del Señor de Mayo',   'slug' => 'capilla-mayo',        'icon' => '⛪'],
            ],
            // subcategorias de plazas
            'plazas' => [
                ['name' => 'Plaza de Armas',              'slug' => 'plaza-armas',          'icon' => '🏟️'],
                ['name' => 'Parque del Periodista',       'slug' => 'parque-periodista',    'icon' => '🌳'],
                ['name' => 'Alameda Grau',                'slug' => 'alameda-grau',         'icon' => '🌳'],
            ],
            // subcategorias de mercados
            'mercados' => [
                ['name' => 'Mercado Central',             'slug' => 'mercado-central',      'icon' => '🛒'],
                ['name' => 'Mercado de Abastos',          'slug' => 'mercado-abastos',      'icon' => '🛒'],
            ],
            // subcategorias de calles
            'calles' => [
                ['name' => 'Jirón Luzuriaga',            'slug' => 'jr-luzuriaga',         'icon' => '🏘️'],
                ['name' => 'Barrio La Soledad',           'slug' => 'barrio-soledad',       'icon' => '🏘️'],
                ['name' => 'Barrio Centenario',           'slug' => 'barrio-centenario',    'icon' => '🏘️'],
                ['name' => 'Barrio Huarupampa',           'slug' => 'barrio-huarupampa',    'icon' => '🏘️'],
            ],
            // subcategorias de puentes
            'puentes' => [
                ['name' => 'Puente Bedoya',               'slug' => 'puente-bedoya',        'icon' => '🌉'],
                ['name' => 'Puente Villón',               'slug' => 'puente-villon',        'icon' => '🌉'],
            ],
            // subcategorias de panoramicas
            'panoramicas' => [
                ['name' => 'Vista desde Pumacayan',       'slug' => 'vista-pumacayan',      'icon' => '🌅'],
                ['name' => 'Vista del Callejón de Huaylas','slug' => 'vista-callejon',      'icon' => '🌅'],
            ],
            // subcategorias de nevados
            'nevados' => [
                ['name' => 'Huascarán',                   'slug' => 'huascaran',            'icon' => '⛰️'],
                ['name' => 'Cordillera Blanca',           'slug' => 'cordillera-blanca',    'icon' => '⛰️'],
                ['name' => 'Chopicalqui',                 'slug' => 'chopicalqui',          'icon' => '⛰️'],
                ['name' => 'Lago Llanganuco',             'slug' => 'lago-llanganuco',      'icon' => '⛰️'],
                ['name' => 'Huascarán Norte',             'slug' => 'huascaran-norte',      'icon' => '⛰️'],
            ],
            // subcategorias de rios
            'rios' => [
                ['name' => 'Río Santa',                   'slug' => 'rio-santa',            'icon' => '🏞️'],
                ['name' => 'Río Quillcay',                'slug' => 'rio-quillcay',         'icon' => '🏞️'],
                ['name' => 'Río Santa tramo Recuay',      'slug' => 'rio-santa-recuay',     'icon' => '🏞️'],
            ],
            // subcategorias de fiestas
            'fiestas' => [
                ['name' => 'Semana Santa',                'slug' => 'semana-santa',         'icon' => '🎉'],
                ['name' => 'Señor de la Soledad',         'slug' => 'senor-soledad',        'icon' => '🎉'],
                ['name' => 'Carnavales',                  'slug' => 'carnavales',           'icon' => '🎉'],
            ],
            // subcategorias de retratos
            'retratos' => [
                ['name' => 'Familias',                    'slug' => 'familias',             'icon' => '🧑'],
                ['name' => 'Personajes Ilustres',         'slug' => 'personajes-ilustres',  'icon' => '🧑'],
            ],
            // subcategorias de comercio
            'comercio' => [
                ['name' => 'Ferias Artesanales',          'slug' => 'ferias-artesanales',   'icon' => '⚖️'],
                ['name' => 'Comercio Ambulante',          'slug' => 'comercio-ambulante',   'icon' => '⚖️'],
            ],
            // subcategorias de educacion
            'educacion' => [
                ['name' => 'Escuelas Primarias',          'slug' => 'escuelas-primarias',   'icon' => '🏫'],
                ['name' => 'Universidad UNASAM',          'slug' => 'unasam',               'icon' => '🏫'],
                ['name' => 'Escuela Rural Recuay',        'slug' => 'escuela-rural-recuay', 'icon' => '🏫'],
            ],
            // subcategorias de terremoto-1970
            'terremoto-1970' => [
                ['name' => 'Destrucción del Centro',      'slug' => 'destruccion-centro',   'icon' => '🏚️'],
                ['name' => 'Rescate y Ayuda',             'slug' => 'rescate-ayuda',        'icon' => '🏚️'],
                ['name' => 'Alud sobre Yungay',           'slug' => 'alud-yungay',          'icon' => '🏚️'],
                ['name' => 'Camposanto',                  'slug' => 'camposanto',           'icon' => '🏚️'],
            ],
            // subcategorias de reconstruccion
            'reconstruccion' => [
                ['name' => 'Obras Públicas',              'slug' => 'obras-publicas',       'icon' => '🔨'],
                ['name' => 'Viviendas Nuevas',            'slug' => 'viviendas-nuevas',     'icon' => '🔨'],
                ['name' => 'Nueva Yungay',                'slug' => 'nueva-yungay',         'icon' => '🔨'],
            ],
        ];

        foreach ($subcategories as $categorySlug => $subs) {
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

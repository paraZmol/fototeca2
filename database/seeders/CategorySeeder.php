<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // ═══════════════════════════════════════════════════════════════
        // SECCION 1: DISTRIBUCION GEOGRAFICA
        // categorias urbanas y sociales por ciudad
        // ═══════════════════════════════════════════════════════════════
        $geo = Category::create(['name' => 'Distribución Geográfica', 'slug' => 'geo', 'icon' => '🗺️']);

        $panoramica = Category::create(['parent_id' => $geo->id, 'name' => 'Panorámica',            'slug' => 'panoramica',          'icon' => '🌅']);
        $plaza      = Category::create(['parent_id' => $geo->id, 'name' => 'Plaza de Armas y Catedral','slug' => 'plaza-armas-catedral','icon' => '⛪']);
        $barrios    = Category::create(['parent_id' => $geo->id, 'name' => 'Barrios',                'slug' => 'barrios',             'icon' => '🏘️']);
        $puentes    = Category::create(['parent_id' => $geo->id, 'name' => 'Puentes',                'slug' => 'puentes',             'icon' => '🌉']);
        $calles     = Category::create(['parent_id' => $geo->id, 'name' => 'Calles',                 'slug' => 'calles',              'icon' => '🛤️']);
        $casas      = Category::create(['parent_id' => $geo->id, 'name' => 'Casas y Edificios',      'slug' => 'casas-edificios',     'icon' => '🏠']);
        $sociedad   = Category::create(['parent_id' => $geo->id, 'name' => 'Sociedad y Cultura',     'slug' => 'sociedad-cultura',    'icon' => '👥']);

        // barrios: sub-listado segun requerimiento
        Category::create(['parent_id' => $barrios->id, 'name' => 'Belén',        'slug' => 'barrio-belen',       'icon' => '📍']);
        Category::create(['parent_id' => $barrios->id, 'name' => 'San Francisco', 'slug' => 'barrio-san-francisco','icon' => '📍']);
        Category::create(['parent_id' => $barrios->id, 'name' => 'La Soledad',   'slug' => 'barrio-la-soledad',  'icon' => '📍']);
        Category::create(['parent_id' => $barrios->id, 'name' => 'Huarupampa',   'slug' => 'barrio-huarupampa',  'icon' => '📍']);
        Category::create(['parent_id' => $barrios->id, 'name' => 'Centenario',   'slug' => 'barrio-centenario',  'icon' => '📍']);
        Category::create(['parent_id' => $barrios->id, 'name' => 'Nicrupampa',   'slug' => 'barrio-nicrupampa',  'icon' => '📍']);

        // sociedad y cultura: sub-listado segun requerimiento
        Category::create(['parent_id' => $sociedad->id, 'name' => 'Instituciones Sociales',  'slug' => 'inst-sociales',   'icon' => '🏛️']);
        Category::create(['parent_id' => $sociedad->id, 'name' => 'Instituciones Culturales','slug' => 'inst-culturales', 'icon' => '🎭']);
        Category::create(['parent_id' => $sociedad->id, 'name' => 'Instituciones Educativas','slug' => 'inst-educativas', 'icon' => '🏫']);
        Category::create(['parent_id' => $sociedad->id, 'name' => 'Deportes',                'slug' => 'deportes',        'icon' => '⚽']);
        Category::create(['parent_id' => $sociedad->id, 'name' => 'Familias',                'slug' => 'familias',        'icon' => '👨‍👩‍👧']);

        // ═══════════════════════════════════════════════════════════════
        // SECCION 2: FOTOGRAFOS CONSAGRADOS
        // colecciones tematicas por siglo y tema
        // ═══════════════════════════════════════════════════════════════
        $foto = Category::create(['name' => 'Fotógrafos Consagrados', 'slug' => 'fotografos-consagrados', 'icon' => '📷']);

        // clasificacion por siglo
        $sigloXix = Category::create(['parent_id' => $foto->id, 'name' => 'Siglo XIX', 'slug' => 'siglo-xix', 'icon' => '🕰️']);
        $sigloXx  = Category::create(['parent_id' => $foto->id, 'name' => 'Siglo XX',  'slug' => 'siglo-xx',  'icon' => '📸']);
        $sigloXxi = Category::create(['parent_id' => $foto->id, 'name' => 'Siglo XXI', 'slug' => 'siglo-xxi', 'icon' => '🖼️']);

        // colecciones tematicas (cuelgan de la seccion principal)
        $colFamilia = Category::create(['parent_id' => $foto->id, 'name' => 'Familia',                 'slug' => 'col-familia',     'icon' => '👨‍👩‍👧']);
        $colPaisajes = Category::create(['parent_id' => $foto->id, 'name' => 'Paisajes',               'slug' => 'col-paisajes',    'icon' => '🏔️']);
        $colCiudad   = Category::create(['parent_id' => $foto->id, 'name' => 'Ciudad',                 'slug' => 'col-ciudad',      'icon' => '🏙️']);
        $colSociedad = Category::create(['parent_id' => $foto->id, 'name' => 'Sociedad y Cultura',     'slug' => 'col-sociedad',    'icon' => '👥']);
        $colEduca    = Category::create(['parent_id' => $foto->id, 'name' => 'Instituciones Educativas','slug' => 'col-educativas', 'icon' => '🏫']);
        $colDeporte  = Category::create(['parent_id' => $foto->id, 'name' => 'Deporte',                'slug' => 'col-deporte',     'icon' => '⚽']);
        $colTrad     = Category::create(['parent_id' => $foto->id, 'name' => 'Tradiciones y Costumbres','slug' => 'col-tradiciones','icon' => '🎉']);

        // sub-categorias dinamicas de tradiciones (ejemplos iniciales)
        Category::create(['parent_id' => $colTrad->id, 'name' => 'Fiesta del Señor de La Soledad', 'slug' => 'fiesta-senor-soledad', 'icon' => '🪅']);
        Category::create(['parent_id' => $colTrad->id, 'name' => 'Semana Santa',                   'slug' => 'trad-semana-santa',    'icon' => '✝️']);
        Category::create(['parent_id' => $colTrad->id, 'name' => 'Carnavales',                     'slug' => 'trad-carnavales',      'icon' => '🎊']);

        // ═══════════════════════════════════════════════════════════════
        // SECCION 3: ESPECIALES
        // colecciones fijas landing pages
        // ═══════════════════════════════════════════════════════════════
        $esp = Category::create(['name' => 'Especiales', 'slug' => 'especiales', 'icon' => '⭐']);

        // 1. desastres en ancash
        $desastres = Category::create(['parent_id' => $esp->id, 'name' => 'Desastres en Ancash', 'slug' => 'desastres-ancash', 'icon' => '🌊']);
        Category::create(['parent_id' => $desastres->id, 'name' => 'Aluvión de Huaraz 1941',        'slug' => 'aluvion-huaraz-1941',  'icon' => '🌊']);
        Category::create(['parent_id' => $desastres->id, 'name' => 'Aluvión de Chavín 1945',        'slug' => 'aluvion-chavin-1945',  'icon' => '🌊']);
        Category::create(['parent_id' => $desastres->id, 'name' => 'Aluvión de Ranrahirca 1962',    'slug' => 'aluvion-ranrahirca-1962','icon' => '🌊']);
        Category::create(['parent_id' => $desastres->id, 'name' => 'Terremoto del 31 de mayo 1970', 'slug' => 'terremoto-1970',       'icon' => '🏚️']);
        Category::create(['parent_id' => $desastres->id, 'name' => 'Aluvión del 31 de mayo 1970',  'slug' => 'aluvion-1970',         'icon' => '🌊']);

        // 2. tradiciones y costumbres de huaraz
        $tradHuaraz = Category::create(['parent_id' => $esp->id, 'name' => 'Tradiciones y Costumbres de Huaraz', 'slug' => 'tradiciones-huaraz', 'icon' => '🎉']);
        Category::create(['parent_id' => $tradHuaraz->id, 'name' => 'Fiesta del Señor de Mayo',  'slug' => 'esp-senor-mayo',   'icon' => '🪅']);
        Category::create(['parent_id' => $tradHuaraz->id, 'name' => 'Semana Santa Huaracina',    'slug' => 'esp-semana-santa', 'icon' => '✝️']);
        Category::create(['parent_id' => $tradHuaraz->id, 'name' => 'Fiesta de Cruces y Carnavales','slug' => 'esp-cruces-carnavales','icon' => '🎊']);

        // 3. patrimonio arqueologico ancashino
        $arq = Category::create(['parent_id' => $esp->id, 'name' => 'Patrimonio Arqueológico Ancashino', 'slug' => 'patrimonio-arqueologico', 'icon' => '🏛️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Sechín',      'slug' => 'arq-sechin',      'icon' => '🏛️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Chavín',      'slug' => 'arq-chavin',      'icon' => '🏛️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Wicahuain',   'slug' => 'arq-wicahuain',   'icon' => '🏛️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Yaino',       'slug' => 'arq-yaino',       'icon' => '🏛️']);
        Category::create(['parent_id' => $arq->id, 'name' => 'Tumshukaiko', 'slug' => 'arq-tumshukaiko', 'icon' => '🏛️']);

        // 4. parque nacional huascaran
        $pnh = Category::create(['parent_id' => $esp->id, 'name' => 'Parque Nacional Huascarán', 'slug' => 'pnh', 'icon' => '⛰️']);
        $nevados = Category::create(['parent_id' => $pnh->id, 'name' => 'Nevados y Lagunas', 'slug' => 'pnh-nevados', 'icon' => '❄️']);
        Category::create(['parent_id' => $nevados->id, 'name' => 'Huascarán',   'slug' => 'nev-huascaran',   'icon' => '⛰️']);
        Category::create(['parent_id' => $nevados->id, 'name' => 'Alpamayo',    'slug' => 'nev-alpamayo',    'icon' => '⛰️']);
        Category::create(['parent_id' => $nevados->id, 'name' => 'Artesonraju', 'slug' => 'nev-artesonraju', 'icon' => '⛰️']);
        Category::create(['parent_id' => $nevados->id, 'name' => 'Cayesh',      'slug' => 'nev-cayesh',      'icon' => '⛰️']);
        Category::create(['parent_id' => $nevados->id, 'name' => 'Chopicalqui', 'slug' => 'nev-chopicalqui', 'icon' => '⛰️']);
        Category::create(['parent_id' => $pnh->id, 'name' => 'Circuitos', 'slug' => 'pnh-circuitos', 'icon' => '🥾']);
    }
}

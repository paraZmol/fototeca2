<?php

namespace Database\Seeders;

use App\Enums\HistoricalPeriod;
use App\Models\Category;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Photographer;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        // Load all lookup tables upfront — 4 queries total instead of one per photo
        $locations     = Location::pluck('id', 'name');
        $photographers = Photographer::pluck('id', 'name');
        $categories    = Category::pluck('id', 'slug');
        $tags          = Tag::pluck('id', 'slug');

        $photos = [
            // ── PRE-TERREMOTO ────────────────────────────────────────────
            [
                'title'             => 'Plaza de Armas de Huaraz',
                'description'       => 'Vista desde el atrio de la Catedral hacia el quiosco central. Al fondo, la alameda con sus arcos coloniales y el edificio de la prefectura.',
                'year'              => 1962,
                'circa'             => false,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'original_format'   => 'Negativo en vidrio',
                'source_archive'    => 'Archivo Municipal de Huaraz',
                'source_reference'  => 'AMH-001',
                'image_url'         => 'https://picsum.photos/seed/plaza1962/800/600',
                'photographers'     => ['Adolfo Cárdenas Torres'],
                'categories'        => ['plazas', 'pre-terremoto'],
                'tags'              => ['huaraz', 'arquitectura-colonial'],
            ],
            [
                'title'             => 'Catedral de Huaraz desde el sur',
                'description'       => 'Fachada principal de la Catedral de Santiago Apóstol en toda su majestad colonial. Fue destruida por el terremoto del 31 de mayo de 1970.',
                'year'              => 1955,
                'circa'             => true,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'original_format'   => 'Papel fotográfico',
                'source_archive'    => 'Colección familiar Cárdenas',
                'source_reference'  => 'CC-012',
                'image_url'         => 'https://picsum.photos/seed/catedral1955/800/600',
                'photographers'     => ['Adolfo Cárdenas Torres'],
                'categories'        => ['iglesias', 'pre-terremoto'],
                'tags'              => ['huaraz', 'arquitectura-colonial'],
            ],
            [
                'title'             => 'Mercado Central de Huaraz',
                'description'       => 'Bulliciosa jornada en el mercado de abastos. Vendedoras con trajes típicos ancashinos ofrecen productos de la sierra.',
                'year'              => 1958,
                'circa'             => false,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'Archivo Regional de Ancash',
                'source_reference'  => 'ARA-045',
                'image_url'         => 'https://picsum.photos/seed/mercado1958/800/600',
                'photographers'     => ['María Elena Vásquez Robles'],
                'categories'        => ['mercados', 'pre-terremoto'],
                'tags'              => ['huaraz', 'mercado-tradicional', 'vida-cotidiana'],
            ],
            [
                'title'             => 'Barrio La Soledad — Calle Real',
                'description'       => 'Típica calle empedrada del barrio La Soledad con sus casas de adobe y balcones de madera tallada.',
                'year'              => 1965,
                'circa'             => false,
                'location'          => 'Calles',
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'Colección familiar Cárdenas',
                'source_reference'  => 'CC-034',
                'image_url'         => 'https://picsum.photos/seed/lasoledad1965/800/600',
                'photographers'     => ['Adolfo Cárdenas Torres'],
                'categories'        => ['calles', 'pre-terremoto'],
                'tags'              => ['huaraz', 'arquitectura-colonial'],
            ],
            [
                'title'             => 'Panorámica del Valle del Santa',
                'description'       => 'Vista aérea del valle desde el cerro Pumacayan. Al fondo, la Cordillera Blanca con el Huascarán cubierto de nieve.',
                'year'              => 1960,
                'circa'             => true,
                'location'          => 'Huaraz',
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'original_format'   => 'Negativo en vidrio',
                'source_archive'    => 'Sociedad Geográfica de Lima',
                'source_reference'  => 'SGL-112',
                'image_url'         => 'https://picsum.photos/seed/panoramica1960/800/600',
                'photographers'     => ['Heinrich Brüning'],
                'categories'        => ['panoramicas', 'nevados'],
                'tags'              => ['cordillera-blanca', 'huascaran', 'huaraz'],
            ],
            [
                'title'             => 'Semana Santa en Huaraz',
                'description'       => 'Procesión del Señor de la Soledad recorriendo el jirón Luzuriaga. Miles de feligreses acompañan la imagen entre flores y velas.',
                'year'              => 1963,
                'circa'             => false,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'Parroquia de Huaraz',
                'source_reference'  => 'PAR-007',
                'image_url'         => 'https://picsum.photos/seed/semanasanta1963/800/600',
                'photographers'     => ['María Elena Vásquez Robles'],
                'categories'        => ['fiestas', 'pre-terremoto'],
                'tags'              => ['semana-santa', 'huaraz', 'fiesta-patronal'],
            ],
            [
                'title'             => 'Puente Bedoya sobre el Río Santa',
                'description'       => 'El histórico puente de piedra que comunicaba Huaraz con el barrio de Belén. Construido en el siglo XIX, fue dañado en el aluvión de 1941.',
                'year'              => 1948,
                'circa'             => false,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'original_format'   => 'Papel fotográfico',
                'source_archive'    => 'Colección Vásquez',
                'source_reference'  => 'CV-003',
                'image_url'         => 'https://picsum.photos/seed/puente1948/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['puentes', 'pre-terremoto'],
                'tags'              => ['huaraz', 'rio-santa'],
            ],

            // ── TERREMOTO 1970 ───────────────────────────────────────────
            [
                'title'             => 'Escombros en el Centro de Huaraz',
                'description'       => 'Desolación total en el jirón Luzuriaga días después del terremoto del 31 de mayo. Las estructuras coloniales colapsaron en segundos.',
                'year'              => 1970,
                'circa'             => false,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::Terremoto1970,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'Archivo del Cuerpo de Bomberos',
                'source_reference'  => 'CB-001',
                'image_url'         => 'https://picsum.photos/seed/terremoto1970a/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['terremoto-1970', 'calles'],
                'tags'              => ['terremoto-1970', 'huaraz'],
            ],
            [
                'title'             => 'Yungay Sepultada bajo el Alud',
                'description'       => 'Fotografía tomada desde el Camposanto de Yungay, uno de los pocos puntos que quedó sobre la avalancha. La ciudad completa yace bajo metros de lodo y roca.',
                'year'              => 1970,
                'circa'             => false,
                'location'          => 'Catedral',
                'historical_period' => HistoricalPeriod::Terremoto1970,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'INDECI — Archivo Histórico',
                'source_reference'  => 'IND-1970-022',
                'image_url'         => 'https://picsum.photos/seed/yungay1970/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['terremoto-1970'],
                'tags'              => ['terremoto-1970'],
            ],
            [
                'title'             => 'Operaciones de Rescate en Huarupampa',
                'description'       => 'Brigadas de rescate internacionales trabajando entre los escombros del barrio Huarupampa. Al fondo, el Huascarán permanece inmutable.',
                'year'              => 1970,
                'circa'             => false,
                'location'          => 'Calles',
                'historical_period' => HistoricalPeriod::Terremoto1970,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'Cruz Roja Internacional',
                'source_reference'  => 'CRI-PE-070',
                'image_url'         => 'https://picsum.photos/seed/rescate1970/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['terremoto-1970', 'retratos'],
                'tags'              => ['terremoto-1970', 'huaraz'],
            ],

            // ── RECONSTRUCCIÓN ───────────────────────────────────────────
            [
                'title'             => 'Nueva Yungay — Primeras Viviendas',
                'description'       => 'Vista de las primeras construcciones prefabricadas del nuevo asentamiento de Yungay, ubicado en Yungay Alto, lejos de la zona sepultada.',
                'year'              => 1972,
                'circa'             => false,
                'location'          => 'Catedral',
                'historical_period' => HistoricalPeriod::Reconstruccion,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'CRYRZA — Archivo',
                'source_reference'  => 'CRY-072-014',
                'image_url'         => 'https://picsum.photos/seed/nuevayungay1972/800/600',
                'photographers'     => ['María Elena Vásquez Robles'],
                'categories'        => ['reconstruccion', 'calles'],
                'tags'              => ['reconstruccion'],
            ],
            [
                'title'             => 'Reconstrucción de la Plaza de Huaraz',
                'description'       => 'Obreros trabajando en los cimientos del nuevo parque central. El diseño moderno reemplaza el espacio colonial destruido.',
                'year'              => 1974,
                'circa'             => false,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::Reconstruccion,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'Municipalidad de Huaraz',
                'source_reference'  => 'MH-074-008',
                'image_url'         => 'https://picsum.photos/seed/reconstplaza1974/800/600',
                'photographers'     => ['Adolfo Cárdenas Torres'],
                'categories'        => ['reconstruccion', 'plazas'],
                'tags'              => ['reconstruccion', 'huaraz'],
            ],
            [
                'title'             => 'Retrato — Familia Superviviente de Centenario',
                'description'       => 'La familia Rojas frente a su nueva vivienda en el barrio Centenario, reconstruida con apoyo del gobierno.',
                'year'              => 1973,
                'circa'             => false,
                'location'          => 'Calles',
                'historical_period' => HistoricalPeriod::Reconstruccion,
                'original_format'   => 'Película de 35 mm',
                'source_archive'    => 'Colección Vásquez',
                'source_reference'  => 'CV-089',
                'image_url'         => 'https://picsum.photos/seed/familia1973/800/600',
                'photographers'     => ['María Elena Vásquez Robles'],
                'categories'        => ['retratos', 'reconstruccion'],
                'tags'              => ['reconstruccion', 'retrato', 'vida-cotidiana'],
            ],

            // ── SIGLO XXI ────────────────────────────────────────────────
            [
                'title'             => 'Nevado Huascarán al amanecer',
                'description'       => 'Primera luz sobre la cima del Huascarán (6,768 m.s.n.m.), el pico más alto del Perú y de los trópicos. Patrimonio Natural de la Humanidad.',
                'year'              => 2008,
                'circa'             => false,
                'location'          => 'Yungay',
                'historical_period' => HistoricalPeriod::SigloXxi,
                'original_format'   => 'Digital',
                'source_archive'    => 'Parque Nacional Huascarán',
                'source_reference'  => 'PNH-2008-031',
                'image_url'         => 'https://picsum.photos/seed/huascaran2008/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['nevados', 'panoramicas'],
                'tags'              => ['cordillera-blanca', 'huascaran'],
            ],
            [
                'title'             => 'Feria de Artesanías de Huaraz',
                'description'       => 'Feria artesanal en el Paseo Grau. Tejedoras de Vichay exhiben sus tejidos de lana de alpaca con patrones geométricos ancestrales.',
                'year'              => 2015,
                'circa'             => false,
                'location'          => 'Centro Histórico',
                'historical_period' => HistoricalPeriod::SigloXxi,
                'original_format'   => 'Digital',
                'source_archive'    => 'Dirección Regional de Cultura Ancash',
                'source_reference'  => 'DRC-2015-004',
                'image_url'         => 'https://picsum.photos/seed/feria2015/800/600',
                'photographers'     => ['María Elena Vásquez Robles'],
                'categories'        => ['fiestas', 'comercio', 'contemporaneo'],
                'tags'              => ['vida-cotidiana', 'fiesta-patronal'],
            ],
            [
                'title'             => 'Lago Llanganuco entre los nevados',
                'description'       => 'Aguas esmeraldas del lago Llanganuco reflejando las cumbres del Huascarán y el Chopicalqui. Paisaje emblemático de la Cordillera Blanca.',
                'year'              => 2019,
                'circa'             => false,
                'location'          => 'Yungay',
                'historical_period' => HistoricalPeriod::SigloXxi,
                'original_format'   => 'Digital',
                'source_archive'    => 'Parque Nacional Huascarán',
                'source_reference'  => 'PNH-2019-107',
                'image_url'         => 'https://picsum.photos/seed/llanganuco2019/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['rios', 'nevados', 'panoramicas'],
                'tags'              => ['cordillera-blanca'],
            ],
            [
                'title'             => 'Escuela Rural en Recuay',
                'description'       => 'Niños de la escuela primaria de Recuay durante el izamiento de la bandera.',
                'year'              => 2011,
                'circa'             => false,
                'location'          => 'Puentes',
                'historical_period' => HistoricalPeriod::SigloXxi,
                'original_format'   => 'Digital',
                'source_archive'    => 'UGEL Recuay',
                'source_reference'  => 'UGEL-2011-015',
                'image_url'         => 'https://picsum.photos/seed/escuela2011/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['educacion', 'retratos', 'contemporaneo'],
                'tags'              => ['retrato', 'vida-cotidiana'],
            ],
            [
                'title'             => 'Río Santa desde el puente Villón',
                'description'       => 'El Río Santa en su recorrido por el Callejón de Huaylas a la altura de Huaraz.',
                'year'              => 2017,
                'circa'             => false,
                'location'          => 'Plaza',
                'historical_period' => HistoricalPeriod::SigloXxi,
                'original_format'   => 'Digital',
                'source_archive'    => 'ANA — Autoridad Nacional del Agua',
                'source_reference'  => 'ANA-2017-042',
                'image_url'         => 'https://picsum.photos/seed/riosanta2017/800/600',
                'photographers'     => ['Autor Desconocido'],
                'categories'        => ['rios', 'contemporaneo'],
                'tags'              => ['rio-santa', 'huaraz'],
            ],
        ];

        foreach ($photos as $data) {
            $photo = Photo::create([
                'title'             => $data['title'],
                'description'       => $data['description'],
                'year'              => $data['year'],
                'circa'             => $data['circa'] ?? false,
                'location_id'       => $locations[$data['location']] ?? null,
                'historical_period' => $data['historical_period'],
                'original_format'   => $data['original_format'] ?? null,
                'source_archive'    => $data['source_archive'] ?? null,
                'source_reference'  => $data['source_reference'] ?? null,
                'image_url'         => $data['image_url'],
                'is_published'      => true,
            ]);

            $photo->photographers()->attach(
                collect($data['photographers'])
                    ->map(fn($name) => $photographers[$name] ?? null)
                    ->filter()
                    ->mapWithKeys(fn($id) => [$id => ['role' => 'photographer']])
                    ->all()
            );

            $photo->categories()->attach(
                collect($data['categories'])
                    ->map(fn($slug) => $categories[$slug] ?? null)
                    ->filter()
                    ->all()
            );

            $photo->tags()->attach(
                collect($data['tags'])
                    ->map(fn($slug) => $tags[$slug] ?? null)
                    ->filter()
                    ->all()
            );
        }
    }
}

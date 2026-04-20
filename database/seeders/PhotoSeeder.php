<?php

namespace Database\Seeders;

use App\Enums\HistoricalPeriod;
use App\Models\Category;
use App\Models\Location;
use App\Models\Photo;
use App\Models\Photographer;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        // precargar ids necesarios para evitar N+1
        $cats  = Category::pluck('id', 'slug');
        $locs  = Location::pluck('id', 'name');
        $phots = Photographer::pluck('id', 'full_name');

        // helper para obtener id o null sin exception
        $c = fn(string $slug) => $cats[$slug] ?? null;
        $l = fn(string $name) => $locs[$name] ?? null;
        $p = fn(string $name) => $phots[$name] ?? null;

        $photos = [
            // ─── panoramicas ───
            [
                'title'             => 'Panorámica de Huaraz antes del terremoto',
                'description'       => 'Vista panorámica de la ciudad de Huaraz desde el cerro Pumacayan, mostrando el trazado original del casco urbano con sus casonas coloniales y la Cordillera Blanca al fondo.',
                'year'              => 1965,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Archivo Regional de Ancash',
                'image_url'         => 'https://picsum.photos/seed/panorama_huaraz/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('panoramica'), $c('geo')],
                'photographer'      => $p('Autor Desconocido (Colección Ancash)'),
            ],
            [
                'title'             => 'Vista aérea de Ranrahirca',
                'description'       => 'Fotografía panorámica del pueblo de Ranrahirca, en el Callejón de Huaylas, tomada poco antes del aluvión de 1962 que lo sepultó casi por completo.',
                'year'              => 1961,
                'circa'             => true,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Colección Familia Villanueva',
                'image_url'         => 'https://picsum.photos/seed/ranrahirca_aerea/1200/800',
                'location'          => 'Ranrahirca',
                'categories'        => [$c('panoramica')],
                'photographer'      => null,
            ],
            // ─── plaza de armas ───
            [
                'title'             => 'Plaza de Armas de Huaraz',
                'description'       => 'La Plaza de Armas de Huaraz con su fuente central y la Catedral al fondo, escena de vida cotidiana con pobladores en traje de festividad.',
                'year'              => 1958,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Archivo Municipal de Huaraz',
                'image_url'         => 'https://picsum.photos/seed/plaza_huaraz_1958/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('plaza-armas-catedral')],
                'photographer'      => $p('Abraham Guillén Carrillo'),
            ],
            [
                'title'             => 'Catedral de Huaraz — fachada colonial',
                'description'       => 'Fachada barroca de la Catedral de Santiago Apóstol de Huaraz, construida en el siglo XVII y destruida casi en su totalidad por el terremoto de 1970.',
                'year'              => 1962,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Instituto Nacional de Cultura — Ancash',
                'image_url'         => 'https://picsum.photos/seed/catedral_huaraz/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('plaza-armas-catedral')],
                'photographer'      => $p('Abraham Guillén Carrillo'),
            ],
            // ─── barrios ───
            [
                'title'             => 'Barrio La Soledad — vida cotidiana',
                'description'       => 'Escena de la vida barrial en La Soledad, uno de los barrios más antiguos de Huaraz, con su capilla al fondo y pobladores en faena comunal.',
                'year'              => 1955,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Colección Privada Dr. José Lara',
                'image_url'         => 'https://picsum.photos/seed/barrio_soledad/900/700',
                'location'          => 'La Soledad',
                'categories'        => [$c('barrios'), $c('barrio-la-soledad')],
                'photographer'      => null,
            ],
            [
                'title'             => 'Barrio Centenario — calle empedrada',
                'description'       => 'Vista de una calle típica del barrio Centenario con sus casas de adobe y techos de teja roja, característica arquitectura ancashina pre-terremoto.',
                'year'              => 1963,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Municipalidad Provincial de Huaraz',
                'image_url'         => 'https://picsum.photos/seed/barrio_centenario/900/700',
                'location'          => 'Centenario',
                'categories'        => [$c('barrios'), $c('barrio-centenario')],
                'photographer'      => null,
            ],
            [
                'title'             => 'Barrio Huarupampa — fiestas patronales',
                'description'       => 'Celebración de la festividad patronal en el barrio de Huarupampa. Se aprecian las danzas típicas de los negritos y la procesión religiosa.',
                'year'              => 1960,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Archivo Fotográfico Regional Chavín',
                'image_url'         => 'https://picsum.photos/seed/huarupampa_fiesta/900/700',
                'location'          => 'Huarupampa',
                'categories'        => [$c('barrios'), $c('barrio-huarupampa'), $c('sociedad-cultura')],
                'photographer'      => $p('Abraham Guillén Carrillo'),
            ],
            // ─── puentes ───
            [
                'title'             => 'Puente Bedoya sobre el río Quillcay',
                'description'       => 'El histórico Puente Bedoya, puente colgante de madera que unía el centro de Huaraz con el barrio de Huarupampa. Fue arrastrado por el aluvión de 1941.',
                'year'              => 1938,
                'circa'             => true,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Colección Brüning — Museo Etnológico de Berlín',
                'image_url'         => 'https://picsum.photos/seed/puente_bedoya/1100/750',
                'location'          => 'Huaraz',
                'categories'        => [$c('puentes')],
                'photographer'      => $p('Hans Heinrich Brüning'),
            ],
            // ─── calles ───
            [
                'title'             => 'Jirón Luzuriaga en días de mercado',
                'description'       => 'La arteria comercial de Huaraz, el Jirón Luzuriaga, repleto de vendedores ambulantes y transeúntes en un día de mercado. Se observan las tiendas coloniales con portales.',
                'year'              => 1952,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Archivo Municipal de Huaraz',
                'image_url'         => 'https://picsum.photos/seed/jr_luzuriaga/1100/750',
                'location'          => 'Huaraz',
                'categories'        => [$c('calles')],
                'photographer'      => $p('Abraham Guillén Carrillo'),
            ],
            // ─── terremoto 1970 ───
            [
                'title'             => 'Huaraz en escombros — 31 de mayo 1970',
                'description'       => 'Vista de la ciudad de Huaraz inmediatamente después del terremoto del 31 de mayo de 1970. Casi el 95% de las edificaciones colapsaron. Se estima más de 10,000 víctimas solo en la ciudad.',
                'year'              => 1970,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::Terremoto1970,
                'provider'          => 'CRYRZA — Comisión de Reconstrucción',
                'image_url'         => 'https://picsum.photos/seed/huaraz_escombros_1970/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('terremoto-1970'), $c('desastres-ancash')],
                'photographer'      => null,
            ],
            [
                'title'             => 'Yungay sepultada — Aluvión de 1970',
                'description'       => 'El pueblo de Yungay fue completamente sepultado por un alud de hielo y roca proveniente del Huascarán Norte durante el terremoto. Solo sobrevivieron unas 300 personas de 25,000 habitantes.',
                'year'              => 1970,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::Terremoto1970,
                'provider'          => 'Fondo Documental CRYRZA',
                'image_url'         => 'https://picsum.photos/seed/yungay_aluvion_1970/1200/800',
                'location'          => 'Camposanto de Yungay',
                'categories'        => [$c('aluvion-1970'), $c('terremoto-1970')],
                'photographer'      => $p('Abraham Guillén Carrillo'),
            ],
            // ─── reconstruccion ───
            [
                'title'             => 'Nueva Huaraz en construcción',
                'description'       => 'Vista de la nueva ciudad de Huaraz durante el proceso de reconstrucción, con el trazado urbano moderno en damero y los primeros edificios de concreto armado antisísmico.',
                'year'              => 1975,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::Reconstruccion,
                'provider'          => 'Ministerio de Vivienda — Archivo de Reconstrucción',
                'image_url'         => 'https://picsum.photos/seed/nueva_huaraz_1975/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('geo'), $c('panoramica')],
                'photographer'      => null,
            ],
            // ─── siglo XXI ───
            [
                'title'             => 'Nevado Huascarán desde Musho',
                'description'       => 'Fotografía del Huascarán Norte y Sur (6,768 m.s.n.m.) tomada desde el poblado de Musho. Pico más alto del Perú y de la zona tropical del mundo.',
                'year'              => 2018,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::SigloXxi,
                'provider'          => 'Fotografía: Carlos E. Sánchez Huanca',
                'image_url'         => 'https://picsum.photos/seed/huascaran_musho/1400/900',
                'location'          => 'Huascarán',
                'categories'        => [$c('pnh'), $c('pnh-nevados'), $c('nev-huascaran')],
                'photographer'      => $p('Carlos Enrique Sánchez Huanca'),
            ],
            [
                'title'             => 'Alpamayo — la montaña más bella del mundo',
                'description'       => 'El Alpamayo (5,947 m.s.n.m.) con su característica cara suroeste en forma de pirámide perfecta. Fue elegida en 1966 como la montaña más bella del mundo.',
                'year'              => 2020,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::SigloXxi,
                'provider'          => 'Fotografía: Carlos E. Sánchez Huanca',
                'image_url'         => 'https://picsum.photos/seed/alpamayo_pirámide/1400/900',
                'location'          => 'Alpamayo',
                'categories'        => [$c('pnh'), $c('pnh-nevados'), $c('nev-alpamayo')],
                'photographer'      => $p('Carlos Enrique Sánchez Huanca'),
            ],
            // ─── patrimonio arqueologico ───
            [
                'title'             => 'Templo de Sechín — bajorrelieve guerrero',
                'description'       => 'Uno de los imponentes bajorrelieves del Templo de Sechín (3,500 a.C.), en Casma, Ancash. Representa guerreros y prisioneros en una escena de sacrificio.',
                'year'              => 2015,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::SigloXxi,
                'provider'          => 'Ministerio de Cultura — Museo de Sechín',
                'image_url'         => 'https://picsum.photos/seed/sechin_bajorrelieve/1200/800',
                'location'          => 'Sechin',
                'categories'        => [$c('patrimonio-arqueologico'), $c('arq-sechin')],
                'photographer'      => null,
            ],
            [
                'title'             => 'Chavín de Huántar — lanzón monolítico',
                'description'       => 'El lanzón monolítico de Chavín de Huántar, divinidad principal del horizonte Chavín (900-200 a.C.). Ubicado en la galería central del templo subterráneo.',
                'year'              => 2017,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::SigloXxi,
                'provider'          => 'UNESCO — Patrimonio Mundial',
                'image_url'         => 'https://picsum.photos/seed/chavin_lanzon/1200/800',
                'location'          => 'Chavin',
                'categories'        => [$c('patrimonio-arqueologico'), $c('arq-chavin')],
                'photographer'      => null,
            ],
            // ─── tradiciones huaraz ───
            [
                'title'             => 'Semana Santa Huaracina — procesión nocturna',
                'description'       => 'La imponente procesión del Señor de la Resurrección durante la Semana Santa Huaracina. Miles de fieles acompañan al anda iluminada por cirios en las madrugadas de la ciudad reconstruida.',
                'year'              => 2019,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::SigloXxi,
                'provider'          => 'Obispado de Huaraz',
                'image_url'         => 'https://picsum.photos/seed/semana_santa_huaraz/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('tradiciones-huaraz'), $c('esp-semana-santa')],
                'photographer'      => $p('Carlos Enrique Sánchez Huanca'),
            ],
            [
                'title'             => 'Señor de Mayo — festividad patronal de Huaraz',
                'description'       => 'Multitud durante la procesión del Señor de Mayo, festividad más importante de Huaraz celebrada en el mes de mayo. La imagen recorre las calles principales acompañada por danzantes y bandas de músicos.',
                'year'              => 2022,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::SigloXxi,
                'provider'          => 'Municipalidad Provincial de Huaraz',
                'image_url'         => 'https://picsum.photos/seed/senor_de_mayo/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('tradiciones-huaraz'), $c('esp-senor-mayo')],
                'photographer'      => $p('Carlos Enrique Sánchez Huanca'),
            ],
            // ─── colecciones de fotografos consagrados ───
            [
                'title'             => 'Brüning — retrato de familia ancashina (XIX)',
                'description'       => 'Retrato de familia ancashina captado por Hans Brüning. La composición muestra la vestimenta tradicional de finales del siglo XIX en el Callejón de Huaylas.',
                'year'              => 1895,
                'circa'             => true,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Museo Etnológico de Berlín — Archivo Brüning',
                'image_url'         => 'https://picsum.photos/seed/bruning_familia/900/1200',
                'location'          => 'Huaraz',
                'categories'        => [$c('fotografos-consagrados'), $c('siglo-xix'), $c('col-familia')],
                'photographer'      => $p('Hans Heinrich Brüning'),
            ],
            [
                'title'             => 'Brüning — paisaje del Callejón de Huaylas',
                'description'       => 'Extraordinaria toma del Callejón de Huaylas realizada por Brüning, mostrando la amplitud del valle, los cultivos en andenes y los nevados de la Cordillera Blanca al fondo.',
                'year'              => 1900,
                'circa'             => true,
                'historical_period' => HistoricalPeriod::PreTerremoto,
                'provider'          => 'Museo Etnológico de Berlín — Archivo Brüning',
                'image_url'         => 'https://picsum.photos/seed/bruning_callejon/1400/900',
                'location'          => 'Huaraz',
                'categories'        => [$c('fotografos-consagrados'), $c('siglo-xix'), $c('col-paisajes')],
                'photographer'      => $p('Hans Heinrich Brüning'),
            ],
            [
                'title'             => 'Guillén — reconstrucción de la Plaza Mayor',
                'description'       => 'Fotografía del proceso de reconstrucción de la Plaza de Armas de Huaraz tomada por Abraham Guillén, mostrando los trabajos en el nuevo ayuntamiento.',
                'year'              => 1974,
                'circa'             => false,
                'historical_period' => HistoricalPeriod::Reconstruccion,
                'provider'          => 'Archivo Personal Familia Guillén',
                'image_url'         => 'https://picsum.photos/seed/guillen_plaza/1200/800',
                'location'          => 'Huaraz',
                'categories'        => [$c('fotografos-consagrados'), $c('siglo-xx'), $c('col-ciudad')],
                'photographer'      => $p('Abraham Guillén Carrillo'),
            ],
        ];

        foreach ($photos as $d) {
            $photo = Photo::create([
                'title'             => $d['title'],
                'description'       => $d['description'],
                'year'              => $d['year'],
                'circa'             => $d['circa'],
                'historical_period' => $d['historical_period'],
                'source_archive'    => $d['provider'],
                'provider'          => $d['provider'],
                'image_url'         => $d['image_url'],
                'location_id'       => $l($d['location']),
                'is_published'      => true,
            ]);

            // asignar fotógrafo si se especifica
            if ($d['photographer']) {
                $photo->photographers()->attach($d['photographer'], ['role' => 'photographer']);
            }

            // asignar categorias filtrando nulos
            $catIds = array_filter($d['categories'] ?? []);
            if ($catIds) {
                $photo->categories()->sync($catIds);
            }
        }
    }
}

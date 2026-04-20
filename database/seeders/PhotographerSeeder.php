<?php

namespace Database\Seeders;

use App\Models\Photographer;
use Illuminate\Database\Seeder;

class PhotographerSeeder extends Seeder
{
    public function run(): void
    {
        // ─────────────────────────────────────────────────────────────
        // SIGLO XIX
        // ─────────────────────────────────────────────────────────────

        Photographer::create([
            'full_name'        => 'Hans Heinrich Brüning',
            'birth_place'      => 'Itzehoe, Schleswig-Holstein, Alemania',
            'birth_date'       => '1848-05-16',
            'death_place'      => 'Lima, Perú',
            'death_date'       => '1928-12-08',
            'bio'              => 'Etnólogo y fotógrafo alemán afincado en el Perú desde 1875. Documentó extensamente la vida, costumbres, arquitectura y paisajes del norte peruano, incluyendo el Callejón de Huaylas, a finales del siglo XIX y principios del XX. Su trabajo abarca más de 5,000 fotografías que hoy se conservan en el Museo Etnológico de Berlín.',
            'studies_critique' => 'Su archivo es considerado una de las fuentes primarias más completas de la etnografía andina del norte peruano. Capturó ritos, vestimentas y estructuras arquitectónicas que desaparecieron con el terremoto de 1970. Los historiadores reconocen en su obra una combinación única de rigor científico y sensibilidad estética.',
            'portrait_url'     => 'https://picsum.photos/seed/bruning_portrait/400/400',
        ]);

        Photographer::create([
            'full_name'        => 'Eugene Courret',
            'birth_place'      => 'París, Francia',
            'birth_date'       => '1841-03-10',
            'death_place'      => 'Lima, Perú',
            'death_date'       => '1920-06-15',
            'bio'              => 'Fotógrafo francés que fundó junto a su hermano Aquiles el estudio fotográfico Courret Hermanos en Lima (1863), el más afamado del siglo XIX en el Perú. Realizó expediciones al interior del país documentando ciudades como Huaraz, Recuay y el Callejón de Huaylas.',
            'studies_critique' => 'Su retrato de personajes notables y escenas costumbristas del Perú decimonónico constituye un legado visual sin precedentes. La Biblioteca Nacional del Perú conserva centenares de sus placas de colodión.',
            'portrait_url'     => 'https://picsum.photos/seed/courret_portrait/400/400',
        ]);

        // ─────────────────────────────────────────────────────────────
        // SIGLO XX - PERU
        // ─────────────────────────────────────────────────────────────

        Photographer::create([
            'full_name'        => 'Martín Chambi Jiménez',
            'birth_place'      => 'Coaza, Puno, Perú',
            'birth_date'       => '1891-11-05',
            'death_place'      => 'Cusco, Perú',
            'death_date'       => '1973-09-13',
            'bio'              => 'Considerado el primer gran fotógrafo indígena de América Latina. Aunque su base fue Cusco, su técnica e influencia se extendieron por toda la fotografía peruana del siglo XX. Documentó la vida andina con una sensibilidad única, combinando el retrato formal con escenas etnográficas espontáneas. Aprendió fotografía con Max T. Vargas en Arequipa.',
            'studies_critique' => 'Su trabajo es objeto de estudio en las principales escuelas de fotografía del mundo. En 1979 el Museo de Arte Moderno de Nueva York (MoMA) adquirió parte de su archivo. Se le considera un puente entre la tradición andina y la modernidad fotográfica occidental.',
            'portrait_url'     => 'https://picsum.photos/seed/chambi_portrait/400/400',
        ]);

        Photographer::create([
            'full_name'        => 'Abraham Guillén Carrillo',
            'birth_place'      => 'Huaraz, Ancash, Perú',
            'birth_date'       => '1920-03-10',
            'death_place'      => 'Huaraz, Ancash, Perú',
            'death_date'       => '1985-07-22',
            'bio'              => 'Fotógrafo huaracino que documentó la ciudad de Huaraz desde la década de 1940 hasta su muerte. Su archivo personal es una de las mayores fuentes de memoria gráfica del Huaraz pre-terremoto y del proceso de reconstrucción posterior al sismo del 31 de mayo de 1970. Mantuvo un estudio fotográfico en el Jirón Luzuriaga durante 30 años.',
            'studies_critique' => 'Su obra constituye un testimonio visual irreemplazable de la Huaraz que fue y la que nació de sus cenizas. Aunque técnicamente sencillas, sus composiciones tienen un valor documental histórico de primer orden. El Archivo Regional de Ancash conserva más de 2,000 negativos de su autoría.',
            'portrait_url'     => 'https://picsum.photos/seed/guillen_portrait/400/400',
        ]);

        Photographer::create([
            'full_name'        => 'Rómulo Cueto Fernandini',
            'birth_place'      => 'Huaraz, Ancash, Perú',
            'birth_date'       => '1935-08-21',
            'death_place'      => 'Lima, Perú',
            'death_date'       => '2001-04-03',
            'bio'              => 'Fotográfo y periodista ancashino que colaboró con los principales diarios limeños durante los años sesenta y setenta. Fue uno de los primeros reporteros gráficos en llegar a Yungay tras el aluvión del 31 de mayo de 1970, documentando la tragedia en imágenes que recorrieron el mundo. Su trabajo fue publicado en Life, Time y La Prensa.',
            'studies_critique' => 'Sus fotografías de la catástrofe de 1970 son documentos históricos de primer orden. Algunos historiadores lo consideran el único fotógrafo local que logró registrar los primeros días post-aluvión en Yungay con calidad periodística.',
            'portrait_url'     => 'https://picsum.photos/seed/cueto_portrait/400/400',
        ]);

        Photographer::create([
            'full_name'        => 'Sebastián Rodríguez Vásquez',
            'birth_place'      => 'Carhuaz, Ancash, Perú',
            'birth_date'       => '1955-02-14',
            'death_place'      => 'Huaraz, Ancash, Perú',
            'death_date'       => '2018-11-09',
            'bio'              => 'Fotógrafo autodidacta de Carhuaz especializado en fotografía documental y etnográfica. Durante tres décadas recorrió las provincias ancashinas registrando fiestas patronales, faenas comunales, mercados y la vida cotidiana de los pueblos del Callejón de Huaylas y el Conchucos. Publicó tres libros de fotografía sobre Ancash.',
            'studies_critique' => 'Su mirada etnográfica y su paciencia para capturar instantes de la vida comunal lo colocan en la tradición de los grandes documentalistas andinos. Sus libros son referencia obligada para investigadores de la cultura ancashina.',
            'portrait_url'     => 'https://picsum.photos/seed/rodriguez_portrait/400/400',
        ]);

        // ─────────────────────────────────────────────────────────────
        // SIGLO XXI
        // ─────────────────────────────────────────────────────────────

        Photographer::create([
            'full_name'        => 'Carlos Enrique Sánchez Huanca',
            'birth_place'      => 'Huaraz, Ancash, Perú',
            'birth_date'       => '1978-09-15',
            'death_place'      => null,
            'death_date'       => null,
            'bio'              => 'Fotógrafo contemporáneo ancashino especializado en fotografía de montaña, paisaje y medioambiente en el Parque Nacional Huascarán. Ha expuesto en Lima, España, Alemania y Japón. Sus trabajos han aparecido en National Geographic en Español, Rumbos de Sol & Piedra y la revista Caretas. Colabora con el Programa de las Naciones Unidas para el Medio Ambiente (PNUMA).',
            'studies_critique' => 'Su trabajo fusiona la técnica fotográfica de alta montaña con una sensibilidad andina que rescata la grandiosidad del paisaje ancashino. Destaca por sus composiciones largas de glaciares al amanecer y el uso magistral de la luz natural en alturas superiores a los 5,000 msnm.',
            'portrait_url'     => 'https://picsum.photos/seed/sanchez_portrait/400/400',
        ]);

        Photographer::create([
            'full_name'        => 'María Lucía Vásquez Ríos',
            'birth_place'      => 'Lima, Perú',
            'birth_date'       => '1985-06-03',
            'death_place'      => null,
            'death_date'       => null,
            'bio'              => 'Fotógrafa documentalista limeña con base en Huaraz desde 2010. Ha dedicado su obra a registrar la transformación de los glaciares de la Cordillera Blanca como consecuencia del cambio climático, así como las comunidades campesinas que dependen del agua glaciar. Premio Nacional de Fotoperiodismo 2019.',
            'studies_critique' => 'Su serie "Glaciares que se van" (2018) es reconocida internacionalmente como una de las mejores documentaciones del retroceso glaciar en los Andes peruanos. Combina datos científicos con narrativa visual de alto impacto emocional.',
            'portrait_url'     => 'https://picsum.photos/seed/vasquez_portrait/400/400',
        ]);

        Photographer::create([
            'full_name'        => 'Jorge Luis Gamboa Mendoza',
            'birth_place'      => 'Yungay, Ancash, Perú',
            'birth_date'       => '1992-01-28',
            'death_place'      => null,
            'death_date'       => null,
            'bio'              => 'Fotógrafo yungaíno de la generación post-milenio. Hijo de sobrevivientes del aluvión de 1970, su obra documenta la memoria colectiva de Yungay Nueva y el Camposanto, así como las tradiciones vivas del Valle del Santa. Ha colaborado con museos y archivos municipales para digitalizar el patrimonio fotográfico de la provincia de Yungay.',
            'studies_critique' => 'Su trabajo es notable por la tensión entre duelo histórico y vitalidad presente. Sus retratos de los "últimos testigos" del aluvión de 1970 son un aporte único a la memoria colectiva ancashina.',
            'portrait_url'     => 'https://picsum.photos/seed/gamboa_portrait/400/400',
        ]);

        // ─────────────────────────────────────────────────────────────
        // ARCHIVO ANONIMO
        // ─────────────────────────────────────────────────────────────

        Photographer::create([
            'full_name'        => 'Autor Desconocido (Colección Ancash)',
            'birth_place'      => null,
            'birth_date'       => null,
            'death_place'      => null,
            'death_date'       => null,
            'bio'              => 'Fotografías de autor no identificado pertenecientes a fondos documentales de colecciones privadas, archivos municipales y repositorios familiares de la región Ancash. Incluye piezas de los siglos XIX, XX y XXI cuya autoría no ha podido establecerse con certeza.',
            'studies_critique' => null,
            'portrait_url'     => null,
        ]);
    }
}

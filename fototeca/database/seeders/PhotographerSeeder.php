<?php

namespace Database\Seeders;

use App\Models\Photographer;
use Illuminate\Database\Seeder;

class PhotographerSeeder extends Seeder
{
    public function run(): void
    {
        Photographer::create([
            'name'          => 'Autor Desconocido',
            'is_anonymous'  => true,
            'biography'     => 'Fotografías cuyo autor no ha podido ser identificado hasta la fecha.',
            'portrait_path' => 'https://picsum.photos/seed/anon/400/400',
        ]);

        Photographer::create([
            'name'          => 'Adolfo Cárdenas Torres',
            'birth_year'    => 1918,
            'death_year'    => 1982,
            'nationality'   => 'Peruana',
            'biography'     => 'Fotógrafo ancashino autodidacta que documentó la vida cotidiana de Huaraz desde los años cuarenta hasta el devastador terremoto de 1970. Su archivo rescatado es una de las pocas memorias visuales completas del Huaraz colonial.',
            'portrait_path' => 'https://picsum.photos/seed/adolfo/400/400',
        ]);

        Photographer::create([
            'name'          => 'María Elena Vásquez Robles',
            'pseudonym'     => 'M.E. Vásquez',
            'birth_year'    => 1935,
            'death_year'    => null,
            'nationality'   => 'Peruana',
            'biography'     => 'Primera fotógrafa profesional documentada en la región Ancash. Especializada en retratos y registro de festividades tradicionales. Sobrevivió al terremoto y dedicó su obra posterior a testimoniar la reconstrucción de la región.',
            'portrait_path' => 'https://picsum.photos/seed/maria/400/400',
        ]);

        Photographer::create([
            'name'          => 'Heinrich Brüning',
            'birth_year'    => 1848,
            'death_year'    => 1928,
            'nationality'   => 'Alemana',
            'biography'     => 'Ingeniero e investigador alemán que documentó el Perú a finales del siglo XIX y principios del XX. Sus fotografías son patrimonio histórico de primer orden para el conocimiento de la vida andina premoderna.',
            'portrait_path' => 'https://picsum.photos/seed/heinrich/400/400',
        ]);
    }
}

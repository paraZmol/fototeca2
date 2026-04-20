<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Terremoto 1970',         'slug' => 'terremoto-1970'],
            ['name' => 'Huaraz',                  'slug' => 'huaraz'],
            ['name' => 'Cordillera Blanca',       'slug' => 'cordillera-blanca'],
            ['name' => 'Arquitectura Colonial',   'slug' => 'arquitectura-colonial'],
            ['name' => 'Semana Santa',            'slug' => 'semana-santa'],
            ['name' => 'Mercado Tradicional',     'slug' => 'mercado-tradicional'],
            ['name' => 'Retrato',                 'slug' => 'retrato'],
            ['name' => 'Nevado Huascarán',        'slug' => 'huascaran'],
            ['name' => 'Fiesta Patronal',         'slug' => 'fiesta-patronal'],
            ['name' => 'Vida Cotidiana',          'slug' => 'vida-cotidiana'],
            ['name' => 'Reconstrucción',          'slug' => 'reconstruccion'],
            ['name' => 'Río Santa',               'slug' => 'rio-santa'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // region ancash
        $ancash = Location::create(['name' => 'Ancash', 'type' => 'region']);

        // --- provincia huaraz ---
        $huaraz = Location::create(['parent_id' => $ancash->id, 'name' => 'Huaraz', 'type' => 'province']);

        // distritos de huaraz
        $distHuaraz = Location::create(['parent_id' => $huaraz->id, 'name' => 'Huaraz', 'type' => 'district']);
        Location::create(['parent_id' => $distHuaraz->id, 'name' => 'Belén',       'type' => 'neighborhood']);
        Location::create(['parent_id' => $distHuaraz->id, 'name' => 'San Francisco','type' => 'neighborhood']);
        Location::create(['parent_id' => $distHuaraz->id, 'name' => 'La Soledad',  'type' => 'neighborhood']);
        Location::create(['parent_id' => $distHuaraz->id, 'name' => 'Huarupampa',  'type' => 'neighborhood']);
        Location::create(['parent_id' => $distHuaraz->id, 'name' => 'Centenario',  'type' => 'neighborhood']);
        Location::create(['parent_id' => $distHuaraz->id, 'name' => 'Nicrupampa',  'type' => 'neighborhood']);

        $distIndep = Location::create(['parent_id' => $huaraz->id, 'name' => 'Independencia', 'type' => 'district']);
        Location::create(['parent_id' => $distIndep->id, 'name' => 'Palmira',    'type' => 'neighborhood']);
        Location::create(['parent_id' => $distIndep->id, 'name' => 'Villón Alto','type' => 'neighborhood']);
        Location::create(['parent_id' => $distIndep->id, 'name' => 'Marian',     'type' => 'neighborhood']);

        Location::create(['parent_id' => $huaraz->id, 'name' => 'Cochabamba',  'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Colcabamba',  'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Huanchay',    'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Jangas',      'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'La Libertad', 'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Olleros',     'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Pampas',      'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Pario',       'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Tarica',      'type' => 'district']);

        // --- provincia yungay ---
        $yungay = Location::create(['parent_id' => $ancash->id, 'name' => 'Yungay', 'type' => 'province']);
        $distYungay = Location::create(['parent_id' => $yungay->id, 'name' => 'Yungay', 'type' => 'district']);
        Location::create(['parent_id' => $distYungay->id, 'name' => 'Camposanto de Yungay', 'type' => 'place']);
        Location::create(['parent_id' => $yungay->id, 'name' => 'Mancos',     'type' => 'district']);
        Location::create(['parent_id' => $yungay->id, 'name' => 'Matacoto',   'type' => 'district']);
        Location::create(['parent_id' => $yungay->id, 'name' => 'Quillo',     'type' => 'district']);
        Location::create(['parent_id' => $yungay->id, 'name' => 'Ranrahirca', 'type' => 'district']);
        Location::create(['parent_id' => $yungay->id, 'name' => 'Shupluy',    'type' => 'district']);
        Location::create(['parent_id' => $yungay->id, 'name' => 'Yanama',     'type' => 'district']);

        // --- provincia carhuaz ---
        $carhuaz = Location::create(['parent_id' => $ancash->id, 'name' => 'Carhuaz', 'type' => 'province']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Carhuaz',   'type' => 'district']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Acopampa',  'type' => 'district']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Anta',      'type' => 'district']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Ataquero',  'type' => 'district']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Marcará',   'type' => 'district']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Shilla',    'type' => 'district']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Tinco',     'type' => 'district']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Yungar',    'type' => 'district']);

        // --- provincia recuay ---
        $recuay = Location::create(['parent_id' => $ancash->id, 'name' => 'Recuay', 'type' => 'province']);
        Location::create(['parent_id' => $recuay->id, 'name' => 'Recuay',   'type' => 'district']);
        Location::create(['parent_id' => $recuay->id, 'name' => 'Catac',    'type' => 'district']);
        Location::create(['parent_id' => $recuay->id, 'name' => 'Llacllin', 'type' => 'district']);
        Location::create(['parent_id' => $recuay->id, 'name' => 'Pampas Chico', 'type' => 'district']);
        Location::create(['parent_id' => $recuay->id, 'name' => 'Pátapo',   'type' => 'district']);
        Location::create(['parent_id' => $recuay->id, 'name' => 'Poccpa',   'type' => 'district']);

        // --- provincia aija ---
        $aija = Location::create(['parent_id' => $ancash->id, 'name' => 'Aija', 'type' => 'province']);
        Location::create(['parent_id' => $aija->id, 'name' => 'Aija', 'type' => 'district']);

        // --- provincia bolognesi ---
        $bolognesi = Location::create(['parent_id' => $ancash->id, 'name' => 'Bolognesi', 'type' => 'province']);
        Location::create(['parent_id' => $bolognesi->id, 'name' => 'Chiquián', 'type' => 'district']);

        // --- provincia casma ---
        $casma = Location::create(['parent_id' => $ancash->id, 'name' => 'Casma', 'type' => 'province']);
        Location::create(['parent_id' => $casma->id, 'name' => 'Casma',  'type' => 'district']);
        Location::create(['parent_id' => $casma->id, 'name' => 'Sechin', 'type' => 'place']);

        // --- provincia huari ---
        $huari = Location::create(['parent_id' => $ancash->id, 'name' => 'Huari', 'type' => 'province']);
        Location::create(['parent_id' => $huari->id, 'name' => 'Huari',  'type' => 'district']);
        Location::create(['parent_id' => $huari->id, 'name' => 'Chavin', 'type' => 'district']);

        // --- provincia huarmey ---
        $huarmey = Location::create(['parent_id' => $ancash->id, 'name' => 'Huarmey', 'type' => 'province']);
        Location::create(['parent_id' => $huarmey->id, 'name' => 'Huarmey', 'type' => 'district']);

        // --- provincia santa ---
        $santa = Location::create(['parent_id' => $ancash->id, 'name' => 'Santa', 'type' => 'province']);
        Location::create(['parent_id' => $santa->id, 'name' => 'Chimbote',       'type' => 'district']);
        Location::create(['parent_id' => $santa->id, 'name' => 'Nuevo Chimbote', 'type' => 'district']);

        // --- provincia pallasca ---
        $pallasca = Location::create(['parent_id' => $ancash->id, 'name' => 'Pallasca', 'type' => 'province']);
        Location::create(['parent_id' => $pallasca->id, 'name' => 'Cabana', 'type' => 'district']);

        // --- provincia pomabamba ---
        $pomabamba = Location::create(['parent_id' => $ancash->id, 'name' => 'Pomabamba', 'type' => 'province']);
        Location::create(['parent_id' => $pomabamba->id, 'name' => 'Pomabamba', 'type' => 'district']);

        // --- provincia sihuas ---
        $sihuas = Location::create(['parent_id' => $ancash->id, 'name' => 'Sihuas', 'type' => 'province']);
        Location::create(['parent_id' => $sihuas->id, 'name' => 'Sihuas', 'type' => 'district']);

        // lugares especiales del parque nacional
        $pnh = Location::create(['parent_id' => $ancash->id, 'name' => 'Parque Nacional Huascarán', 'type' => 'place']);
        Location::create(['parent_id' => $pnh->id, 'name' => 'Huascarán',     'type' => 'place']);
        Location::create(['parent_id' => $pnh->id, 'name' => 'Alpamayo',      'type' => 'place']);
        Location::create(['parent_id' => $pnh->id, 'name' => 'Artesonraju',   'type' => 'place']);
        Location::create(['parent_id' => $pnh->id, 'name' => 'Chopicalqui',   'type' => 'place']);
        Location::create(['parent_id' => $pnh->id, 'name' => 'Cayesh',        'type' => 'place']);
        Location::create(['parent_id' => $pnh->id, 'name' => 'Llanganuco',    'type' => 'place']);
        Location::create(['parent_id' => $pnh->id, 'name' => 'Querococha',    'type' => 'place']);
    }
}

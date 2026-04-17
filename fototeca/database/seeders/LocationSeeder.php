<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Región Ancash
        $ancash = Location::create(['name' => 'Ancash', 'type' => 'region']);

        // Provincia Huaraz
        $huaraz = Location::create(['parent_id' => $ancash->id, 'name' => 'Huaraz', 'type' => 'province']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Plaza', 'type' => 'district']);
        Location::create(['parent_id' => $huaraz->id, 'name' => 'Calles', 'type' => 'district']);

        // Provincia Yungay
        $yungay = Location::create(['parent_id' => $ancash->id, 'name' => 'Yungay', 'type' => 'province']);
        Location::create(['parent_id' => $yungay->id, 'name' => 'Catedral', 'type' => 'district']);

        // Provincia Recuay
        $recuay = Location::create(['parent_id' => $ancash->id, 'name' => 'Recuay', 'type' => 'province']);
        Location::create(['parent_id' => $recuay->id, 'name' => 'Puentes', 'type' => 'district']);

        // Provincia Carhuaz
        $carhuaz = Location::create(['parent_id' => $ancash->id, 'name' => 'Carhuaz', 'type' => 'province']);
        Location::create(['parent_id' => $carhuaz->id, 'name' => 'Parques', 'type' => 'district']);
    }
}

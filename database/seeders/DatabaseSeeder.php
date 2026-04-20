<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LocationSeeder::class,
            PhotographerSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            TagSeeder::class,
            PhotoSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@fototeca.com',
            'password' => 'password',
            'role'     => 'super_admin',
        ]);
    }
}

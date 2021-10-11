<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'rut' => '207303690',
            'status' => 1,
            'tipo_usuario' => 'Administrador',
            'email'=> 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
    }
}

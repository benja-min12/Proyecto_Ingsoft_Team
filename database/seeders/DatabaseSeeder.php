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
        \App\Models\User::create([
            'name' => 'Alvaro Castillo (Alumno)',
            'rut' => '123456789',
            'status' => 0,
            'tipo_usuario' => 'Alumno',
            'email'=> 'alumno@alumno.com',
            'password' => bcrypt('alumno')
        ]);
        \App\Models\User::create([
            'name' => 'Benjamin Millas (Alumno)',
            'rut' => '234567890',
            'status' => 1,
            'tipo_usuario' => 'Jefe Carrera',
            'email'=> 'JefeCarrera@gmail.com',
            'password' => bcrypt('Jefecarrera')
        ]);
    }
}

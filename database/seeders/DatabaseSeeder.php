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
            'name' => 'Alvaro Castillo (Jefe Carrera)',
            'rut' => '123456789',
            'status' => 1,
            'tipo_usuario' => 'Jefe Carrera',
            'email'=> 'jefecarrera2@jefecarrera.com',
            'password' => bcrypt('JefeCarrera1')
        ]);
        \App\Models\User::create([
            'name' => 'Roberto Diaz (Jefe Carrera)',
            'rut' => '223334446',
            'status' => 1,
            'tipo_usuario' => 'Alumno',
            'email'=> 'jefecarrera1@jefecarrera.com',
            'password' => bcrypt('JefeCarrera2')
        ]);
        \App\Models\User::create([
            'name' => 'Javier Ossa (Alumno)',
            'rut' => '234329874',
            'status' => 1,
            'tipo_usuario' => 'Alumno',
            'email'=> 'alumno1@alumno.com',
            'password' => bcrypt('alumno1')
        ]);
        \App\Models\User::create([
            'name' => 'Ricardo Jimenez (Alumno)',
            'rut' => '203459871',
            'status' => 1,
            'tipo_usuario' => 'Alumno',
            'email'=> 'alumno2@alumno.com',
            'password' => bcrypt('alumno2')
        ]);
        \App\Models\User::create([
            'name' => 'Jhoan Mamani (Alumno)',
            'rut' => '201234561',
            'status' => 1,
            'tipo_usuario' => 'Alumno',
            'email'=> 'alumno3@alumno.com',
            'password' => bcrypt('alumno3')
        ]);
        \App\Models\User::create([
            'name' => 'Jorge Rivera (Alumno)',
            'rut' => '239871234',
            'status' => 0,
            'tipo_usuario' => 'Alumno',
            'email'=> 'alumno4@alumno.com',
            'password' => bcrypt('alumno4')
        ]);
        \App\Models\User::create([
            'name' => 'Daniel Sepulveda (Alumno)',
            'rut' => '226781234',
            'status' => 0,
            'tipo_usuario' => 'Alumno',
            'email'=> 'alumno5@alumno.com',
            'password' => bcrypt('alumno5')
        ]);
    }
}

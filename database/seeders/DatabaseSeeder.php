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
            'name' => 'Administrador',
            'rut' => '207303690',
            'status' => 1,
            'tipo_usuario' => 'Administrador',
            'email'=> 'admin@admin.com',
            'password' => bcrypt('207303')
        ]);

        \App\Models\Carrera::create([
            'codigo' => 1234,
            'nombre' => 'Carrera Prueba 1',
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Sobrecupo'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Cambio Paralelo'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Eliminación Asignatura'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Inscripción Asignatura'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Ayudantía'
        ]);
        \App\Models\Solicitud::create([
            'tipo' => 'Facilidades'
        ]);
    }
}

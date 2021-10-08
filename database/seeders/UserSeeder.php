<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Pablo Herrera (Admin)',
            'rut' => '204149763',
            'status' => 1,
            'tipo_usuario' => 1,
            'email'=> 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
    }
}

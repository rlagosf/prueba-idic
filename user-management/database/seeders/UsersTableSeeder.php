<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Nombre1',
                'apellido' => 'Apellido1',
                'rut' => '1111111-1',
                'email' => 'usuario1@example.com',
                'password' => bcrypt('password1'),
            ],
            [
                'name' => 'Nombre2',
                'apellido' => 'Apellido2',
                'rut' => '2222222-2',
                'email' => 'usuario2@example.com',
                'password' => bcrypt('password2'),
            ],
            // Agrega más usuarios según sea necesario
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}


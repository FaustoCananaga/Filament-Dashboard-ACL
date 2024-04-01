<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModelHasRole;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =User::create([
            'name' => 'Super Admim',
             'email' => 'superadmin@gmail.com',
             'activo' => true,
             'imagem' => 'user_default.jpg',
             'genero' => 'Masculino',
             'password' => bcrypt('superadmin'),
        ]);

        $user->assignRole('Super Admin');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [

            [
                'name' => 'ver_utilizadores',
                'guard_name' => 'web',
            ],

            [
                'name' => 'editar_utilizadores',
                'guard_name' => 'web',
            ],

            [
                'name' => 'apagar_utilizadores',
                'guard_name' => 'web',
            ],

            [
                'name' => 'criar_utilizadores',
                'guard_name' => 'web',
            ],

            [
                'name' => 'criar_perfis',
                'guard_name' => 'web',
            ],

            [
                'name' => 'editar_perfis',
                'guard_name' => 'web',
            ],

            [
                'name' => 'ver_perfis',
                'guard_name' => 'web',
            ],

            [
                'name' => 'apagar_perfis',
                'guard_name' => 'web',
            ],

            [
                'name' => 'criar_permissões',
                'guard_name' => 'web',
            ],

            [
                'name' => 'editar_permissões',
                'guard_name' => 'web',
            ],

            [
                'name' => 'ver_permissões',
                'guard_name' => 'web',
            ],

            [
                'name' => 'apagar_permissões',
                'guard_name' => 'web',
            ],
        ];

            foreach ($permissions as $permission) {
                Permission::create($permission);
            }
    
    }
}

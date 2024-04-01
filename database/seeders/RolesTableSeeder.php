<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $PermissionTudo = Permission::create(['name' => 'Tudo','guard_name' => 'web' ]);
     
         $SuperAdmin =  Role::create([
            'name' => 'Super Admin',
             'guard_name' => 'web',
            
        ]);

        $SuperAdmin->givePermissionTo($PermissionTudo);
    
    }
}


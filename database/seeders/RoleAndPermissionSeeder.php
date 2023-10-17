<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; 
use Spatie\Permission\Models\Role; 

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'see-users']); 
        Permission::create(['name' => 'create-users']); 
        Permission::create(['name' => 'edit-users']); 
        Permission::create(['name' => 'delete-users']); 

        Permission::create(['name' => 'create-forum-posts']); 
        Permission::create(['name' => 'edit-forum-posts']); 
        Permission::create(['name' => 'delete-forum-posts']); 

        $adminRole = Role::create(['name' => 'Admin']); 
        $editorRole = Role::create(['name' => 'Editor']);

        $adminRole->givePermissionTo([
            'see-users',
            'create-users',
            'edit-users', 
            'delete-users',
            'create-forum-posts', 
            'edit-forum-posts',
            'delete-forum-posts'
        ]);

        $editorRole->givePermissionTo([
            'edit-forum-posts', 
            'delete-forum-posts', 
            'edit-users'
        ]); 
    }
}

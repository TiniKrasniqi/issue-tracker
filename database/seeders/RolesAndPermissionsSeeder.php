<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'authentication-rights',
            'user.add',
            'user.edit',
            'user.view',
            'user.view-all',
            'user.delete',
            'user.change-role',
            'permission.view-all',
            'permission.add',
            'permission.edit',
            'role.view',
            'role.add',
            'role.edit',
            'role.delete',
            'role.view-all',
            'dashboard.view',
            'settings.manage',
            'profile.update',
            'cache.clear',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        ///


        ///

        $role = Role::create(['name' => 'User']);
        $role->givePermissionTo('dashboard.view');
        $role->givePermissionTo('profile.update');
        
        $user = User::create([
            'name' => 'User',
            'surname' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user12345'), 
            'email_verified_at' => now(), 
        ]);
        $user->assignRole($role);




        //

        //
        $roleAdmin = Role::create(['name' => 'Super Admin'])
            ->givePermissionTo(Permission::all());

        $superAdmin = User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin12345'), 
            'email_verified_at' => now(), 
        ]);
        $superAdmin->assignRole($roleAdmin);
    }
}


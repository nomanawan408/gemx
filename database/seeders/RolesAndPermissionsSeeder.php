<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'manage permissions',
            'view reports',
            'manage transport',
            'manage hospitality',
            'access admin panel',
            'view visitors',
            'view international visitors',
            'view exhibitors',
            'view buyers',
            'view transport',
            'view hospitality',
            'view flight details',
            'create flights details',
            'manage flights details',
            'edit flight details',
            'delete flight details',
            'view flight details',
            
            // Add more permissions as needed
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define Roles
        $roles = [
            'buyer' => ['manage flights details', 'create flights details'],
            'visitor' => ['view users', 'access admin panel'],
            'international_visitor' => ['view users', 'access admin panel'],
            'exhibitor' => ['view users', 'access admin panel'],
            'transport' => ['manage transport','view flight details'],
            'hospitality' => ['manage hospitality'],
            'superadmin' => ['create flights details', 'manage flights details', 'edit flight details', 'delete flight details', 'view flight details','view users', 'create users', 'edit users', 'delete users', 'manage roles', 'manage permissions', 'view reports', 'manage transport', 'manage hospitality', 'access admin panel'],
        ];

        // Create Roles and Assign Permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Assign Permissions to Role
            $role->syncPermissions($rolePermissions);
        }

        // Assign the Super Admin Role to a User (Optional)
        $superAdmin = \App\Models\User::first(); // Replace with the super admin user
        if ($superAdmin) {
            $superAdmin->assignRole('superadmin');
        }
    }
}


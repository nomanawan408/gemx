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

            //
            'view users',
            'create users',
            'manage users',
            'edit users',
            'delete users',

            //
            'manage roles',
            'manage permissions',
            'view reports',

            //
            'view visitors',
            'view exhibitors',
            'view international visitors',
            'view buyers',
            'view transport',
            'view hospitality',
           
            //
            'can approve',
            'can reject',
            'add inivitation letter',
            'view inivitation letter',
            'delete inivitation letter',
            'update inivitation letter',

            //
            'create visa',
            'update visa',
            'delete visa',
            'view visa',
            'appove visa',
            
            //
            'view flight details',
            'create flights details',
            'edit flight details',
            'delete flight details',
            'manage flights details', 
        
            // 
            'view accomodation details',
            'create accomodation details',
            'edit accomodation details',
            'delete accomodation details',
            'manage accomodation details',

            //
            'upload demand draft',
            
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define Roles
        $roles = [
            'buyer' => [
                'view exhibitors',
                'create visa',
                'update visa',
                'delete visa',
                'view visa',
                'view flight details',
                'view accomodation details',
                'view inivitation letter',
                'view reports',
            ],

            'visitor' => [
                'view exhibitors',
                'view reports',
            ],

            'international_visitor' => [
                'view exhibitors',
                'create visa',
                'delete visa',
                'view visa',
                'view flight details',
                'create flights details',
                'edit flight details',
                'delete flight details',
                'view reports',
                'view inivitation letter',
                'view accomodation details',
                'create accomodation details',
                'edit accomodation details',
                'delete accomodation details',
            ],

            'exhibitor' => [
                'upload demand draft',
                'view reports',
            ],

            'transport' => [
                'view flight details',
                'view international visitors',
                'view buyers',
                'view accomodation details',
            ],

            'hospitality' => [
                'view flight details',
                'create flights details',
                'edit flight details',
                'delete flight details',
                'manage flights details', 
                'view accomodation details',
                'create accomodation details',
                'edit accomodation details',
                'delete accomodation details',
                'manage accomodation details',
                'appove visa',
                'view international visitors',
                'view buyers',

            ],

           'superadmin' => [
                //
                'view users',
                'create users',
                'manage users',
                'edit users',
                'delete users',
                //
                'manage roles',
                'manage permissions',
                'view reports',
                //
                'view visitors',
                'view exhibitors',
                'view international visitors',
                'view buyers',
                'view transport',
                'view hospitality',
                //
                'can approve',
                'can reject',
                'add inivitation letter',
                'view inivitation letter',
                'delete inivitation letter',
                'update inivitation letter',
                //
                'view visa',
                'appove visa',
                //
                'view flight details',
                'create flights details',
                'edit flight details',
                'delete flight details',
                'manage flights details', 
                // 
                'view accomodation details',
                'create accomodation details',
                'edit accomodation details',
                'delete accomodation details',
                'manage accomodation details',
                //
                'upload demand draft',
            ],
           



           
           
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


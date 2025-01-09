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
            'view status',
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

            // 
            'view invitation letter',
            'view exhibitor invitation letter',
            'view entry pass',

            //
            'pkgjs sales',
            'pkgjs purchase',

            //
            'admin',
            
            //
            'view exhibitor attachments',
            'view buyer attachments',
            'view visitor attachments',
            'view international attachments',
            
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
                'view invitation letter',
                'view entry pass',
                'pkgjs purchase',
                'view buyer attachments',
            ],

            'visitor' => [
                'view exhibitors',
                'view reports',
                'view invitation letter',
                'view entry pass',
                'pkgjs purchase',
                'view visitor attachments',
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
                // 'view accomodation details',
                // 'create accomodation details',
                // 'edit accomodation details',
                // 'delete accomodation details',
                'view invitation letter',
                'view entry pass',
                'pkgjs purchase',
                'view international attachments',
            ],

            'exhibitor' => [
                'upload demand draft',
                'view reports',
                'view exhibitor invitation letter',
                'view entry pass',
                'pkgjs sales',
                'admin',
                'view exhibitor attachments',
            ],

            'transport' => [
                'view flight details',
                'view international visitors',
                'admin',
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
                'view visa',
                'view international visitors',
                'view buyers',
                'view status',
                'admin',

                'view exhibitor attachments',
                'view buyer attachments',
                'view visitor attachments',
                'view international attachments',
            ],

           'superadmin' => [
                //
                'admin',
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

                //
                'view exhibitor attachments',
                'view buyer attachments',
                'view visitor attachments',
                'view international attachments',
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


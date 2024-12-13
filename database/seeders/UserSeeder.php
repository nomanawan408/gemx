<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the 'superadmin' role exists
        $role = Role::firstOrCreate(['name' => 'superadmin']);
        $hospitalityRole = Role::firstOrCreate(['name' => 'hospitality_dep']);
        $transportRole = Role::firstOrCreate(['name' => 'transport_dep']);

        // Create the Super Admin user
        $user = User::firstOrCreate(
            ['email' => 'superadmin@app.com'], // Update this email as needed
            [
                'name' => 'Super Admin', // Add this line
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'username' => 'superadmin',
                'password' => bcrypt('password'), // Set a secure password
            ]
        );

        // Create Hospitality user
        $hospitalityUser = User::firstOrCreate(
            ['email' => 'hospitality@app.com'],
            [
                'name' => 'Hospitality User',
                'first_name' => 'Hospitality',
                'last_name' => 'User',
                'username' => 'hospitality',
                'password' => bcrypt('password'),
            ]
        );

        // Create Transport user
        $transportUser = User::firstOrCreate(
            ['email' => 'transport@app.com'],
            [
                'name' => 'Transport User',
                'first_name' => 'Transport',
                'last_name' => 'User',
                'username' => 'transport',
                'password' => bcrypt('password'),
            ]
        );

        

        // Assign the 'superadmin' role to the user
        if (!$user->hasRole('superadmin')) {
            $user->assignRole($role);
        }

        // Assign hospitality role
        if (!$hospitalityUser->hasRole('hospitality')) {
            $hospitalityUser->assignRole($hospitalityRole);
        }

        // Assign transport role
        if (!$transportUser->hasRole('transport')) {
            $transportUser->assignRole($transportRole);
        }

        // Output to confirm success
        echo "Super Admin created successfully with email: {$user->email}\n";
        echo "Hospitality User created successfully with email: {$hospitalityUser->email}\n";
        echo "Transport User created successfully with email: {$transportUser->email}\n";
    }}

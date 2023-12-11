<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'fullname' => 'Test User',
        //     'organization' => 'Test Organization', 
        //     'email' => 'test@example.com',
        //     'password' => 'Test Password'


        // ]);

        // Seed roles
        $adminRole = Roles::create(['name' => 'admin']);
        $userRole = Roles::create(['name' => 'user']);

        // Seed admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->roles()->attach($adminRole);

        // Seed regular user
        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        $regularUser->roles()->attach($userRole);

    }
}
<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role_name' => 'Admin',
            'description' => 'Administrator with full access to the system',
            'is_active' => true,
        ]);

        Role::create([
            'role_name' => 'Employee',
            'description' => 'Regular employee with limited access',
            'is_active' => true,
        ]);

        Role::create([
            'role_name' => 'Manager',
            'description' => 'Manager with access to team management features',
            'is_active' => true,
        ]);
    }
}

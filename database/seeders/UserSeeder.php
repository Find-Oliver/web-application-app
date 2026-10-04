<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('role_name', 'Admin')->first();
        $employeeRole = Role::where('role_name', 'Employee')->first();

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('ChangeThisPassword123!'),
            'role_id' => $adminRole->id,
            'phone' => '09123456789',
            'address' => '123 Admin Street, City',
            'date_of_birth' => '1990-01-15',
            'gender' => 'Male',
        ]);

        // Create employee user
        User::create([
            'name' => 'John Doe',
            'email' => 'employee@example.com',
            'password' => Hash::make('ChangeThisPassword123!'),
            'role_id' => $employeeRole->id,
            'phone' => '09987654321',
            'address' => '456 Employee Avenue, City',
            'date_of_birth' => '1992-05-20',
            'gender' => 'Male',
        ]);

        // Create another employee user
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('ChangeThisPassword123!'),
            'role_id' => $employeeRole->id,
            'phone' => '09111111111',
            'address' => '789 Employee Road, City',
            'date_of_birth' => '1995-03-10',
            'gender' => 'Female',
        ]);
    }
}

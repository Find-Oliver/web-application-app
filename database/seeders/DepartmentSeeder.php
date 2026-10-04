<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'department_name' => 'Human Resources',
            'description' => 'Manages employee recruitment, training, and development',
            'is_active' => true,
        ]);

        Department::create([
            'department_name' => 'Information Technology',
            'description' => 'Handles all IT infrastructure and support',
            'is_active' => true,
        ]);

        Department::create([
            'department_name' => 'Sales',
            'description' => 'Responsible for sales and customer acquisition',
            'is_active' => true,
        ]);

        Department::create([
            'department_name' => 'Marketing',
            'description' => 'Manages marketing campaigns and brand awareness',
            'is_active' => true,
        ]);

        Department::create([
            'department_name' => 'Finance',
            'description' => 'Handles financial operations and accounting',
            'is_active' => true,
        ]);

        Department::create([
            'department_name' => 'Operations',
            'description' => 'Manages daily operational activities',
            'is_active' => true,
        ]);
    }
}

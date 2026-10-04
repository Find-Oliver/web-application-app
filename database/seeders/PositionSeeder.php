<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create([
            'position_name' => 'Manager',
            'description' => 'Team manager overseeing project execution',
            'is_active' => true,
        ]);

        Position::create([
            'position_name' => 'Senior Developer',
            'description' => 'Senior software developer with leadership responsibilities',
            'is_active' => true,
        ]);

        Position::create([
            'position_name' => 'Junior Developer',
            'description' => 'Entry-level software developer',
            'is_active' => true,
        ]);

        Position::create([
            'position_name' => 'Sales Executive',
            'description' => 'Manages sales accounts and client relationships',
            'is_active' => true,
        ]);

        Position::create([
            'position_name' => 'Marketing Specialist',
            'description' => 'Develops and executes marketing strategies',
            'is_active' => true,
        ]);

        Position::create([
            'position_name' => 'Accountant',
            'description' => 'Handles accounting and financial records',
            'is_active' => true,
        ]);

        Position::create([
            'position_name' => 'HR Officer',
            'description' => 'Manages HR operations and employee relations',
            'is_active' => true,
        ]);

        Position::create([
            'position_name' => 'System Administrator',
            'description' => 'Maintains IT systems and infrastructure',
            'is_active' => true,
        ]);
    }
}

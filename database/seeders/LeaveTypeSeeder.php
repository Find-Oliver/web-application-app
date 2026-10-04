<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::create([
            'leave_type_name' => 'Vacation Leave',
            'description' => 'Annual vacation leave for employees',
            'default_days' => 15,
            'is_active' => true,
        ]);

        LeaveType::create([
            'leave_type_name' => 'Sick Leave',
            'description' => 'Leave due to illness or medical appointment',
            'default_days' => 10,
            'is_active' => true,
        ]);

        LeaveType::create([
            'leave_type_name' => 'Personal Leave',
            'description' => 'Leave for personal matters',
            'default_days' => 5,
            'is_active' => true,
        ]);

        LeaveType::create([
            'leave_type_name' => 'Maternity Leave',
            'description' => 'Leave for pregnant employees and after delivery',
            'default_days' => 60,
            'is_active' => true,
        ]);

        LeaveType::create([
            'leave_type_name' => 'Paternity Leave',
            'description' => 'Leave for new fathers',
            'default_days' => 7,
            'is_active' => true,
        ]);

        LeaveType::create([
            'leave_type_name' => 'Bereavement Leave',
            'description' => 'Leave due to death in the family',
            'default_days' => 3,
            'is_active' => true,
        ]);
    }
}

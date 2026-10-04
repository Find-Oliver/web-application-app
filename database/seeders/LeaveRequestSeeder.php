<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::limit(3)->get();
        $leaveTypes = LeaveType::all();
        $admin = User::where('email', 'admin@example.com')->first();

        foreach ($employees as $employee) {
            // Create a pending leave request
            LeaveRequest::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveTypes->first()->id,
                'start_date' => now()->addDays(7)->toDateString(),
                'end_date' => now()->addDays(10)->toDateString(),
                'reason' => 'Family vacation',
                'status' => 'Pending',
                'approved_by' => null,
                'remarks' => null,
            ]);

            // Create an approved leave request
            LeaveRequest::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveTypes[1]->id,
                'start_date' => now()->subDays(20)->toDateString(),
                'end_date' => now()->subDays(18)->toDateString(),
                'reason' => 'Medical appointment and rest',
                'status' => 'Approved',
                'approved_by' => $admin->id,
                'remarks' => 'Approved by admin',
            ]);

            // Create a rejected leave request
            LeaveRequest::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveTypes[2]->id,
                'start_date' => now()->subDays(30)->toDateString(),
                'end_date' => now()->subDays(29)->toDateString(),
                'reason' => 'Personal errand',
                'status' => 'Rejected',
                'approved_by' => $admin->id,
                'remarks' => 'Conflicting with project deadline',
            ]);
        }
    }
}

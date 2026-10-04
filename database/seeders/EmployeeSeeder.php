<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hrDept = Department::where('department_name', 'Human Resources')->first();
        $itDept = Department::where('department_name', 'Information Technology')->first();
        $salesDept = Department::where('department_name', 'Sales')->first();
        $marketingDept = Department::where('department_name', 'Marketing')->first();

        $managerPos = Position::where('position_name', 'Manager')->first();
        $devPos = Position::where('position_name', 'Senior Developer')->first();
        $juniorDevPos = Position::where('position_name', 'Junior Developer')->first();
        $salesExecPos = Position::where('position_name', 'Sales Executive')->first();
        $hrOfficerPos = Position::where('position_name', 'HR Officer')->first();

        Employee::create([
            'employee_code' => 'EMP001',
            'first_name' => 'John',
            'middle_name' => 'Michael',
            'last_name' => 'Doe',
            'suffix' => null,
            'email' => 'john.doe@company.com',
            'phone' => '09123456789',
            'address' => '123 Developer Lane, Tech City',
            'date_of_birth' => '1990-01-15',
            'gender' => 'Male',
            'position_id' => $managerPos->id,
            'department_id' => $itDept->id,
            'employment_status' => 'Active',
            'date_hired' => '2020-03-01',
            'emergency_contact' => 'Maria Doe',
            'emergency_contact_phone' => '09198765432',
        ]);

        Employee::create([
            'employee_code' => 'EMP002',
            'first_name' => 'Jane',
            'middle_name' => 'Elizabeth',
            'last_name' => 'Smith',
            'suffix' => null,
            'email' => 'jane.smith@company.com',
            'phone' => '09111111111',
            'address' => '456 Coding Avenue, Tech City',
            'date_of_birth' => '1992-05-20',
            'gender' => 'Female',
            'position_id' => $devPos->id,
            'department_id' => $itDept->id,
            'employment_status' => 'Active',
            'date_hired' => '2021-06-15',
            'emergency_contact' => 'Robert Smith',
            'emergency_contact_phone' => '09122222222',
        ]);

        Employee::create([
            'employee_code' => 'EMP003',
            'first_name' => 'Robert',
            'middle_name' => 'James',
            'last_name' => 'Johnson',
            'suffix' => 'Jr.',
            'email' => 'robert.johnson@company.com',
            'phone' => '09133333333',
            'address' => '789 Programming Street, Tech City',
            'date_of_birth' => '1995-03-10',
            'gender' => 'Male',
            'position_id' => $juniorDevPos->id,
            'department_id' => $itDept->id,
            'employment_status' => 'Active',
            'date_hired' => '2022-01-10',
            'emergency_contact' => 'Sarah Johnson',
            'emergency_contact_phone' => '09144444444',
        ]);

        Employee::create([
            'employee_code' => 'EMP004',
            'first_name' => 'Emily',
            'middle_name' => 'Grace',
            'last_name' => 'Brown',
            'suffix' => null,
            'email' => 'emily.brown@company.com',
            'phone' => '09155555555',
            'address' => '321 HR Plaza, Business City',
            'date_of_birth' => '1991-07-25',
            'gender' => 'Female',
            'position_id' => $hrOfficerPos->id,
            'department_id' => $hrDept->id,
            'employment_status' => 'Active',
            'date_hired' => '2019-08-20',
            'emergency_contact' => 'James Brown',
            'emergency_contact_phone' => '09166666666',
        ]);

        Employee::create([
            'employee_code' => 'EMP005',
            'first_name' => 'Michael',
            'middle_name' => 'David',
            'last_name' => 'Wilson',
            'suffix' => null,
            'email' => 'michael.wilson@company.com',
            'phone' => '09177777777',
            'address' => '654 Sales Boulevard, Business City',
            'date_of_birth' => '1988-11-30',
            'gender' => 'Male',
            'position_id' => $salesExecPos->id,
            'department_id' => $salesDept->id,
            'employment_status' => 'Active',
            'date_hired' => '2021-02-14',
            'emergency_contact' => 'Lisa Wilson',
            'emergency_contact_phone' => '09188888888',
        ]);

        Employee::create([
            'employee_code' => 'EMP006',
            'first_name' => 'Sarah',
            'middle_name' => 'Anne',
            'last_name' => 'Taylor',
            'suffix' => null,
            'email' => 'sarah.taylor@company.com',
            'phone' => '09199999999',
            'address' => '987 Marketing Road, Business City',
            'date_of_birth' => '1993-09-18',
            'gender' => 'Female',
            'position_id' => Position::where('position_name', 'Marketing Specialist')->first()->id,
            'department_id' => $marketingDept->id,
            'employment_status' => 'Active',
            'date_hired' => '2022-05-01',
            'emergency_contact' => 'Tom Taylor',
            'emergency_contact_phone' => '09200000000',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        // Create attendance records for the past 10 days
        foreach ($employees as $employee) {
            for ($i = 10; $i >= 0; $i--) {
                $date = now()->subDays($i)->toDateString();

                // Skip weekends
                if (now()->subDays($i)->isWeekend()) {
                    continue;
                }

                $status = ['Present', 'Late', 'Absent'][rand(0, 2)];
                $timeIn = null;
                $timeOut = null;

                if ($status === 'Present') {
                    $timeIn = now()->subDays($i)->setHour(8)->setMinute(rand(0, 30))->format('H:i:s');
                    $timeOut = now()->subDays($i)->setHour(17)->setMinute(rand(0, 30))->format('H:i:s');
                } elseif ($status === 'Late') {
                    $timeIn = now()->subDays($i)->setHour(9)->setMinute(rand(0, 30))->format('H:i:s');
                    $timeOut = now()->subDays($i)->setHour(18)->setMinute(rand(0, 30))->format('H:i:s');
                }

                Attendance::create([
                    'employee_id' => $employee->id,
                    'attendance_date' => $date,
                    'time_in' => $timeIn,
                    'time_out' => $timeOut,
                    'status' => $status,
                    'remarks' => $status === 'Absent' ? 'Absent without notice' : null,
                ]);
            }
        }
    }
}

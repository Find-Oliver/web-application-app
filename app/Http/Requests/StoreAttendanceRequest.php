<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Attendance;

class StoreAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage-attendance') ?? false;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', Rule::exists('employees', 'id')->whereNull('deleted_at')],
            'attendance_date' => [
                'required',
                'date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) {
                    $alreadyRecorded = Attendance::where('employee_id', $this->input('employee_id'))
                        ->whereDate('attendance_date', $value)
                        ->exists();

                    if ($alreadyRecorded) {
                        $fail('An attendance record already exists for this employee on this date.');
                    }
                },
            ],
            'time_in' => ['nullable', 'date_format:H:i'],
            'time_out' => ['nullable', 'date_format:H:i'],
            'status' => ['required', Rule::in(['Present', 'Absent', 'Late', 'On Leave', 'Half Day'])],
            'remarks' => ['nullable', 'string', 'max:2000'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage-employees') ?? false;
    }

    public function rules(): array
    {
        $employee = $this->route('employee');

        return [
            'employee_code' => ['required', 'string', 'max:50', Rule::unique('employees', 'employee_code')->ignore($employee)],
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'suffix' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('employees', 'email')->ignore($employee)],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'employment_status' => ['required', 'in:Active,Inactive,On Leave,Terminated'],
            'date_hired' => ['required', 'date'],
            'emergency_contact' => ['nullable', 'string', 'max:100'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
        ];
    }
}

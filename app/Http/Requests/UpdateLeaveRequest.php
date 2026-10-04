<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLeaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['sometimes', 'integer', Rule::exists('employees', 'id')],
            'leave_type_id' => ['sometimes', 'integer', Rule::exists('leave_types', 'id')],
            'start_date' => ['sometimes', 'date', 'before_or_equal:end_date'],
            'end_date' => ['sometimes', 'date', 'after_or_equal:start_date'],
            'reason' => ['sometimes', 'string', 'max:2000'],
            'remarks' => ['nullable', 'string', 'max:2000'],
            'status' => ['sometimes', Rule::in(['Pending', 'Approved', 'Rejected', 'Cancelled'])],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage-leave-types') ?? false;
    }

    public function rules(): array
    {
        return [
            'leave_type_name' => ['required', 'string', 'max:100', 'unique:leave_types,leave_type_name,' . $this->route('leave_type')?->id],
            'description' => ['nullable', 'string', 'max:2000'],
            'default_days' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}

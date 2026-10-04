<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'employee_code',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'position_id',
        'department_id',
        'employment_status',
        'date_hired',
        'profile_picture',
        'emergency_contact',
        'emergency_contact_phone',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_hired' => 'date',
    ];

    public $timestamps = true;

    /**
     * Get the department the employee belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the position the employee holds.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get all attendance records for this employee.
     */
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get all leave requests for this employee.
     */
    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    /**
     * Get the full name of the employee.
     */
    public function getFullNameAttribute(): string
    {
        return implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
        ]));
    }

    /**
     * Get the full name with suffix.
     */
    public function getFullNameWithSuffixAttribute(): string
    {
        $fullName = $this->full_name;
        if ($this->suffix) {
            $fullName .= " {$this->suffix}";
        }
        return $fullName;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Attendance;

class AttendancePolicy
{
    /**
     * Check if user can view attendance.
     */
    public function view(User $user, Attendance $attendance): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can create attendance.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can update attendance.
     */
    public function update(User $user, Attendance $attendance): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can delete attendance.
     */
    public function delete(User $user, Attendance $attendance): bool
    {
        return $user->isAdmin();
    }
}

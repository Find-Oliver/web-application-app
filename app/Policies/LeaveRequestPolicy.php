<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;
use App\Models\LeaveRequest;

class LeaveRequestPolicy
{
    /**
     * Check if user can view leave requests.
     */
    public function view(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can view all
        if ($user->isAdmin()) {
            return true;
        }

        return $this->ownsLeaveRequest($user, $leaveRequest);
    }

    /**
     * Check if user can create leave requests.
     */
    public function create(User $user): bool
    {
        return $user->isEmployee() || $user->isAdmin();
    }

    /**
     * Check if user can update leave request.
     */
    public function update(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can update all
        if ($user->isAdmin()) {
            return true;
        }

        if (! $this->ownsLeaveRequest($user, $leaveRequest)) {
            return false;
        }

        return $leaveRequest->status === 'Pending';
    }

    /**
     * Check if user can delete leave request.
     */
    public function delete(User $user, LeaveRequest $leaveRequest): bool
    {
        // Admin can delete all
        if ($user->isAdmin()) {
            return true;
        }

        if (! $this->ownsLeaveRequest($user, $leaveRequest)) {
            return false;
        }

        return $leaveRequest->status === 'Pending';
    }

    /**
     * Check if user can approve leave request.
     */
    public function approve(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->isAdmin();
    }

    /**
     * Check if user can reject leave request.
     */
    public function reject(User $user, LeaveRequest $leaveRequest): bool
    {
        return $user->isAdmin();
    }

    private function ownsLeaveRequest(User $user, LeaveRequest $leaveRequest): bool
    {
        return Employee::where('email', $user->email)
            ->whereKey($leaveRequest->employee_id)
            ->exists();
    }
}

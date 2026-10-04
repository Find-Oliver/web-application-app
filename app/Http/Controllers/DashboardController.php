<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->employeeDashboard();
    }

    /**
     * Admin dashboard with statistics.
     */
    private function adminDashboard()
    {
        $stats = [
            'total_employees' => Employee::count(),
            'active_employees' => Employee::where('employment_status', 'Active')->count(),
            'inactive_employees' => Employee::where('employment_status', 'Inactive')->count(),
            'departments' => Department::count(),
            'present_today' => Attendance::where('attendance_date', today())
                ->where('status', 'Present')
                ->count(),
            'late_today' => Attendance::where('attendance_date', today())
                ->where('status', 'Late')
                ->count(),
            'pending_leaves' => LeaveRequest::where('status', 'Pending')->count(),
        ];

        return view('dashboard.admin', compact('stats'));
    }

    /**
     * Employee dashboard with personalized summary.
     */
    private function employeeDashboard()
    {
        $user = Auth::user();
        $employee = Employee::where('email', $user->email)->first();
        $employeeId = $employee?->id;

        $pendingRequests = $employeeId
            ? LeaveRequest::where('employee_id', $employeeId)->where('status', 'Pending')->count()
            : 0;

        $approvedRequests = $employeeId
            ? LeaveRequest::where('employee_id', $employeeId)->where('status', 'Approved')->count()
            : 0;

        $todayStatus = $employeeId
            ? Attendance::where('employee_id', $employeeId)->whereDate('attendance_date', today())->value('status')
            : null;

        $totalEntitledDays = (int) LeaveType::where('is_active', true)->sum('default_days');
        $usedLeaveDays = $employeeId
            ? LeaveRequest::where('employee_id', $employeeId)
                ->where('status', 'Approved')
                ->get()
                ->sum(fn (LeaveRequest $leaveRequest) => $leaveRequest->days_requested)
            : 0;

        $stats = [
            'today_status' => $todayStatus ?? 'Not logged',
            'pending_requests' => $pendingRequests,
            'approved_requests' => $approvedRequests,
            'leave_balance' => max(0, $totalEntitledDays - $usedLeaveDays),
            'employee_name' => $employee?->full_name_with_suffix ?? $user->name,
        ];

        return view('dashboard.employee', compact('stats', 'employee'));
    }
}

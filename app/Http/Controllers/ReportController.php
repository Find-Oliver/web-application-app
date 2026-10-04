<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $this->authorize('view-reports');

        $todayAttendance = Schema::hasTable('attendance')
            ? Attendance::query()
                ->whereDate('attendance_date', today())
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->all()
            : [];

        $leaveSummary = Schema::hasTable('leave_requests')
            ? LeaveRequest::query()
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->all()
            : [];

        $report = [
            'total_employees' => Employee::count(),
            'active_employees' => Employee::where('employment_status', 'Active')->count(),
            'present_today' => $todayAttendance['Present'] ?? 0,
            'late_today' => $todayAttendance['Late'] ?? 0,
            'pending_leaves' => $leaveSummary['Pending'] ?? 0,
            'approved_leaves' => $leaveSummary['Approved'] ?? 0,
            'rejected_leaves' => $leaveSummary['Rejected'] ?? 0,
        ];

        return view('reports.index', compact('report'));
    }
}

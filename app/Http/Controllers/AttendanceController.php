<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $this->authorize('manage-attendance');

        $attendanceRecords = Attendance::with('employee')
            ->orderByDesc('attendance_date')
            ->orderByDesc('id')
            ->paginate(20);

        return view('attendance.index', compact('attendanceRecords'));
    }

    public function create(): View
    {
        $this->authorize('manage-attendance');

        return view('attendance.create', [
            'employees' => Employee::where('employment_status', 'Active')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get(),
        ]);
    }

    public function store(StoreAttendanceRequest $request): RedirectResponse
    {
        Attendance::create($request->validated());

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance record created successfully.');
    }

    public function edit(Attendance $attendance): View
    {
        $this->authorize('manage-attendance');

        return view('attendance.edit', [
            'attendance' => $attendance,
            'employees' => Employee::orderBy('last_name')
                ->orderBy('first_name')
                ->get(),
        ]);
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance): RedirectResponse
    {
        $attendance->update($request->validated());

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance record updated successfully.');
    }

    public function destroy(Attendance $attendance): RedirectResponse
    {
        $this->authorize('manage-attendance');
        $attendance->delete();

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Attendance record deleted successfully.');
    }
}

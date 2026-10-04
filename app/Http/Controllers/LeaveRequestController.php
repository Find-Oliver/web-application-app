<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaveRequestController extends Controller
{
    protected function currentEmployeeId(): ?int
    {
        if (auth()->user()?->isAdmin()) {
            return null;
        }

        return Employee::where('email', auth()->user()->email)->value('id');
    }

    public function index(): View
    {
        $query = LeaveRequest::with(['employee', 'leaveType', 'approver'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('employee_id', $this->currentEmployeeId() ?? -1);
        }

        $leaveRequests = $query->paginate(20);

        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function create(): View
    {
        $this->authorize('submit-leave');

        $employees = auth()->user()->isAdmin()
            ? Employee::orderBy('last_name')->orderBy('first_name')->get()
            : Employee::where('email', auth()->user()->email)->get();

        return view('leave_requests.create', [
            'leaveTypes' => LeaveType::where('is_active', true)->orderBy('leave_type_name')->get(),
            'employees' => $employees,
        ]);
    }

    public function store(StoreLeaveRequest $request): RedirectResponse
    {
        $this->authorize('submit-leave');

        $employeeId = $this->currentEmployeeId();
        if (! auth()->user()->isAdmin() && $employeeId !== null) {
            $request->merge(['employee_id' => $employeeId]);
        }

        $leaveRequest = LeaveRequest::create($request->validated());

        return redirect()
            ->route('leave_requests.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    public function show(LeaveRequest $leaveRequest): View
    {
        $this->authorize('view', $leaveRequest);

        $leaveRequest->load(['employee', 'leaveType', 'approver']);

        return view('leave_requests.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest): View
    {
        $this->authorize('update', $leaveRequest);

        return view('leave_requests.edit', [
            'leaveRequest' => $leaveRequest,
            'leaveTypes' => LeaveType::where('is_active', true)->orderBy('leave_type_name')->get(),
            'employees' => Employee::orderBy('last_name')->orderBy('first_name')->get(),
        ]);
    }

    public function update(UpdateLeaveRequest $request, LeaveRequest $leaveRequest): RedirectResponse
    {
        $this->authorize('update', $leaveRequest);

        $leaveRequest->update($request->validated());

        return redirect()
            ->route('leave_requests.index')
            ->with('success', 'Leave request updated successfully.');
    }

    public function destroy(LeaveRequest $leaveRequest): RedirectResponse
    {
        $this->authorize('delete', $leaveRequest);

        $leaveRequest->delete();

        return redirect()
            ->route('leave_requests.index')
            ->with('success', 'Leave request removed successfully.');
    }

    public function approve(Request $request, LeaveRequest $leaveRequest): RedirectResponse
    {
        $this->authorize('approve', $leaveRequest);

        $leaveRequest->update([
            'status' => 'Approved',
            'approved_by' => auth()->id(),
            'remarks' => $request->input('remarks', $leaveRequest->remarks),
        ]);

        return redirect()
            ->route('leave_requests.index')
            ->with('success', 'Leave request approved successfully.');
    }

    public function reject(Request $request, LeaveRequest $leaveRequest): RedirectResponse
    {
        $this->authorize('reject', $leaveRequest);

        $leaveRequest->update([
            'status' => 'Rejected',
            'approved_by' => auth()->id(),
            'remarks' => $request->input('remarks', $leaveRequest->remarks),
        ]);

        return redirect()
            ->route('leave_requests.index')
            ->with('success', 'Leave request rejected successfully.');
    }
}

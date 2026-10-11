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
    private function currentEmployee(): ?Employee
    {
        $user = auth()->user();

        if ($user?->isAdmin()) {
            return null;
        }

        return $user
            ? Employee::where('email', $user->email)->first()
            : null;
    }

    public function index(): View
    {
        $query = LeaveRequest::with(['employee', 'leaveType', 'approver'])->latest();

        if (! auth()->user()->isAdmin()) {
            $query->where('employee_id', $this->currentEmployee()?->id ?? 0);
        }

        $leaveRequests = $query->paginate(20);

        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function create(): View
    {
        $this->authorize('submit-leave');

        $employees = auth()->user()->isAdmin()
            ? Employee::orderBy('last_name')->orderBy('first_name')->get()
            : Employee::whereKey($this->currentEmployee()?->id)->get();

        return view('leave_requests.create', [
            'leaveTypes' => LeaveType::where('is_active', true)->orderBy('leave_type_name')->get(),
            'employees' => $employees,
        ]);
    }

    public function store(StoreLeaveRequest $request): RedirectResponse
    {
        $this->authorize('submit-leave');

        $user = $request->user();
        $employee = $user->isAdmin() ? null : $this->currentEmployee();

        abort_if(
            ! $user->isAdmin() && ! $employee,
            403,
            'No employee record is linked to your account.'
        );

        $data = $request->validated();
        $data['employee_id'] = $user->isAdmin()
            ? $data['employee_id']
            : $employee->id;
        $data['status'] = 'Pending';

        LeaveRequest::create($data);

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

        $employees = auth()->user()->isAdmin()
            ? Employee::orderBy('last_name')->orderBy('first_name')->get()
            : Employee::whereKey($this->currentEmployee()?->id)->get();

        return view('leave_requests.edit', [
            'leaveRequest' => $leaveRequest,
            'leaveTypes' => LeaveType::where('is_active', true)->orderBy('leave_type_name')->get(),
            'employees' => $employees,
        ]);
    }

    public function update(UpdateLeaveRequest $request, LeaveRequest $leaveRequest): RedirectResponse
    {
        $this->authorize('update', $leaveRequest);

        $data = $request->validated();
        if (! $request->user()->isAdmin()) {
            $data['employee_id'] = $leaveRequest->employee_id;
            $data['status'] = $leaveRequest->status;
        }

        $leaveRequest->update($data);

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

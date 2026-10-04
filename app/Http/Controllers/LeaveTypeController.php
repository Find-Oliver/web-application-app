<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveTypeRequest;
use App\Http\Requests\UpdateLeaveTypeRequest;
use App\Models\LeaveType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LeaveTypeController extends Controller
{
    public function index(): View
    {
        $this->authorize('manage-leave-types');

        $leaveTypes = LeaveType::orderBy('leave_type_name')->paginate(10);

        return view('leave_types.index', compact('leaveTypes'));
    }

    public function create(): View
    {
        $this->authorize('manage-leave-types');

        return view('leave_types.create');
    }

    public function store(StoreLeaveTypeRequest $request): RedirectResponse
    {
        $leaveType = LeaveType::create($request->validated());

        return redirect()
            ->route('leave_types.index')
            ->with('success', "Leave type '{$leaveType->leave_type_name}' created successfully.");
    }

    public function show(LeaveType $leaveType): View
    {
        $this->authorize('manage-leave-types');

        return view('leave_types.show', compact('leaveType'));
    }

    public function edit(LeaveType $leaveType): View
    {
        $this->authorize('manage-leave-types');

        return view('leave_types.edit', compact('leaveType'));
    }

    public function update(UpdateLeaveTypeRequest $request, LeaveType $leaveType): RedirectResponse
    {
        $leaveType->update($request->validated());

        return redirect()
            ->route('leave_types.index')
            ->with('success', "Leave type '{$leaveType->leave_type_name}' updated successfully.");
    }

    public function destroy(LeaveType $leaveType): RedirectResponse
    {
        $this->authorize('manage-leave-types');

        if ($leaveType->leaveRequests()->exists()) {
            return redirect()
                ->route('leave_types.index')
                ->with('error', "Cannot delete '{$leaveType->leave_type_name}' because it is already in use.");
        }

        $leaveType->delete();

        return redirect()
            ->route('leave_types.index')
            ->with('success', "Leave type '{$leaveType->leave_type_name}' deleted successfully.");
    }
}

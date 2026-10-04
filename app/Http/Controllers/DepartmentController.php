<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-departments');

        $query = Department::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('department_name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $departments = $query
            ->withCount('employees')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $this->authorize('manage-departments');

        return view('departments.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage-departments');

        $validated = $request->validate([
            'department_name' => ['required', 'string', 'max:100', Rule::unique('departments', 'department_name')],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $department = Department::create($validated);

        return redirect()->route('departments.index')
            ->with('success', "Department '{$department->department_name}' created successfully.");
    }

    public function show(Department $department)
    {
        $this->authorize('manage-departments');

        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $this->authorize('manage-departments');

        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $this->authorize('manage-departments');

        $validated = $request->validate([
            'department_name' => ['required', 'string', 'max:100', Rule::unique('departments', 'department_name')->ignore($department->id)],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')
            ->with('success', "Department '{$department->department_name}' updated successfully.");
    }

    public function destroy(Department $department)
    {
        $this->authorize('manage-departments');

        if ($department->employees()->exists()) {
            return redirect()->route('departments.index')
                ->with('error', "Cannot delete department '{$department->department_name}' because employees are assigned to it.");
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', "Department '{$department->department_name}' deleted successfully.");
    }
}

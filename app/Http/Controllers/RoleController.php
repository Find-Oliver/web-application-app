<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     */
    public function index(Request $request)
    {
        $this->authorize('manage-roles');

        $query = Role::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('role_name', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $roles = $query
            ->withCount('users')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $this->authorize('manage-roles');

        return view('roles.create');
    }

    /**
     * Store a newly created role.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());

        return redirect()
            ->route('roles.index')
            ->with('success', "Role '{$role->role_name}' created successfully.");
    }

    /**
     * Display the specified role.
     */
    public function show(Role $role)
    {
        $this->authorize('manage-roles');

        $users = $role->users()->paginate(10);

        return view('roles.show', compact('role', 'users'));
    }

    /**
     * Show the form for editing a role.
     */
    public function edit(Role $role)
    {
        $this->authorize('manage-roles');

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified role.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()
            ->route('roles.index')
            ->with('success', "Role '{$role->role_name}' updated successfully.");
    }

    /**
     * Remove the specified role.
     */
    public function destroy(Role $role)
    {
        $this->authorize('manage-roles');

        // Prevent deletion of roles that have users assigned
        if ($role->users()->exists()) {
            return redirect()->route('roles.index')
                ->with('error', "Cannot delete role '{$role->role_name}' because it has assigned users.");
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', "Role '{$role->role_name}' deleted successfully.");
    }
}

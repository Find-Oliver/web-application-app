<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-positions');

        $query = Position::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('position_name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $positions = $query
            ->withCount('employees')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        $this->authorize('manage-positions');

        return view('positions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manage-positions');

        $validated = $request->validate([
            'position_name' => ['required', 'string', 'max:100', Rule::unique('positions', 'position_name')],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $position = Position::create($validated);

        return redirect()->route('positions.index')
            ->with('success', "Position '{$position->position_name}' created successfully.");
    }

    public function show(Position $position)
    {
        $this->authorize('manage-positions');

        return view('positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        $this->authorize('manage-positions');

        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $this->authorize('manage-positions');

        $validated = $request->validate([
            'position_name' => ['required', 'string', 'max:100', Rule::unique('positions', 'position_name')->ignore($position->id)],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $position->update($validated);

        return redirect()->route('positions.index')
            ->with('success', "Position '{$position->position_name}' updated successfully.");
    }

    public function destroy(Position $position)
    {
        $this->authorize('manage-positions');

        if ($position->employees()->exists()) {
            return redirect()->route('positions.index')
                ->with('error', "Cannot delete position '{$position->position_name}' because employees are assigned to it.");
        }

        $position->delete();

        return redirect()->route('positions.index')
            ->with('success', "Position '{$position->position_name}' deleted successfully.");
    }
}

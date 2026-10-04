<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $this->authorize('manage-announcements');

        $announcements = Announcement::with('creator:id,name')
            ->latest()
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        $this->authorize('manage-announcements');

        return view('announcements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('manage-announcements');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $announcement = Announcement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'created_by' => auth()->id(),
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('announcements.index')->with('success', "Announcement '{$announcement->title}' created successfully.");
    }

    public function edit(Announcement $announcement): View
    {
        $this->authorize('manage-announcements');

        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $this->authorize('manage-announcements');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $announcement->update($validated);

        return redirect()->route('announcements.index')->with('success', "Announcement '{$announcement->title}' updated successfully.");
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $this->authorize('manage-announcements');

        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}

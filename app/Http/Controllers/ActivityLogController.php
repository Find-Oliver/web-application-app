<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        $this->authorize('view-activity-logs');

        $activityLogs = ActivityLog::with('user:id,name,email')
            ->latest()
            ->paginate(15);

        return view('activity_logs.index', compact('activityLogs'));
    }
}

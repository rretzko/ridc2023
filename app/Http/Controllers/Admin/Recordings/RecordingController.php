<?php

namespace App\Http\Controllers\Admin\Recordings;

use App\Http\Controllers\Controller;
use App\Models\CurrentEvent;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    public function index()
    {
        $admin_active = 'recordings';
        $recordings = FileUpload::where('event_id', 31)->get() //CurrentEvent::currentEvent()->id
            ->sortBy(['school_id','ensemble_id','adjudicator_id','partial']);

        return view('admin.recordings.index', compact('admin_active','recordings'));
    }
}

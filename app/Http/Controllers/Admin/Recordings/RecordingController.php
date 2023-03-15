<?php

namespace App\Http\Controllers\Admin\Recordings;

use App\Http\Controllers\Controller;
use App\Models\CurrentEvent;
use App\Models\Event;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    public function index(Event $event = null)
    {
        $admin_active = 'recordings';
        $events = Event::orderByDesc('id')->get();
        $eventId = ($event) ? $event->id : CurrentEvent::currentEvent()->id;

        $recordings = FileUpload::where('event_id', $eventId)->get() //CurrentEvent::currentEvent()->id
            ->sortBy(['school_id','ensemble_id','adjudicator_id','partial']);

        return view('admin.recordings.index', compact('admin_active', 'eventId', 'events', 'recordings'));
    }

    public function show(Request $request)
    {
        $inputs = $request->validate(
            [
                'event_id' => ['required', 'exists:events,id'],
            ]
        );

        return $this->index(Event::find($inputs['event_id']));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderByDesc('event_date')->get();

        return view('admin.events.index', ['admin_active' => 'home'], compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate(
            [
                'descr' => ['string','required'],
                'close_date' => ['date','required'],
                'end_time' => ['date_format:H:i:s','required'],
                'ensemble_fee' => ['numeric','required'],
                'event_date' => ['date','required','unique:events'],
                'max_concert' => ['numeric','required','min:1'],
                'max_show' => ['numeric','required','min:1'],
                'max_soloists' => ['numeric','required','min:1'],
                'open_date' => ['date','required'],
                'start_time' => ['date_format:H:i:s','required'],
                'subtitle' => ['string','required'],
                'title' => ['string','required'],
            ],
        );

        $event = Event::create($inputs);

        $mssg = 'Event: <b>'.$event->subtitle.'</b> successfully added!';

        return redirect('admin/events')->with('success',$mssg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $events = Event::orderByDesc('event_date')->get();

        return view('admin.events.edit', ['admin_active' => 'home'], compact('event','events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $inputs = $request->validate(
            [
                'descr' => ['string','required'],
                'close_date' => ['date','required'],
                'end_time' => ['date_format:H:i','required'],
                'ensemble_fee' => ['numeric','required'],
                'event_date' => ['date','required',Rule::unique('events')->ignore($event)],
                'max_concert' => ['numeric','required','min:1'],
                'max_show' => ['numeric','required','min:1'],
                'max_soloists' => ['numeric','required','min:1'],
                'open_date' => ['date','required'],
                'start_time' => ['date_format:H:i:s','required'],
                'subtitle' => ['string','required'],
                'title' => ['string','required'],
            ],
        );

        $event->update($inputs);

        $mssg = 'Event: <b>'.$event->subtitle.'</b> successfully updated!';

        return redirect('admin/events')->with('success',$mssg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $subtitle = $event->subtitle;

        $event->delete();

        $mssg = 'Event: <b>'.$subtitle.'</b> successfully removed.';

        return redirect('admin/events')->with('success', $mssg);
    }
}

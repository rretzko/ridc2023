<?php

namespace App\Http\Controllers\User\Accepteds;

use App\Http\Controllers\Controller;
use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use App\Models\Student;
use Illuminate\Http\Request;

class EnsembleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $ensembles = EventEnsemble::where('event_id', $event->id)
            ->where('school_id', $school->id)
            ->get();

        $students = collect();

        return view('users.accepteds.ensembles.index',
            compact('ensembles', 'event', 'school', 'students', 'user')
        );
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
        //
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
     * @param Ensemble $ensemble
     * @param string $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Ensemble $ensemble, $action='descr')
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $ensembles = EventEnsemble::where('event_id', $event->id)
            ->where('school_id', $school->id)
            ->get();

        return view('users.accepteds.ensembles.edit',
            compact('action','ensemble', 'ensembles', 'event', 'school', 'user')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

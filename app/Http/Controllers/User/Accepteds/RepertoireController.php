<?php

namespace App\Http\Controllers\User\Accepteds;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Accepteds\RepertoireRequest;
use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use App\Models\Repertoire;
use Illuminate\Http\Request;

class RepertoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ensemble $ensemble)
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $ensembles = EventEnsemble::where('event_id', $event->id)
            ->where('school_id', $school->id)
            ->get();

        return view('users.accepteds.repertoire.index',
            compact('ensemble', 'ensembles', 'event', 'school', 'user')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ensemble $ensemble)
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $ensembles = EventEnsemble::where('event_id', $event->id)
            ->where('school_id', $school->id)
            ->get();

        return view('users.accepteds.repertoire.create',
            compact('ensemble', 'ensembles', 'event', 'school', 'user')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RepertoireRequest $request)
    {
        Repertoire::create(
            [
                'event_id' => CurrentEvent::currentEvent()->id,
                'ensemble_id' => $request['ensemble_id'],
                'title' => $request['title'],
                'subtitle' => $request['subtitle'],
                'composer' => $request['composer'],
                'arranger' => $request['arranger'],
                'lyricist' => $request['lyricist'],
                'choreographer' => $request['choreographer'],
                'notes' => $request['notes'],
                'duration' => $this->calcDuration($request),
                'order_by' => $request['order_by'],
            ]
        );

        session()->flash('success', $request['title'].' has been added.');

        return back();
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
     * @param Repertoire $repertoire
     * @return \Illuminate\Http\Response
     */
    public function edit(Repertoire $repertoire)
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $ensemble = Ensemble::find($repertoire->ensemble_id);
        $ensembles = EventEnsemble::where('event_id', $event->id)
            ->where('school_id', $school->id)
            ->get();

        return view('users.accepteds.repertoire.edit',
            compact('ensemble', 'ensembles', 'event', 'repertoire','school', 'user')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Repertoire $repertoire
     * @return \Illuminate\Http\Response
     */
    public function update(RepertoireRequest $request, Repertoire $repertoire)
    {
        $input = $request->all();
        $input['duration'] = $this->calcDuration($request);

        $repertoire->update($input);

        session()->flash('success', 'Successful update for: '.$repertoire->title);

        return $this->index(Ensemble::find($repertoire->ensemble_id));
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

    private function calcDuration($request): int
    {
        return (($request['minutes'] * 60) + $request['seconds']);
    }
}

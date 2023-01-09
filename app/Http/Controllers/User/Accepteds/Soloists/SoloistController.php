<?php

namespace App\Http\Controllers\User\Accepteds\Soloists;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Accepteds\SoloistRequest;
use App\Models\CurrentEvent;
use App\Models\Soloist;
use Illuminate\Http\Request;

class SoloistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Soloist  $soloist
     * @return \Illuminate\Http\Response
     */
    public function show(Soloist $soloist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $students = $school->students;

        $soloist = new Soloist;
        $soloists = $soloist->cohort($event->id, $school->id);

        return view('users.accepteds.soloists.edit',
            compact('event', 'school', 'soloists', 'students', 'user')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SoloistRequest $request)
    {
        $event_id = CurrentEvent::currentEvent()->id;
        $school_id = auth()->user()->school()->id;

        //clear current soloists
        $soloist = new Soloist;
        $soloist->reset($school_id, $event_id);

        //create new soloists
        foreach($request->all() AS $key => $student_id){

            $concert = (substr($key,0,7,) === 'concert');
            $jazzpop = (substr($key, 0, 7) === 'jazzpop');

            if($concert || $jazzpop){

                $soloist = Soloist::create(
                    [
                        'event_id' => $event_id,
                        'school_id' => $school_id,
                        'concert' => $concert ? 1 : 0,
                        'student_id' => $student_id,
                    ],
                    [],
                );

            }
        }

        session()->flash('success', 'The soloists have been updated.');

        return $this->edit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soloist  $soloist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soloist $soloist)
    {
        //
    }
}

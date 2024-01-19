<?php

namespace App\Http\Controllers\User\Accepteds\Soloists;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Accepteds\SoloistRequest;
use App\Models\CurrentEvent;
use App\Models\Soloist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SoloistController extends Controller
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
        $students = $school->students;

        $soloists = $school->getSoloists($event);

        $countSoloists = count($soloists);
        $countSoloistsConcert = $school->countSoloistsConcert($event);
        $countSoloistsJPS = $school->countSoloistsJPS($event);

        return view('users.accepteds.soloists.index',
            compact('event', 'school', 'soloists', 'students', 'user',
            'countSoloists', 'countSoloistsConcert', 'countSoloistsJPS')
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
    public function store(SoloistRequest $request)
    {
        $eventId = CurrentEvent::currentEvent()->id;
        $school = auth()->user()->school();
        $schoolId = $school->id;

        if($school->countSoloists < 4) {

            $stored = Soloist::create(
                [
                    'event_id' => $eventId,
                    'school_id' => $schoolId,
                    'student_id' => $request['studentId'],
                    'concert' => $request['soloistType'],
                    'title' => Str::title($request['title']),
                    'composer' => $request['composer'],
                ]
            );

            $success = $stored->id
                ? 'The soloists have been updated.'
                : 'Failed to update the soloists.';
        }else{

            $success = 'No more than four soloists per school are permitted to compete.';
        }

        session()->flash('success', $success);

        return $this->index();
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
    public function edit(Soloist $soloist)
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $students = $school->students;

        $soloists = $school->getSoloists($event);

        $countSoloists = count($soloists);
        $countSoloistsConcert = $school->countSoloistsConcert($event);
        $countSoloistsJPS = $school->countSoloistsJPS($event);

        return view('users.accepteds.soloists.edit',
            compact('event', 'school', 'soloists', 'students', 'user',
                'countSoloists', 'countSoloistsConcert', 'countSoloistsJPS',
                'soloist')
        );
    }

    /**
     * Update the specified resource in storage.
     * 2023 edition
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soloist $soloist)
    {
        $validated = $request->validate(
            [
                'composer' => ['required', 'string'],
                'title' => ['required', 'string'],
            ]
        );

        $soloist->update(
            [
                'title' => $request['title'],
                'composer' => $request['composer'],
            ]
        );

        session()->flash('success', 'The soloist have been updated.');

        return $this->index();
    }


//    public function update_old(SoloistRequest $request)
//    {
//        $event_id = CurrentEvent::currentEvent()->id;
//        $school_id = auth()->user()->school()->id;
//
//        //clear current soloists
//        $soloist = new Soloist;
//        $soloist->reset($school_id, $event_id);
//
//        //create new soloists
//        foreach($request->all() AS $key => $student_id){
//
//            $concert = (substr($key,0,7,) === 'concert');
//            $jazzpop = (substr($key, 0, 7) === 'jazzpop');
//
//            if($concert || $jazzpop){
//
//                $soloist = Soloist::create(
//                    [
//                        'event_id' => $event_id,
//                        'school_id' => $school_id,
//                        'concert' => $concert ? 1 : 0,
//                        'student_id' => $student_id,
//                    ],
//                    [],
//                );
//
//            }
//        }
//
//        session()->flash('success', 'The soloists have been updated.');
//
//        return $this->edit();
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soloist  $soloist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soloist $soloist)
    {
        $fullName = $soloist->fullName;

        $soloist->delete();

        $success = $fullName . ' has been removed as a soloist.';

        session()->flash('success', $success);

        return $this->index();
    }
}

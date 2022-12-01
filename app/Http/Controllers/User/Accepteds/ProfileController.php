<?php

namespace App\Http\Controllers\User\Accepteds;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Accepteds\ProfileRequest;
use App\Models\CurrentEvent;
use App\Models\Honorific;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //failsafe
        if(! $user->id){ $user = auth()->user();}

        $event = CurrentEvent::currentEvent();

        $honorifics = Honorific::all();

        return view('users.accepteds.profiles.show', compact('event','honorifics', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update(
            [
                'first' => $request['first'],
                'middle' => $request['middle'],
                'last' => $request['last'],
                'honorific_id' => $request['honorific_id'],
                'email' => $request['email'],
                'suffix' => $request['suffix'],
            ]
        );

        /* PHONE MOBILE */
        Phone::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'mobile' => 1,
            ],
            [
                'phone' => Phone::formatPhone($request['phone_mobile']),
            ]
        );

        /* PHONE WORK */
        //null values are not allowed in table
        //if user removes their work phone, delete the current record
        if(is_null($request['phone_work'])){
            $phone = Phone::where('user_id', auth()->id())
                ->where('mobile', 0)
                ->first();

            if($phone){ $phone->delete();}

        }else {

            Phone::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'mobile' => 0,
                ],
                [
                    'phone' => Phone::formatPhone($request['phone_work']),
                ]
            );
        }

        /* JOB TITLE */
        auth()->user()->person->update(
            [
                'job_title' => $request['job_title'],
            ]
        );

        return redirect()->route('users.accepteds.profiles.show');
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

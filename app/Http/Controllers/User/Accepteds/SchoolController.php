<?php

namespace App\Http\Controllers\User\Accepteds;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Accepteds\SchoolRequest;
use App\Models\CurrentEvent;
use App\Models\Geostate;
use App\Models\Personnel;
use App\Models\School;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $school = auth()->user()->school();
        $personnel = Personnel::firstOrCreate(
            [
                'school_id' => $school->id,
                'event_id' => CurrentEvent::currentEvent()->id,
            ],
            [
                'arrival_time' => '8:00 AM',
            ]
        );

        return view('users.accepteds.schools.show',
            [
                'colors' => explode(',', $school->colors),
                'event' => CurrentEvent::currentEvent(),
                'geostates' => Geostate::orderBy('abbr')->get(),
                'personnel' => $personnel,
                'school' => $school,
                'user' => auth()->user(),
            ]
        );
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
     * @param  \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolRequest $request, School $school)
    {//dd($request->all());

        //remove possible null values from $request['colors'] array
        $colors = array_filter($request['colors'], fn($color) => ((! is_null($color)) && (strlen($color) > 2)));

        $school->update(
            [
                'school_name' => $request['school_name'],
                'address_1' => $request['address_1'],
                'address_2' => $request['address_2'],
                'city' => $request['city'],
                'geostate_id' => $request['geostate_id'],
                'postal_code' => $request['postal_code'],
                'colors' => strtolower(implode(',',$colors)),
                'student_body' => $request['student_body'],
            ]
        );

        $mssg = $school->school_name.' has been updated!';

        return redirect()->back()->with('success', $mssg);
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

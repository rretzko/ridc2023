<?php

namespace App\Http\Controllers\User\Accepteds;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Accepteds\PersonnelRequest;
use App\Models\CurrentEvent;
use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param PersonnelRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonnelRequest $request)
    {
        $chaperones = array_values(array_filter($request['chaperones']));

        Personnel::where('event_id', CurrentEvent::currentEvent()->id)
            ->where('school_id', $request['school_id'])
            ->update(
                [
                    'accommodation' => $request['accommodation'],
                    'arrival_time' => $request['arrival_time'],
                    'chaperone_1' => (count($chaperones)) ? $chaperones[0] : '',
                    'chaperone_2' => (count($chaperones) > 1) ? $chaperones[1] : '',
                    'chaperone_3' => (count($chaperones) > 2) ? $chaperones[2] : '',
                ]
            );

        session()->flash('success', 'Personnel information updated.');

        return redirect()->route('users.accepteds.schools.show');
    }

}

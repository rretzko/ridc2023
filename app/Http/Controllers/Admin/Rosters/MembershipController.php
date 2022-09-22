<?php

namespace App\Http\Controllers\Admin\Rosters;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    public function index()
    {
        $admin_active = 'rosters';
        $roster_active = 'membership';

        return view('admin.rosters.memberships.index',
            compact('admin_active','roster_active')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $admin_active = 'rosters';
        $roster_active = 'membership';

        $dto = $user;

        return view('admin.memberships.edit', compact('dto','admin_active','roster_active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $inputs = $request->validate(
            [
                'email' => ['email','required'],
                'first' => ['string','required'],
                'last' => ['string','required'],
                'middle' => ['string', 'nullable'],
                'school_id' => ['numeric','required','exists:schools,id'],
                'school_name' => ['string','nullable'],
            ]
        );

        $user->update(
            [
                'email' => $inputs['email'],
                'first' => $inputs['first'],
                'last' => $inputs['last'],
                'middle' => $inputs['middle'],
                'name' => $inputs['first'].' '.$inputs['middle'].' '.$inputs['last'],
            ]
        );

        $this->updateSchool($user, $inputs);

        $admin_active = 'rosters';
        $roster_active = 'membership';

        session('success', $user->nameAlpha.' successfully updated');

        return view('admin.rosters.memberships.index',
            compact('admin_active','roster_active')
        );

    }

    private function updateSchool(User $user, array $inputs)
    {
        if(is_null($inputs['school_name'])) {

            $school_id = $inputs['school_id'];

        }else {

            $school_id = School::where('school_name', $inputs['school_name'])->exists()
                ? School::where('school_name', $inputs['school_name'])->first()->id
                : School::create(['school_name' => $inputs['school_name']])->id;
        }

        Person::where('user_id', $user->id)->update(['school_id' => $school_id]);
    }

}

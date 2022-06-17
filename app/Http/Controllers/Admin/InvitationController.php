<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminInvitationEvent;
use App\Http\Controllers\Controller;
use App\Models\CurrentEvent;
use App\Models\Invitation;
use App\Models\Pendingemail;
use App\Models\Pendingemailtype;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        Invitation::create([
            'event_id' => CurrentEvent::currentEvent()->id,
            'user_id' => $user->id,
        ]);

        //email invitation to $user
        //event(new AdminInvitationEvent($user));
        Pendingemail::updateOrCreate(
            [
                'user_id' => $user->id,
                'pendingemailtype_id' => Pendingemailtype::INVITATION,
            ]
        );

        return back()->with('success', 'Invitation Email to be sent to: '.$user->name.' is pending.');
    }
}

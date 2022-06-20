<?php

namespace App\Http\Livewire\Admin\Rosters;

use App\Models\Accepted;
use App\Models\CurrentEvent;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Withdraw;
use Livewire\Component;

class InvitationComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.rosters.invitation-component',
            [
                'invitations' => Invitation::where('event_id', CurrentEvent::currentEvent()->id)->paginate(15),
            ]);

    }

    public function accept(User $user)
    {
        Accepted::updateOrCreate(
            [
                'user_id' => $user->id,
                'event_id' => CurrentEvent::currentEvent()->id,
            ]
        );
    }

    public function withdraw(User $user)
    {
        //remove user from accepteds table
        $accepted = Accepted::where('user_id', $user->id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->delete();

        //add user to withdraws table
        Withdraw::updateOrCreate(
            [
                'user_id' => $user->id,
                'event_id' => CurrentEvent::currentEvent()->id,
            ]
        );
    }
}

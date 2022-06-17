<?php

namespace App\Http\Livewire\Admin\Rosters;

use App\Models\CurrentEvent;
use App\Models\Invitation;
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
}

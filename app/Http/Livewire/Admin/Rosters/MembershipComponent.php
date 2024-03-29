<?php

namespace App\Http\Livewire\Admin\Rosters;

use App\Models\Accepted;
use App\Models\CurrentEvent;
use App\Models\Invitation;
use App\Models\Pendingemail;
use App\Models\Pendingemailtype;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MembershipComponent extends Component
{

    use WithPagination;

    public function render()
    {
        return view('livewire.admin.rosters.membership-component',
        [
            'users' => User::orderBy('last')->orderBy('first')->select('id', 'last','first','middle')->paginate(15),
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

    public function applied(User $user)
    {
        //do nothing
    }

    public function invite(User $user)
    {
        Pendingemail::updateOrCreate(
            [
                'user_id' => $user->id,
                'pendingemailtype_id' => Pendingemailtype::INVITATION,
            ]
        );
    }

    public function remove(User $user)
    {
        session()->flash('success',  $user->name.' has been removed.');

        $user->delete();
    }



}

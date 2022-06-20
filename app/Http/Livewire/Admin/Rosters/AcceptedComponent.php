<?php

namespace App\Http\Livewire\Admin\Rosters;

use App\Models\Accepted;
use App\Models\CurrentEvent;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Withdraw;
use Livewire\Component;

class AcceptedComponent extends Component
{
    public $ensembleCount = 0;
    public $success = '';
    public $teacherName = '';
    public $user = null;

    public function render()
    {
        return view('livewire.admin.rosters.accepted-component',
            [
                'invitations' => Accepted::where('event_id', CurrentEvent::currentEvent()->id)->paginate(15),
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

    public function edit(User $user)
    {
        $this->reset('success');
        $this->user = $user;
        $this->teacherName = $user->name;
        $this->ensembleCount = $user->accepted->ensemble_count;
    }

    public function submitEnsembleCount()
    {
        Accepted::updateOrCreate(
          [
              'event_id' => CurrentEvent::currentEvent()->id,
              'user_id' => $this->user->id
          ],
          [
              'ensemble_count' => $this->ensembleCount,
          ]
        );

        $this->success = 'Ensemble count for: '.$this->user->name.' is updated to: '.$this->ensembleCount.'.';

        $this->reset(['ensembleCount', 'teacherName', 'user']);
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

<?php

namespace App\Http\Livewire\Admin\Rosters;

use App\Models\CurrentEvent;
use App\Models\EventSchool;
use App\Models\Person;
use App\Models\User;
use Livewire\Component;

class ApplicantComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.rosters.applicant-component',
            [
                'users' => $this->applicants(),
            ]
        );
    }

    private function applicants()
    {
        $event_schools = EventSchool::where('event_id', CurrentEvent::currentEvent()->id)->get();

        $users = [];
        foreach($event_schools AS $event_school){

            $person = Person::where('school_id', $event_school->school_id)->first();

            if($person->user_id !== 1){//exclude developer
              $users[] = $person->user_id;
            }
        }
        return User::whereIn('id',$users)->orderBy('last')->orderBy('first')->select('id', 'last','first','middle','email')->paginate(15);
    }
}

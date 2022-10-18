<?php

namespace App\Exports;

use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventSchool;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicantsExport implements FromCollection, WithHeadings, WithMapping
{
    private $users;

    public function __construct()
    {
        $this->users = $this->makeUsers();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'last',
            'first',
            'middle',
            'email',
            'cell',
            'work',
            'school',
            'city',
            'state',
            'primary',
            'primary_type',
            'students',
            'adults',
            'secondary',

        ];
    }

    public function map($user): array
    {
        $primary = [
            $user->last,
            $user->first,
            $user->middle,
            $user->email,
            $user->phoneMobile,
            $user->phoneWork,
            $user->person->school->shortName,
            $user->person->school->city,
            $user->person->school->geostateAbbr,
            $user->person->school->eventEnsemblesPrimary()->ensemble_name,
            $user->person->school->eventEnsemblesPrimary()->category->descr,
            $user->person->school->eventAttendingStudents,
            $user->person->school->eventAttendingAdults,
        ];

        $a = array_merge($primary, $this->secondaryEventEnsembles($user));

        return $a;
    }

    private function makeUsers() : Collection
    {
        $event_schools = EventSchool::where('event_id', CurrentEvent::currentEvent()->id)->get();

        $users = [];
        foreach($event_schools AS $event_school){

            $person = Person::where('school_id', $event_school->school_id)->first();

            if($person->user_id !== 1){//exclude developer
                $users[] = $person->user_id;
            }
        }
        return User::whereIn('id',$users)
            ->orderBy('last')
            ->orderBy('first')
            ->select('id', 'last','first','middle','email')
            ->get();
    }

    private function secondaryEventEnsembles($user): array
    {
        $a = [];

        foreach($user->person->school->eventEnsemblesSecondary() AS $eventensemble){
            $a[] = $eventensemble->ensemble_name;
            $a[] = $eventensemble->category->descr;
        }

        return $a;
    }
}

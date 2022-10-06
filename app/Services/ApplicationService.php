<?php

namespace App\Services;

use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use App\Models\EventSchool;
use App\Models\Phone;
use App\Models\School;

class ApplicationService
{
    private $currenteventid;
    private $inputs;
    private $newensemble;

    public function __construct(array $inputs)
    {
        $this->currenteventid = CurrentEvent::currentEvent()->id;
        $this->inputs = $inputs;
        $this->newensemble = new Ensemble;

        $this->init();
    }
/** END OF PUBLIC FUNCTIONS *******************************************************************************************/

    private function ensembleIdIsPrimary($ensembleid): bool
    {
        return (bool)EventEnsemble::where('ensemble_id',$ensembleid)
            ->where('event_id',$this->currenteventid)
            ->where('primary',1)
            ->first();
    }

    private function init(): void
    {
        //destroy current event
        EventEnsemble::destroySchoolEnsembles($this->inputs['school_id']);

        //create a new ensemble if necessary
        $this->makeNewEnsemble();

        //do updates
        $this->updateUser();
        $this->updatePhones();
        $this->updateSchool();
        $this->updateEnsemblesPrimary();
        $this->updateEnsemblesSecondary();
        $this->updateEventSchool();
    }

    private function makeNewEnsemble(): void
    {
        if(array_key_exists('newensemblename', $this->inputs) &&
            (!is_null($this->inputs['newensemblename'])) &&
            strlen($this->inputs['newensemblename']) &&
            is_numeric($this->inputs['newensemblecategoryid'])){

            $this->newensemble = Ensemble::create(
                [
                    'ensemble_name' => $this->inputs['newensemblename'],
                    'abbr' => $this->newensemble::makeAbbreviation($this->inputs['newensemblename']),
                    'category_id' => $this->inputs['newensemblecategoryid'],
                    'directed_by' => auth()->user()['person']->fullName,
                    'descr' => 'none'
                ]
            );

            //attach to school
            $school = School::find($this->inputs['school_id']);
            $school->ensembles()->attach($this->newensemble->id);
        }
    }

    private function updateEnsemblesPrimary()
    {
        EventEnsemble::create(
            [
                'event_id' => $this->currenteventid,
                'ensemble_id' => ($this->newensemble->id ?: $this->inputs['primary']),
                'primary' => 1,
                'school_id' => $this->inputs['school_id'],
            ],
        );
    }

    private function updateEnsemblesSecondary()
    {
        //if $this->inputs includes both a NEW ensemble and a primary ensemble,
        //assign the primary ensemble to the secondaries array
        if($this->newensemble->id && $this->inputs['primary']){

            $this->inputs['secondaries'][] = $this->inputs['primary'];
        }

        //add secondary EventEnsembles
        if(array_key_exists('secondaries', $this->inputs) && count($this->inputs['secondaries'])){

            foreach($this->inputs['secondaries'] AS $ensembleid) {

                if(! $this->ensembleIdIsPrimary($ensembleid)) {

                    EventEnsemble::updateOrCreate(
                        [
                            'event_id' => $this->currenteventid,
                            'ensemble_id' => $ensembleid,
                        ],
                        [
                            'primary' => 0,
                            'school_id' => $this->inputs['school_id'],
                        ],
                    );
                }
            }
        }
    }

    private function updateEventSchool()
    {
        EventSchool::updateOrCreate(
          [
              'event_id' => $this->currenteventid,
              'school_id' => $this->inputs['school_id'],
          ],
          [
              'attending_adults' => $this->inputs['attending_adults'],
              'attending_students' => $this->inputs['attending_students'],
          ]
        );

    }

    private function updatePhones()
    {
        $phonetypes = ['phone_mobile','phone_work'];
        $phone = new Phone;

        foreach($phonetypes AS $phonetype){

            $formatted = (is_null($this->inputs[$phonetype]))
                ? 'none' //default value
                : $phone::formatPhone($this->inputs[$phonetype]);

            $phone->updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'mobile' => ($phonetype === 'phone_mobile')
                ],
                [
                    'phone' => $formatted
                ],
            );
        }
    }

    private function updateSchool()
    {
        $school = School::find($this->inputs['school_id']);

        $school->update(
            [
                'school_name' => $this->inputs['school_name'],
                'address_1' => $this->inputs['address_1'],
                'address_2' => $this->inputs['address_2'],
                'city' => $this->inputs['city'],
                'geostate_id' => $this->inputs['geostate_id'],
                'postal_code' => $this->inputs['postal_code'],
            ]
        );

        EventSchool::updateOrCreate(
            [
                'event_id' => $this->currenteventid,
                'school_id' => $school->id,
            ],
            [
                'attending_adults' => $this->inputs['attending_adults'],
                'attending_students' => $this->inputs['attending_students'],
            ]
        );

    }

    private function updateUser()
    {
        auth()->user()->update(
            [
                'email' => $this->inputs['email'],
            ],
        );

        auth()->user()->fresh();
    }
}

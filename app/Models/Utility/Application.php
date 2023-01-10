<?php

namespace App\Models\Utility;

use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use App\Models\EventSchool;
use App\Models\Geostate;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public $ensemble_count;
    public $ensemble_fee;
    public $primaryensembleid;
    public $secondaryensembleids;

    private $event;
    private $event_id;
    private $event_school;
    private $school;
    private $user_id;

    public function __construct()
    {
        $this->event = CurrentEvent::currentEvent();
        $this->event_id = $this->event->id;
        $this->ensemble_fee = $this->event->ensemble_fee;
        $this->user = auth()->user();
        $this->school = $this->user['person']['school'];

        $this->event_school = EventSchool::where('school_id', $this->school->id)
            ->where('event_id', $this->event_id)
            ->first();

        $this->primaryensembleid = $this->getPrimaryEnsembleIdAttribute();
        $this->secondaryensembleids = $this->getSecondaryEnsembleIdsAttribute();
        $this->ensemble_count = $this->ensembleCount();
    }

    public function getAddress1Attribute(): string
    {
        return $this->school->address_1 ?? '';
    }

    public function getAddress2Attribute(): string
    {
        return $this->school->address_2 ?? '';
    }

    public function getAddressBlockAttribute(): string
    {
        $str = $this->school->address_1;
        $str .= (strlen($this->school->address_2))
            ? '<br />'.$this->school->address_2
            : '';
        $str .= '<br />'.$this->cityStateZipBlock();

        return $str;
    }

    public function getAttendingAdultsAttribute(): int
    {
        return $this->event_school->attending_adults ?? 1;
    }

    public function getAttendingStudentsAttribute(): int
    {
        return $this->event_school->attending_students ?? 1;
    }

    public function getCityAttribute(): string
    {
        return $this->school->city ?? '';
    }

    public function getGeostateIdAttribute(): string
    {
        return $this->school->geostate_id ?? '';
    }

    public function getEmailAttribute(): string
    {
        return $this->user->email ?? '';
    }

    public function getEnsemblesBlockAttribute(): string
    {
        $primary = Ensemble::find($this->primaryensembleid);

        if(! is_null($primary)) {
            $str = '<ol>';

            $str .= '<li>' . $primary->ensemble_name . ' <span class="hint">(' . $primary->category->descr . '</span>)</li>';

            foreach ($this->secondaryensembleids as $ensembleid) {

                $ensemble = Ensemble::find($ensembleid);

                //reduce font-weight to hint as secondary ensembles
                $str .= '<li style="font-weight: normal;">' . $ensemble->ensemble_name . ' <span class="hint">(' . $ensemble->category->descr . ')</span></li>';
            }

            $str .= '</ol>';

        }else{

            $str = '<ol><li>None Found</li></ol>';
        }

        return $str;
    }

    public function getPaymentDueAttribute(): float
    {
        return ($this->ensemble_fee * $this->ensemble_count);
    }

    public function getPhoneMobileAttribute(): string
    {
        return $this->user->phoneMobile ?? '';
    }

    public function getPhoneWorkAttribute(): string
    {
        return $this->user->phoneWork ?? '';
    }

    public function getPostalCodeAttribute(): string
    {
        return $this->school->postal_code ?? '';
    }

    public function getPrimaryEnsembleIdAttribute(): int
    {
        return EventEnsemble::where('school_id',$this->school->id)
            ->where('event_id', $this->event_id)
            ->where('primary',1)
            ->value('ensemble_id') ?? 0;
    }

    public function getSchoolIdAttribute(): int
    {
        return $this->school->id ?? 0;
    }

    public function getSchoolNameAttribute(): string
    {
        return $this->school->school_name ?? '';
    }

    public function getSecondaryEnsembleIdsAttribute(): array
    {
        return EventEnsemble::where('school_id',$this->school->id)
                ->where('event_id', $this->event_id)
                ->where('primary',0)
                ->pluck('ensemble_id')
                ->toArray() ?? [];
    }

    public function getUserNameAttribute(): string
    {
        return $this->user->name;
    }
/** END OF PUBLIC FUNCTION ***************************************************/

    private function cityStateZipBlock(): string
    {
        $str = '';

        $str .= (strlen($this->school->city)) ? $this->school->city.', ' : '';
        $str .= (strlen($this->school->geostate_id)) ? Geostate::find($this->school->geostate_id)->abbr.'  ' : '  ';
        $str .= (strlen($this->school->postalcode)) ? $this->school->postalcode : '';

        return $str;
    }

    private function ensembleCount(): int
    {
        $primary_ensemble_count = ($this->primaryensembleid) ? 1 : 0;
        $secondary_ensemble_count = count($this->secondaryensembleids);

        return ($primary_ensemble_count + $secondary_ensemble_count);
    }



}

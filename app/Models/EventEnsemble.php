<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EventEnsemble extends Model
{
    use HasFactory;

    protected $fillable = ['accepted','ensemble_id','event_id','primary','school_id'];

    static public function destroySchoolEnsembles(int $school_id): void
    {
        $currenteventid = CurrentEvent::currentEvent()->id;

        //get objects to be destroyed
        $current = EventEnsemble::where('event_id', $currenteventid)
            ->where('school_id', $school_id)
            ->get();

        EventEnsemble::destroy($current);
    }

   static  public function ensembles(): Collection
    {
        $event_id = CurrentEvent::currentEvent()->id;
        return EventEnsemble::where('event_id', $event_id)->get()->sortBy(['schoolName', 'ensembleName']);
    }

    static  public function ensemblesByTimeslots(): Collection
    {
        $event_id = CurrentEvent::currentEvent()->id;

        return EventEnsemble::where('event_id', $event_id)
            ->where('accepted',1)
            ->get()
            ->sortBy(['timeslot', 'schoolName', 'ensembleName']);
    }

    public function getCategoryDescrAttribute(): string
    {
        return Ensemble::find($this->event_id)->category->descr;
    }

    public function getEnsembleAttribute(): Ensemble
    {
        return Ensemble::find($this->ensemble_id);
    }

    public function getEnsembleNameAttribute(): string
    {
        return Ensemble::find($this->ensemble_id)->ensemble_name;
    }

    /**
     * Return timeslot in 'hh:mm a' format or 'tbd' if not found
     * @return string
     */
    public function getFormattedTimeslotAttribute(): string
    {
        return ($this->timeslot)
            ? Carbon::parse($this->timeslot)->format('g:i a')
            : 'tbd';
    }

    public function getSchoolNameAttribute(): string
    {
        return School::find($this->school_id)->shortName;
    }

    public function getEnsembleTimeslotAttribute(): Carbon
    {
        $timeslot = EnsembleTimeslot::where('ensemble_id', $this->ensemble_id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->first()
            ->timeslot ?? Carbon::now();

        return Carbon::parse($timeslot);
    }



}

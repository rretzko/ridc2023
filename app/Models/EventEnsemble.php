<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function ensemble(): Ensemble
    {
        return $this->belongsTo(Ensemble::class);
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
      'descr','close_date', 'end_time', 'ensemble_fee',
        'event_date',
        'max_concert', 'max_show', 'max_soloists',
        'open_date', 'start_time',
        'subtitle','title'
    ];

    public function getEventDateDMdYAttribute() : string
    {
        return Carbon::parse($this->event_date)->format('l, F d, Y');
    }

    public function getAdjudicatorsAttribute()
    {
        return AdjudicatorEvent::where('event_id', $this->id)
            ->join('adjudicators','adjudicator_events.adjudicator_id','=','adjudicators.id')
            ->get()
            ->sortBy([['concert', 'desc'], 'last']);
    }

    public function getEnsemblesAttribute()
    {
        $ids = DB::table('event_ensembles')
            ->where('event_id', $this->id)
            ->pluck('ensemble_id');

        return Ensemble::whereIn('id', $ids)->get();
    }

    public function getSchoolsAttribute()
    {
        $ids = DB::table('event_schools')
            ->where('event_id', $this->id)
            ->pluck('school_id');

        return School::whereIn('id', $ids)->get();
    }
}

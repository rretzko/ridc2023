<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['adjudicator_id', 'ensemble_id', 'event_id',
        'partial', 'portion', 'school_id', 'uploaded_by', 'url'];

    public function getAdjudicatorLastNameAttribute(): string
    {
        return Adjudicator::find($this->adjudicator_id)->last_name;
    }

    public function getAdjudicatorNameAttribute(): string
    {
        return Adjudicator::find($this->adjudicator_id)->full_name;
    }

    public function getEnsembleNameAttribute(): string
    {
        return Ensemble::find($this->ensemble_id)->ensemble_name;
    }

    public function getEventNameAttribute(): string
    {
        return Event::find($this->event_id)->subtitle;
    }

    public function getSchoolNameAttribute(): string
    {
        return School::find($this->school_id)->shortName;
    }

    public function getMp3PlayerAttribute()
    {
        $path = $this->url;

        $src = Storage::disk('spaces')->url($path);

        $str = '<audio controls>';
        $str .= '<source src="'.$src.'" type="audio/mpeg">';
        $str .= 'Your browser does not support the audio element';
        $str .= '</audio>';

        return $str;
    }

    /**
     * Return all files from previous events and
     * files from the current event
     * where the current time is AFTER the current event end_time
     * @return Collection
     */
    public function getMyFilesAttribute(): Collection
    {
        $currentEvent = CurrentEvent::currentEvent();
        $currentEventId = $currentEvent->id;

        $schoolId = auth()->user()->school()->id;

        $endDateTime = $currentEvent->event_date . ' ' . $currentEvent->end_time;

        $releaseDateTime = new Carbon($endDateTime);

        $operator = (Carbon::now() > $releaseDateTime)
            ? '<=' //release all recordings including the current event
            : '<'; //release all recordings prior to current event

        return FileUpload::query()
            ->join('events','file_uploads.event_id','=', 'events.id')
            ->where('file_uploads.school_id', $schoolId)
            ->where('file_uploads.event_id', $operator, $currentEventId)
            ->orWhere(function(Builder $query) use($currentEventId, $schoolId){
                $query->where('file_uploads.event_id', $currentEventId)
                ->where('file_uploads.school_id', $schoolId)
                ->where('events.release_files','<', Carbon::now());
            })
            ->get()
            ->sortBy([
                ['event_id', 'desc'],
                ['portion', 'desc'],
                ['ensembleName', 'asc'],
                ['adjudicatorLastName', 'asc'],
                ['partial','asc'],
            ]);
    }
}

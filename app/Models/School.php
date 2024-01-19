<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['address_1','address_2','city','colors','geostate_id','postal_code','school_name',
        'student_body'];

    protected $with = ['ensembles'];

    public function getAcceptedEnsemblesAttribute(): Collection
    {
        if(! is_null($this->id)) {

            $ids = EventEnsemble::where('school_id', $this->id)
                ->where('event_id', CurrentEvent::currentEvent()->id)
                ->where('accepted', 1)
                ->pluck('ensemble_id');

            return Ensemble::find($ids);
        }
    }

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class);
    }

    public function eventEnsemblesPrimary(): Ensemble
    {
        return Ensemble::find(EventEnsemble::where('school_id', $this->id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->where('primary',1)
            ->value('ensemble_id'));
    }

    public function eventEnsemblesSecondary(): Collection
    {
        $ensemble_ids = EventEnsemble::where('school_id', $this->id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->where('primary',0)
            ->pluck('ensemble_id');

        $ensembles = collect();

        foreach($ensemble_ids AS $ensemble_id){

            $ensembles->push(Ensemble::find($ensemble_id));
        }

        return $ensembles;
    }

    public function getCountSoloistsAttribute(): int
    {
        return Soloist::where('school_id', $this->id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->count('id');
    }

    public function countSoloistsConcert(Event $event): int
    {
        return Soloist::where('event_id', $event->id)
            ->where('school_id', $this->id)
            ->where('concert', 1)
            ->count('id');
    }

    public function countSoloistsJPS(Event $event): int //JSP = Jazz, Show, Pop
    {
        return Soloist::where('event_id', $event->id)
            ->where('school_id', $this->id)
            ->where('concert', 0)
            ->count('id');
    }

    public function getCountStudentsAttribute(): int
    {
        return Student::where('school_id', $this->id)->count('id');
    }

    public function getEtaAttribute(): string
    {
        return Personnel::where('event_id', CurrentEvent::currentEvent()->id)
            ->where('school_id', $this->id)
            ->first()
            ->arrival_time ?? 'none found';
    }

    public function getPersonnelUpdatedDateFormattedAttribute(): string
    {
        //$dt = Carbon::parse(EventSchool::where('school_id', $this->id)->first()->updated_at);
        $dt = Personnel::where('event_id', CurrentEvent::currentEvent()->id)
            ->where('school_id', $this->id)
            ->first()
            ->updated_at ?? 'none found';

        return $dt === 'none found' ? $dt : $dt->format('M j, y g:i a');
    }

    public function getEventAttendingAdultsAttribute(): int
    {
        return EventSchool::where('school_id', $this->id)
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->value('attending_adults') ?? 0;
    }

    public function getEventAttendingStudentsAttribute(): int
    {
        return EventSchool::where('school_id', $this->id)
                ->where('event_id', CurrentEvent::currentEvent()->id)
                ->value('attending_students') ?? 0;
    }

    public function getGeostateAbbrAttribute(): string
    {
        return Geostate::find($this->geostate_id)->abbr;
    }

    public function getShortnameAttribute()
    {
        $name = $this->school_name;
        $name = str_replace('Central High School', 'CHS', $name);
        $name = str_replace('Central School District', 'CSD', $name);
        $name = str_replace('Regional High School', 'RHS', $name);
        $name = str_replace('Senior High School', 'SHS', $name);
        $name = str_replace('High School', 'HS', $name);

        return $name;
    }

    public function getSoloists(Event $event): array
    {
        $a = [];

        $soloists = Soloist::where('event_id', $event->id)
            ->where('school_id', $this->id)
            ->get();

        foreach($soloists AS $soloist){

            $fullNameAlpha = $soloist->fullNameAlpha;
            $soloistTypeDescr = $soloist->concert ? 'Concert' : 'Jazz/Pop/Show';

            $a[] = [
                'sortOrder' => ($soloistTypeDescr . $fullNameAlpha),
                'fullNameAlpha' => $fullNameAlpha,
                'id' => $soloist->id,
                'soloistTypeDescr' => $soloistTypeDescr,
                'title' => $soloist->title,
                'composer' => $soloist->composer,
                ];

        }

        sort($a);

        return $a;
    }

    public function students()
    {
        return $this->hasMany(Student::class)
            ->orderBy('last')
            ->orderBy('first');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

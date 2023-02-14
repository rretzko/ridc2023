<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Soloist extends Model
{
    use HasFactory;

    protected $fillable = ['concert','event_id','school_id','student_id'];

    /**
     * Soloist cohort consists of two concert and two jazz/pop/show soloists
     *
     * @param int $school_id
     * @param int $event_id
     * @return array
     */
    public function cohort(int $event_id, int $school_id): Collection
    {
        $concerts = Soloist::where('event_id',$event_id)
            ->where('school_id', $school_id)
            ->where('concert',1)
            ->orderBy('id')
            ->get();

        $jazzpop = Soloist::where('event_id','=',$event_id)
            ->where('school_id', $school_id)
            ->where('concert',0)
            ->orderBy('id')
            ->get();

        $cohort = collect();
        $cohort = $cohort->merge($concerts);
        $countConcerts = $cohort->count();
        for($i=0; $i<(2 - $countConcerts); $i++){
            $cohort->push(new Soloist);
        }

        $cohort = $cohort->merge($jazzpop);
        $countMerged = $cohort->count();
        for($i=0; $i<(4 - $countMerged); $i++){

            $cohort->push(new Soloist);

        }

        return $cohort;
    }

    public function getCategoryAttribute(): string
    {
        return ($this->concert) ? 'concert' : 'jazz/pop/show';
    }

    public function getFullNameAttribute(): string
    {
        return Student::find($this->student_id)->fullName;
    }

    public function getFullNameAlphaAttribute(): string
    {
        return Student::find($this->student_id)->fullNameAlpha;
    }

    public function getSchoolNameAttribute(): string
    {
        return School::find($this->school_id)->shortName;
    }

    /**
     * Soft Delete all current soloists
     * @param int $school_id
     * @param int $event_id
     * @return void
     */
    public function reset(int $school_id, int $event_id): void
    {
        Soloist::where('event_id', '=', $event_id)
            ->where('school_id', '=', $school_id)
            ->delete();
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id','id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id','id');
    }

    static  public function soloistsBySchoolAlphaName(): Collection
    {
        $eventId = CurrentEvent::currentEvent()->id;

        return DB::table('soloists')
            ->join('schools', 'soloists.school_id','=','schools.id')
            ->join('students','soloists.student_id','=','students.id')
            ->where('soloists.event_id','=', $eventId)
            ->orderBy('schools.school_name')
            ->orderBy('students.last')
            ->orderBy('students.first')
            ->select('soloists.id','schools.school_name','soloists.concert','soloists.timeslot','students.first','students.last','students.middle')
            ->get();
    }

    static  public function soloistsByTimeslots(): Collection
    {
        $eventId = CurrentEvent::currentEvent()->id;

        return DB::table('soloists')
            ->join('schools', 'soloists.school_id','=','schools.id')
            ->join('students','soloists.student_id','=','students.id')
            ->where('soloists.event_id','=', $eventId)
            ->orderBy('soloists.timeslot')
            ->orderBy('schools.school_name')
            ->select('soloists.id','schools.school_name','soloists.concert','soloists.timeslot','students.first','students.last','students.middle')
            ->get();
    }
}

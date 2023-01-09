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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setup extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['accompaniment', 'amp', 'band_award', 'category_id', 'drumset', 'ensemble_id', 'event_id',
        'instructions', 'instrumentation', 'microphone', 'piano', 'platform', 'props'];

    public function getCategoryDescrAttribute(): string
    {
        return Ensemble::find($this->ensemble_id)->categoryDescr;
    }

    public function getDirectorAttribute(): string
    {
        $ensemble = Ensemble::find($this->ensemble_id);
        $schoolId = $ensemble->schools()->first()->id;
        $userId = Person::where('school_id', $schoolId)->first()->user_id;
        $user = User::find($userId);
if(! $user){ dd('userId: ' . $userId . ' | ensembleName: ' . $ensemble->ensemble_name . ' (' . $ensemble->id . ')');}
        return User::find($userId)->name;
    }

    public function getIsUpdatedAttribute(): bool
    {
        return (! ($this->created_at === $this->updated_at));
    }

    public function getEnsembleNameAttribute(): string
    {
        return Ensemble::find($this->ensemble_id)->ensemble_name;
    }

    public function getSchoolNameAttribute(): string
    {
        return Ensemble::find($this->ensemble_id)->schoolName;
    }
}

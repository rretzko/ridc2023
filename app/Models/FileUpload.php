<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['adjudicator_id', 'ensemble_id', 'event_id',
        'partial', 'school_id', 'uploaded_by', 'url'];

    public function getAdjudicatorNameAttribute(): string
    {
        return Adjudicator::find($this->adjudicator_id)->full_name;
    }

    public function getEnsembleNameAttribute(): string
    {
        return Ensemble::find($this->ensemble_id)->ensemble_name;
    }

    public function getSchoolNameAttribute(): string
    {
        return School::find($this->school_id)->shortName;
    }

    public function getMp3PlayerAttribute()
    {
        $path = $this->url;

//        return  '';
        $src = Storage::disk('spaces')->url($path);

        $str = '<audio controls>';
        $str .= '<source src="'.$src.'" type="audio/mpeg">';
        $str .= 'Your browser does not support the audio element';
        $str .= '</audio>';

        return $str;
    }
}

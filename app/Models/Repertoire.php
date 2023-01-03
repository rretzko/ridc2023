<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repertoire extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['arranger','choreographer','composer','duration','ensemble_id','event_id','lyricist','notes',
        'order_by','subtitle','title',];

    public function artistsCsv(): string
    {
        $artists = [];

        if(strlen($this->composer)){ $artists[] = $this->composer.' (c)'; }
        if(strlen($this->arranger)){ $artists[] = $this->arranger.' (a)'; }
        if(strlen($this->lyricist)){ $artists[] = $this->lyricist.' (l)'; }
        if(strlen($this->choreographer)){ $artists[] = $this->choreographer.' (g)'; }

        return implode(', ', $artists);
    }

    public function durationInMinutesSeconds(): string
    {
        $minutes = floor(($this->duration / 60));
        $modulo = ($this->duration % 60);
        $seconds = ($modulo > 9) ? $modulo : '0'.$modulo;

        return $minutes.':'.$seconds;
    }
}

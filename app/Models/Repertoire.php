<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;

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
        return $this->performanceMinutes().':'.$this->performanceSeconds();
    }

    /**
     * Return the calculated seconds portion of $this->duration
     * @return int
     */
    public function performanceMinutes(): string
    {
        return floor(($this->duration / 60));
    }

    /**
     * Return the calculated seconds portion of $this->duration
     * @return int
     */
    public function performanceSeconds(): string
    {
        $modulo = ($this->duration % 60);
        return ($modulo > 9) ? $modulo : '0'.$modulo;
    }
}

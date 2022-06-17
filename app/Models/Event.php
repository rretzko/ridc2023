<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

<?php

namespace App\Models;


use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class CurrentEvent extends Model
{
    public static function currentEvent()
    {
        return Event::where('close_date','>',Carbon::now())->exists()
            ? Event::where('close_date', '>', Carbon::now())->first()
            : Event::orderByDesc('event_date')->first();
    }

    public static function seniorYear(): int
    {
        return (int)substr(self::currentEvent()->event_date, 0, 4);
    }
}

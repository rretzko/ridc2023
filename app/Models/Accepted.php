<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accepted extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ensemble_count','event_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class)
            ->where('event_id', CurrentEvent::currentEvent()->id);
    }
}

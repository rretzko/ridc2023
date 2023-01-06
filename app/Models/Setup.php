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
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['event_id','user_id'];

    public function getHumanUpdatedAtAttribute(): string
    {
        return Carbon::parse($this->updated_at)->format('M d, y g:i:s a');
    }
}

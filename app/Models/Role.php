<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const OWNER = 1;
    public const LEADTEACHER = 2;
    public const EVENTADMIN = 3;
    public const ENDUSER = 4;

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('event_id');
    }
}

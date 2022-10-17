<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchool extends Model
{
    use HasFactory;

    protected $fillable = ['attending_adults','attending_students','eta','event_id','hotel','school_id'];

    public function director(int $event_id, int $school_id): User
    {
        return Person::with('user')->where('school_id', $school_id);
    }
}

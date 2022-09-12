<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchool extends Model
{
    use HasFactory;

    protected $fillable = ['attending_adults','attending_students','eta','event_id','hotel','school_id'];
}

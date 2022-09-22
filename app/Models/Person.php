<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['phone_mobile','phone_work','school_id'];

    protected $with = ['school'];

    public function user()
    {
        return $this->belongsTo(Person::class);
    }

    public function school()
    {
        return $this->hasOne(School::class,'id','school_id');
    }

}

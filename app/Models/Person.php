<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['phone_mobile','phone_work','school_id','user_id'];

    protected $with = ['school'];

    protected $primaryKey = 'user_id';

    public function user()
    {
        return User::find($this->user_id);
    }

    public function school()
    {
        return $this->hasOne(School::class,'id','school_id');
    }

}

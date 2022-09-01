<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['address_1','address_2','city','colors','geostate_id','postal_code','school_name',
        'student_body'];

    protected $with = ['ensembles'];

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class);
    }

    public function getShortnameAttribute()
    {
        $name = $this->name;
        $name = str_replace('Central School District', 'CSD', $name);
        $name = str_replace('Regional High School', 'RHS', $name);
        $name = str_replace('Senior High School', 'SHS', $name);
        $name = str_replace('High School', 'HS', $name);

        return $name;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

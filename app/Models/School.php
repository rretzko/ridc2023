<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

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

<?php

namespace App\Models;

use App\Models\Utility\ClassOf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['class_of', 'first', 'last', 'middle', 'school_id'];

    public function getFullNameAttribute(): string
    {
        $str = $this->first;
        $str .= strlen($this->middle) ? ' '.$this->middle : '';
        $str .= ' '.$this->last;

        return $str;
    }

    public function getFullNameAlphaAttribute(): string
    {
        $str = $this->last.', ';
        $str .= $this->first;
        $str .= strlen($this->middle) ? ' '.$this->middle : '';

        return $str;
    }

    public function getGradeAttribute(): string
    {
        return ClassOf::grade($this->class_of);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}

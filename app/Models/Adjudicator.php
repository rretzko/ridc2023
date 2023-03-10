<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adjudicator extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['full_name','last_name','biography','image_file'];
}

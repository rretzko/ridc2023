<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendingemailtype extends Model
{
    use HasFactory;

    protected $fillable = ['descr'];

    public const ACCEPTED=1;
    public const INVITATION=2;

}

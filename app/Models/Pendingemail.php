<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Pendingemail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['pendingemailtype_id', 'user_id'];

    protected $with = ['pendingemailtype', 'user'];

    public function pendingemailtype()
    {
        return $this->belongsTo(Pendingemailtype::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjudicatorEvent extends Model
{
    use HasFactory;

    protected $fillable = ['adjudicator_id', 'category_id', 'event_id'];

    public function adjudicator(): Adjudicator
    {
        return Adjudicator::find($this->adjudicator_id) ?: new Adjudicator;
    }
}

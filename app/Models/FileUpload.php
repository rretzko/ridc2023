<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUpload extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['adjudicator_id', 'ensemble_id', 'event_id',
        'partial', 'school_id', 'uploaded_by', 'url'];
}

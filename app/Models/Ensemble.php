<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ensemble extends Model
{
    use HasFactory;

    protected $fillable = ['abbr','category_id','descr','directed_by','ensemble_name','logo_file'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

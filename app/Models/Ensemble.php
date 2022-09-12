<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ensemble extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['abbr','category_id','descr','directed_by','ensemble_name','logo_file'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    static public function makeAbbreviation($ensemblename): string
    {
        //early exit
        if(! strlen($ensemblename)){ return 'none';}

        $abbr = '';

        $parts = explode(' ',$ensemblename);

        foreach($parts AS $part){

            if(strlen($part) > 3){ //skip short words ex. 'a','of','the'

                $abbr .= strtoupper(substr($part,0,1));
            }
        }

        return (strlen($abbr));
    }

}

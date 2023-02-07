<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ensemble extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['abbr','category_id','descr','directed_by','ensemble_name','logo_file'];

    //protected $with = ['repertoire','setup'];

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

    public function repertoire()
    {
        return $this->hasMany(Repertoire::class,'ensemble_id','id')
            ->where('event_id', CurrentEvent::currentEvent()->id)
            ->orderBy('order_by');
    }

    public function schools()
    {
        return $this->belongsToMany(School::class);
    }

    public function setup()
    {
        return $this->hasOne(Setup::class, 'ensemble_id','id')
            ->where('event_id', CurrentEvent::currentEvent()->id);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['mobile','phone','user_id'];

    static public function formatPhone($str) : string
    {
        $numbers = self::isolateNumbers($str);

        $fphone = '('.substr($numbers,0,3).') '.substr($numbers,3,3).'-'.substr($numbers,6,4);

        return (strlen($numbers) > 10)
            ? $fphone.' x'.substr($numbers,10)
            : $fphone;
    }

    static private function isolateNumbers(string $str) : int
    {
        $res = '';

        foreach(str_split($str) AS $char){
            $res .= (is_numeric($char)) ? $char : '';
        }

        return $res;
    }
}

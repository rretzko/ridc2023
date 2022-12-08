<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassOf extends Model
{
    use HasFactory;

    /**
     * Return array of [year => descr] where descr= grade/year
     * @return array
     */
    static public function classOfs(): array
    {
        $a = [];

        $sr_year = self::calcSeniorYear();

        for($i = 12; $i>0; $i--){

            $a[$sr_year] = $i.' ('.$sr_year.')';

            $sr_year++;
        }

        return $a;
    }

    /**
     * 12th grade minus the difference between the current Senior Year and the provided $class_of value
     * @param int $class_of
     * @return int
     */
    static public function grade(int $class_of): int
    {
        $sr_year = self::calcSeniorYear();

        return (12 - ($class_of - $sr_year));
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    /**
     * For months January - June, the senior year is the current year
     * For months July - December, the senior year is the next year
     * @return int
     */
    static private function calcSeniorYear(): int
    {
        return (date('n') < 7) //current month is January - June
            ? date('Y')
            : (date('Y') + 1);
    }
}

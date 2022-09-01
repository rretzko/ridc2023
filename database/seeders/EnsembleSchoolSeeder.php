<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsembleSchoolSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->seeds = $this->buildSeeds();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed){

            DB::table('ensemble_school')
                ->insert(
                    [
                        'ensemble_id' => $seed[0],
                        'school_id' => $seed[1],
                    ],
                );
        }
    }

    private function buildSeeds()
    {
        return [
            [1,120],
            [2,120],
            [3,93],
            [5,106],
            [6,31],
            [7,42],
            [8,42],
            [9,114],
            [10,114],
            [11,44],
            [12,60],
            [13,60],
            [16,40],
            [18,116],
            [19,33],
            [20,89],
            [21,89],
            [22,89],
            [23,89],
            [24,89],
            [25,12],
            [26,12],
            [27,89],
            [28,89],
            [29,100],
            [30,10],
            [31,12],
            [32,16],
            [33,87],
            [34,24],
            [37,66],
            [38,72],
            [39,110],
            [40,16],
            [41,86],
            [52,123],
            [56,28],
            [57,26],
            [58,25],
            [59,26],
            [60,88],
            [61,117],
            [62,97],
            [63,120],
            [66,124],
            [68,125],
            [69,126],
            [70,35],
            [71,127],
            [72,127],
            [73,128],
            [74,129],
            [75,27],
            [76,130],
        ];
    }
}

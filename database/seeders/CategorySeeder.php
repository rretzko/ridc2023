<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [10,'concert'],
            [11,'jazz'],
            [12,'pop'],
            [13,'show'],
        ];

        foreach($seeds AS $seed){

            Category::create(
                [
                    'id' => $seed[0],
                    'descr' => $seed[1],
                ],
            );
        }
    }
}

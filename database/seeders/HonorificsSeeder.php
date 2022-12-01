<?php

namespace Database\Seeders;

use App\Models\Honorific;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HonorificsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            1 => 'Dr.',
            2 => 'Mr.',
            3 => 'Mrs.',
            4 => 'Ms.',
            5 => 'Mx.',
            6 => 'Sr.',
        ];

        foreach($seeds AS $id => $descr)
        {
            Honorific::create(
                [
                    'id' => $id,
                    'descr' => $descr,
                ]
            );
        }
    }
}

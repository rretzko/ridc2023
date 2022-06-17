<?php

namespace Database\Seeders;

use App\Models\Pendingemailtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendingEmailTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = ['acceptance','invitation'];

        foreach($seeds AS $descr){

            Pendingemailtype::create(['descr' => $descr]);
        }
    }
}

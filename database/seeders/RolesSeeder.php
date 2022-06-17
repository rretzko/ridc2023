<?php

namespace Database\Seeders;

use App\Models\CurrentEvent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = ['owner','lead teacher','event admin','end user'];

        foreach($seeds AS $descr){

            Role::create(['descr' => $descr]);
        }
    }
}

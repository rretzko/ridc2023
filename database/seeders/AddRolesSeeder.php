<?php

namespace Database\Seeders;

use App\Models\CurrentEvent;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //set DomainOwner
        DB::table('role_user')
            ->insert([
                'role_id' => 1,
                'user_id' => 1,
                'event_id' => 32,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        $event = CurrentEvent::currentEvent();
        $user = User::find(1);
        $user->roles()->sync([1,['event_id' => 32]]);
    }
}

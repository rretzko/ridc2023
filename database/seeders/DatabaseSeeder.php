<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EventsTableSeeder::class);
        $this->call(PendingEmailTypesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(GeostatesTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);


        //$this->call(SchoolUserTableSeeder::class);
        $this->call(EnsembleSeeder::class);
        $this->call(EnsembleSchoolSeeder::class);
    }
}

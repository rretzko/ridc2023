<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('events')->delete();

        \DB::table('events')->insert(array (
            0 =>
            array (
                'id' => 26,
                'title' => 'Roxbury Invitational',
                'subtitle' => '26th Annual',
                'descr' => 'Concert, Show, Jazz and Pop Choir Invitational',
                'open_date' => '2016-01-03',
                'close_date' => '2016-04-01',
                'event_date' => '2016-03-25',
                'start_time' => '09:00:00',
                'end_time' => '23:00:00',
                'ensemble_fee' => '350.00',
                'max_soloists' => 4,
                'max_concert' => 2,
                'max_show' => 2,
            ),
            1 =>
            array (
                'id' => 27,
                'title' => 'Roxbury Invitational',
                'subtitle' => '27th Annual',
                'descr' => 'Concert, Show, Jazz and Pop Choir Invitational',
                'open_date' => '2017-01-03',
                'close_date' => '2017-04-01',
                'event_date' => '2017-03-24',
                'start_time' => '09:00:00',
                'end_time' => '23:00:00',
                'ensemble_fee' => '400.00',
                'max_soloists' => 4,
                'max_concert' => 2,
                'max_show' => 2,
            ),
            2 =>
            array (
                'id' => 28,
                'title' => 'Roxbury Invitational',
                'subtitle' => '28th Annual',
                'descr' => 'Concert, Show, Jazz and Pop Choir Invitational',
                'open_date' => '2018-01-03',
                'close_date' => '2018-04-01',
                'event_date' => '2018-03-23',
                'start_time' => '09:00:00',
                'end_time' => '23:00:00',
                'ensemble_fee' => '400.00',
                'max_soloists' => 4,
                'max_concert' => 2,
                'max_show' => 2,
            ),
            3 =>
            array (
                'id' => 29,
                'title' => 'Roxbury Invitational',
                'subtitle' => '29th Annual',
                'descr' => 'Concert, Show, Jazz and Pop Choir Invitational',
                'open_date' => '2019-01-03',
                'close_date' => '2019-04-01',
                'event_date' => '2019-03-30',
                'start_time' => '09:00:00',
                'end_time' => '23:00:00',
                'ensemble_fee' => '400.00',
                'max_soloists' => 4,
                'max_concert' => 2,
                'max_show' => 2,
            ),
            4 =>
            array (
                'id' => 30,
                'title' => 'Roxbury Invitational',
                'subtitle' => '30th Annual COVID CANCELLED',
                'descr' => 'Concert, Show, Jazz and Pop Choir Invitational',
                'open_date' => '2020-01-03',
                'close_date' => '2020-04-01',
                'event_date' => '2020-03-28',
                'start_time' => '09:00:00',
                'end_time' => '23:00:00',
                'ensemble_fee' => '400.00',
                'max_soloists' => 4,
                'max_concert' => 2,
                'max_show' => 2,
            ),
            5 =>
            array (
                'id' => 31,
                'title' => 'Roxbury Invitational',
                'subtitle' => '30th Annual COVID CANCELLED',
                'descr' => 'Concert, Show, Jazz and Pop Choir Invitational',
                'open_date' => '2021-01-03',
                'close_date' => '2021-04-01',
                'event_date' => '2021-03-27',
                'start_time' => '09:00:00',
                'end_time' => '23:00:00',
                'ensemble_fee' => '400.00',
                'max_soloists' => 4,
                'max_concert' => 2,
                'max_show' => 2,
            ),
            6 =>
            array (
                'id' => 32,
                'title' => 'Roxbury Invitational',
                'subtitle' => '30th Annual',
                'descr' => 'Concert, Show, Jazz and Pop Choir Invitational',
                'open_date' => '2022-01-03',
                'close_date' => '2022-04-01',
                'event_date' => '2022-03-26',
                'start_time' => '09:00:00',
                'end_time' => '23:00:00',
                'ensemble_fee' => '400.00',
                'max_soloists' => 4,
                'max_concert' => 2,
                'max_show' => 2,
            ),
        ));


    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeostatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('geostates')->delete();
        
        \DB::table('geostates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country' => 'US',
                'descr' => 'Alaska',
                'abbr' => 'AK',
            ),
            1 => 
            array (
                'id' => 2,
                'country' => 'US',
                'descr' => 'Alabama',
                'abbr' => 'AL',
            ),
            2 => 
            array (
                'id' => 3,
                'country' => 'US',
                'descr' => 'Arkansas',
                'abbr' => 'AR',
            ),
            3 => 
            array (
                'id' => 4,
                'country' => 'US',
                'descr' => 'American Samoa',
                'abbr' => 'AS',
            ),
            4 => 
            array (
                'id' => 5,
                'country' => 'US',
                'descr' => 'Arizona',
                'abbr' => 'AZ',
            ),
            5 => 
            array (
                'id' => 6,
                'country' => 'US',
                'descr' => 'California',
                'abbr' => 'CA',
            ),
            6 => 
            array (
                'id' => 7,
                'country' => 'US',
                'descr' => 'Colorado',
                'abbr' => 'CO',
            ),
            7 => 
            array (
                'id' => 8,
                'country' => 'US',
                'descr' => 'Connecticut',
                'abbr' => 'CT',
            ),
            8 => 
            array (
                'id' => 9,
                'country' => 'US',
                'descr' => 'District of Columbia',
                'abbr' => 'DC',
            ),
            9 => 
            array (
                'id' => 10,
                'country' => 'US',
                'descr' => 'Delaware',
                'abbr' => 'DE',
            ),
            10 => 
            array (
                'id' => 11,
                'country' => 'US',
                'descr' => 'Florida',
                'abbr' => 'FL',
            ),
            11 => 
            array (
                'id' => 12,
                'country' => 'US',
                'descr' => 'Federated States of Micronesia',
                'abbr' => 'FM',
            ),
            12 => 
            array (
                'id' => 13,
                'country' => 'US',
                'descr' => 'Georgia',
                'abbr' => 'GA',
            ),
            13 => 
            array (
                'id' => 14,
                'country' => 'US',
                'descr' => 'Guam',
                'abbr' => 'GU',
            ),
            14 => 
            array (
                'id' => 15,
                'country' => 'US',
                'descr' => 'Hawaii',
                'abbr' => 'HI',
            ),
            15 => 
            array (
                'id' => 16,
                'country' => 'US',
                'descr' => 'Iowa',
                'abbr' => 'IA',
            ),
            16 => 
            array (
                'id' => 17,
                'country' => 'US',
                'descr' => 'Idaho',
                'abbr' => 'ID',
            ),
            17 => 
            array (
                'id' => 18,
                'country' => 'US',
                'descr' => 'Illinois',
                'abbr' => 'IL',
            ),
            18 => 
            array (
                'id' => 19,
                'country' => 'US',
                'descr' => 'Indiana',
                'abbr' => 'IN',
            ),
            19 => 
            array (
                'id' => 20,
                'country' => 'US',
                'descr' => 'Kansas',
                'abbr' => 'KS',
            ),
            20 => 
            array (
                'id' => 21,
                'country' => 'US',
                'descr' => 'Kentucky',
                'abbr' => 'KY',
            ),
            21 => 
            array (
                'id' => 22,
                'country' => 'US',
                'descr' => 'Louisiana',
                'abbr' => 'LA',
            ),
            22 => 
            array (
                'id' => 23,
                'country' => 'US',
                'descr' => 'Massachusetts',
                'abbr' => 'MA',
            ),
            23 => 
            array (
                'id' => 24,
                'country' => 'US',
                'descr' => 'Maryland',
                'abbr' => 'MD',
            ),
            24 => 
            array (
                'id' => 25,
                'country' => 'US',
                'descr' => 'Maine',
                'abbr' => 'ME',
            ),
            25 => 
            array (
                'id' => 26,
                'country' => 'US',
                'descr' => 'Marshall Islands',
                'abbr' => 'MH',
            ),
            26 => 
            array (
                'id' => 27,
                'country' => 'US',
                'descr' => 'Michigan',
                'abbr' => 'MI',
            ),
            27 => 
            array (
                'id' => 28,
                'country' => 'US',
                'descr' => 'Minnesota',
                'abbr' => 'MN',
            ),
            28 => 
            array (
                'id' => 29,
                'country' => 'US',
                'descr' => 'Missouri',
                'abbr' => 'MO',
            ),
            29 => 
            array (
                'id' => 30,
                'country' => 'US',
                'descr' => 'Northern Mariana Islands',
                'abbr' => 'MP',
            ),
            30 => 
            array (
                'id' => 31,
                'country' => 'US',
                'descr' => 'Mississippi',
                'abbr' => 'MS',
            ),
            31 => 
            array (
                'id' => 32,
                'country' => 'US',
                'descr' => 'Montana',
                'abbr' => 'MT',
            ),
            32 => 
            array (
                'id' => 33,
                'country' => 'US',
                'descr' => 'North Carolina',
                'abbr' => 'NC',
            ),
            33 => 
            array (
                'id' => 34,
                'country' => 'US',
                'descr' => 'North Dakota',
                'abbr' => 'ND',
            ),
            34 => 
            array (
                'id' => 35,
                'country' => 'US',
                'descr' => 'Nebraska',
                'abbr' => 'NE',
            ),
            35 => 
            array (
                'id' => 36,
                'country' => 'US',
                'descr' => 'New Hampshire',
                'abbr' => 'NH',
            ),
            36 => 
            array (
                'id' => 37,
                'country' => 'US',
                'descr' => 'New Jersey',
                'abbr' => 'NJ',
            ),
            37 => 
            array (
                'id' => 38,
                'country' => 'US',
                'descr' => 'New Mexico',
                'abbr' => 'NM',
            ),
            38 => 
            array (
                'id' => 39,
                'country' => 'US',
                'descr' => 'Nevada',
                'abbr' => 'NV',
            ),
            39 => 
            array (
                'id' => 40,
                'country' => 'US',
                'descr' => 'New York',
                'abbr' => 'NY',
            ),
            40 => 
            array (
                'id' => 41,
                'country' => 'US',
                'descr' => 'Ohio',
                'abbr' => 'OH',
            ),
            41 => 
            array (
                'id' => 42,
                'country' => 'US',
                'descr' => 'Oklahoma',
                'abbr' => 'OK',
            ),
            42 => 
            array (
                'id' => 43,
                'country' => 'US',
                'descr' => 'Oregon',
                'abbr' => 'OR',
            ),
            43 => 
            array (
                'id' => 44,
                'country' => 'US',
                'descr' => 'Pennsylvania',
                'abbr' => 'PA',
            ),
            44 => 
            array (
                'id' => 45,
                'country' => 'US',
                'descr' => 'Puerto Rico',
                'abbr' => 'PR',
            ),
            45 => 
            array (
                'id' => 46,
                'country' => 'US',
                'descr' => 'Palau',
                'abbr' => 'PW',
            ),
            46 => 
            array (
                'id' => 47,
                'country' => 'US',
                'descr' => 'Rhode Island',
                'abbr' => 'RI',
            ),
            47 => 
            array (
                'id' => 48,
                'country' => 'US',
                'descr' => 'South Carolina',
                'abbr' => 'SC',
            ),
            48 => 
            array (
                'id' => 49,
                'country' => 'US',
                'descr' => 'South Dakota',
                'abbr' => 'SD',
            ),
            49 => 
            array (
                'id' => 50,
                'country' => 'US',
                'descr' => 'Tennessee',
                'abbr' => 'TN',
            ),
            50 => 
            array (
                'id' => 51,
                'country' => 'US',
                'descr' => 'Texas',
                'abbr' => 'TX',
            ),
            51 => 
            array (
                'id' => 52,
                'country' => 'US',
                'descr' => 'Utah',
                'abbr' => 'UT',
            ),
            52 => 
            array (
                'id' => 53,
                'country' => 'US',
                'descr' => 'Virginia',
                'abbr' => 'VA',
            ),
            53 => 
            array (
                'id' => 54,
                'country' => 'US',
                'descr' => 'Virgin Islands',
                'abbr' => 'VI',
            ),
            54 => 
            array (
                'id' => 55,
                'country' => 'US',
                'descr' => 'Vermont',
                'abbr' => 'VT',
            ),
            55 => 
            array (
                'id' => 56,
                'country' => 'US',
                'descr' => 'Washington',
                'abbr' => 'WA',
            ),
            56 => 
            array (
                'id' => 57,
                'country' => 'US',
                'descr' => 'Wisconsin',
                'abbr' => 'WI',
            ),
            57 => 
            array (
                'id' => 58,
                'country' => 'US',
                'descr' => 'West Virginia',
                'abbr' => 'WV',
            ),
            58 => 
            array (
                'id' => 59,
                'country' => 'US',
                'descr' => 'Wyoming',
                'abbr' => 'WY',
            ),
        ));
        
        
    }
}
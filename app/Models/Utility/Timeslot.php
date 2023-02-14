<?php

namespace App\Models\Utility;



use Carbon\Carbon;
use Illuminate\Support\Collection;

class Timeslot
{
    private $finish;
    private $minuteInterval;
    private $start;
    private $timeslots=[];

    /**
     * @param string $start //ex. '2023-03-25 09:00:00'
     * @param string $finish //ex. '2023-03-25 17:00:00'
     * @param int $minuteInterval //ex. 20 (minutes)
     */
    public function __construct(string $start, string $finish, int $minuteInterval)
    {
        $this->finish = $finish;
        $this->minuteInterval = $minuteInterval;
        $this->start = $start;
    }

    public function timeslots(): array
    {
        return $this->times();
    }
/** END OF PUBLIC FUNCTIONS =================================================*/

    /**
     * Return collection of Carbon objects from $start to $finish in $duration increments
     * @return \FontLib\TrueType\Collection
     */
    private function times(): array
    {
        $duration = ($this->minuteInterval * 60); //20 minutes
        $start = Carbon::parse($this->start,'America/New_York');
        $finish = Carbon::parse($this->finish,'America/New_York');
        $diff = ($finish->diffInSeconds($start));
        $intervals = ($diff / $duration);

        $times = [];

        for($i=0; $i<=$intervals; $i++){

            $newTime = (Carbon::parse($start)->addSeconds($duration * $i));

            //setting origin key to 1 to avoid downstream conflicts of a 0-value
            $times[$i + 1] =
                [
                    'dateTime' => $newTime->format('Y-m-d G:i:s'),
                    'time' => $newTime->format('g:i a'),
                ];
        }

        return $times;
    }

}

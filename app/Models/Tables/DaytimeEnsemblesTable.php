<?php

namespace App\Models\Tables;


use App\Models\CurrentEvent;
use App\Models\EventEnsemble;
use App\Models\Utility\Timeslot;
use Carbon\Carbon;

class DaytimeEnsemblesTable
{
    private $category='Break';
    private $ensembleCenter = '';
    private $ensembleName='Break';
    private $eventEnsembles;
    private $minuteInterval=20;
    private $schoolCenter = '';
    private $schoolName='Break';
    private $shaded = '';
    private $table='';
    private $timslots=[];

    /**
     * @param string $start //ex. '2023-03-25 09:00:00'
     * @param string $finish //ex. '2023-03-25 17:00:00'
     * @param integer $duration //ex. 20 (minutes)
     */
    public function __construct(string $start, string $finish, int $duration)
    {
        //collection eventEnsembles with assigned timeslots
        $this->eventEnsembles = EventEnsemble::where('event_id', CurrentEvent::currentEvent()->id)
            ->whereNotNull('timeslot')
            ->join('ensembles','event_ensembles.ensemble_id','=','ensembles.id')
            ->join('schools','event_ensembles.school_id','=','schools.id')
            ->join('categories', 'ensembles.category_id', '=', 'categories.id')
            ->orderBy('timeslot')
            ->get();

        $this->minuteInterval = $duration;

        //array of timeslots from $start to $finish by $this->minuteInterval
        $timeslot = new Timeslot($start, $finish, $this->minuteInterval);
        $this->timeslots = $timeslot->timeslots();

        //create table
        $this->init();
    }

    public function table(): string
    {
        return $this->table;
    }
/** =========================================================================*/

    /*
     * $timeslot = array:2 [▼
     *     "dateTime" => "2023-03-25 9:00:00"
     *     "time" => "9:00 am"
     *   ]
     */
    private function ensembleDetails(array $timeslot): void
    {
        $ensemble = $this->eventEnsembles->where('timeslot', Carbon::parse($timeslot['dateTime']))->first();

        if($ensemble){
            $this->ensembleName = $ensemble->ensemble_name;
            $this->schoolName = $ensemble->school_name;
            $this->category = $ensemble->descr;

            $this->categoryCenter = '';
            $this->ensembleCenter = '';
            $this->schoolCenter = '';

            $this->shaded = '';

        }else{
            $this->resetDefaults();
        }
    }

    private function headers(): string
    {
        $str = '<tr>';
        $str .= '<th>###</th>';
        $str .= '<th>Timeslot</th>';
        $str .= '<th>School</th>';
        $str .= '<th>Ensemble</th>';
        $str .= '<th>Category</th>';
        $str .= '</tr>';

        return $str;
    }

    private function init(): void
    {
        $this->table = $this->styles();
        $this->table .= '<table>';
        $this->table .= $this->headers();
        $this->table .= $this->rows();
        $this->table .= '</table>';
    }

    private function resetDefaults(): void
    {
        $this->ensembleName = 'Break';
        $this->schoolName = 'Break';
        $this->category = 'Break';

        $this->ensembleCenter = 'center';
        $this->schoolCenter = 'center';

        $this->shaded = 'shaded';
    }

    private function rows(): string
    {
        $str = '';

        foreach($this->timeslots AS $key => $timeslot){

            $this->ensembleDetails($timeslot);

            $str .= '<tr class="' . $this->shaded . '">';

            $str .= '<td class="center">' . $key . '</td>';
            $str .= '<td>' . $timeslot['time'] . '</td>';
            $str .= '<td class="' . $this->schoolCenter . '">' . $this->schoolName . '</td>';
            $str .= '<td class="' . $this->ensembleCenter . '">' . $this->ensembleName . '</td>';
            $str .= '<td class="center">'. $this->category .'</td>';

            $str .= '</tr>';
        }

        return $str;
    }

    private function styles(): string
    {
        $str = '<style>';
        $str .= 'table{border-collapse: collapse;margin:0 auto; margin-bottom: 1rem;}';
        $str .= 'td,th{border: 1px solid black; padding:0 0.25rem;}';
        $str .= '.center{text-align: center;}';
        $str .= '.shaded{background-color: rgba(0,0,0,0.03);}';
        $str .= '</style>';

        return $str;
    }

}

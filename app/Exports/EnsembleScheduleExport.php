<?php

namespace App\Exports;

use App\Models\CurrentEvent;
use App\Models\EventEnsemble;
use App\Models\Utility\Timeslot;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnsembleScheduleExport implements FromArray, WithHeadings, WithMapping
{
    private $category='Break';
    private $ensembleName='Break';
    private $ensembles;
    private $eventEnsembles;
    private $minuteInterval=20;
    private $schoolName='Break';
    private $timeslots;

    public function __construct($start, $finish)
    {
        //collection eventEnsembles with assigned timeslots
        $this->eventEnsembles = EventEnsemble::where('event_id', CurrentEvent::currentEvent()->id)
            ->whereNotNull('timeslot')
            ->join('ensembles','event_ensembles.ensemble_id','=','ensembles.id')
            ->join('schools','event_ensembles.school_id','=','schools.id')
            ->join('categories', 'ensembles.category_id', '=', 'categories.id')
            ->orderBy('timeslot')
            ->get();

        //array of timeslots from $start to $finish by $this->minuteInterval
        $timeslot = new Timeslot($start, $finish, $this->minuteInterval);
        $this->timeslots = $timeslot->timeslots();
    }

    public function array(): array
    {
        $a = [];

        foreach($this->timeslots AS $key => $timeslot){

            $this->ensembleDetails($timeslot);

            $a[$key]['###'] = $key;
            $a[$key]['timeslot'] = $timeslot['time'];
            $a[$key]['school'] = $this->schoolName;
            $a[$key]['ensemble'] = $this->ensembleName;
            $a[$key]['category'] = $this->category;
        }

        return $a;
    }

    public function headings(): array
    {
        return [
          '###',
          'Timeslot',
          'School',
          'Ensemble',
          'Category',
        ];
    }

    public function map($row): array
    {
        return [
          $row['###'],
          $row['timeslot'],
          $row['school'],
          $row['ensemble'],
          $row['category'],
        ];
    }

    /*
     * $timeslot = array:2 [▼
     *     "dateTime" => "2023-03-25 9:00:00"
     *     "time" => "9:00 am"
     *   ]
     */
    private function ensembleDetails(array $timeslot): void
    {
        $ensemble = $this->eventEnsembles->where('timeslot', Carbon::parse($timeslot['dateTime']))->first();

        if ($ensemble) {
            $this->ensembleName = $ensemble->ensemble_name;
            $this->schoolName = $ensemble->school_name;
            $this->category = $ensemble->descr;

            $this->categoryCenter = '';
            $this->ensembleCenter = '';
            $this->schoolCenter = '';

            $this->shaded = '';

        } else {
            $this->resetDefaults();
        }
    }

    private function resetDefaults(): void
    {
        $this->ensembleName = 'Break';
        $this->schoolName = 'Break';
        $this->category = 'Break';


    }
}

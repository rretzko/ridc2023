<?php

namespace App\Exports;

use App\Models\CurrentEvent;
use App\Models\EventEnsemble;
use App\Models\Soloist;
use App\Models\Utility\Timeslot;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SoloistScheduleExport implements FromArray, WithHeadings, WithMapping
{
    private $category='Break';
    private $soloistComposer='';
    private $soloistName='Break';
    private $soloists;
    private $soloistTitle='';
    private $minuteInterval=8;
    private $schoolName='Break';
    private $timeslots;

    public function __construct($start, $finish)
    {
        //collection soloists with assigned timeslots
        $this->soloists = Soloist::where('event_id', CurrentEvent::currentEvent()->id)
            ->whereNotNull('timeslot')
            ->join('students','soloists.student_id','=','students.id')
            ->join('schools','soloists.school_id','=','schools.id')
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

            $this->soloistDetails($timeslot);

            $a[$key]['###'] = $key;
            $a[$key]['timeslot'] = $timeslot['time'];
            $a[$key]['school'] = $this->schoolName;
            $a[$key]['ensemble'] = $this->soloistName;
            $a[$key]['title'] = $this->soloistTitle;
            $a[$key]['composer'] = $this->soloistComposer;
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
          'Soloist',
          'Title',
          'Composer',
          'Category',
        ];
    }

    public function map($row): array
    {
        return [
          $row['###'],
          $row['timeslot'],
          $row['school'],
          $row['ensemble'], //soloist's name
          $row['title'],
          $row['composer'],
          $row['category'],
        ];
    }

    /*
     * $timeslot = array:2 [▼
     *     "dateTime" => "2023-03-25 9:00:00"
     *     "time" => "9:00 am"
     *   ]
     */
    private function soloistDetails(array $timeslot): void
    {
        $soloist = $this->soloists->where('timeslot', Carbon::parse($timeslot['dateTime']))->first();

        if ($soloist) {
            $this->soloistName = $soloist->fullNameAlpha;
            $this->schoolName = $soloist->schoolName;
            $this->category = $soloist->concert ? 'concert' : 'jazz/pop/show';
            $this->soloistTitle = $soloist->title;
            $this->soloistComposer = $soloist->composer;

            $this->categoryCenter = '';
            $this->soloistCenter = '';
            $this->schoolCenter = '';

            $this->shaded = '';

        } else {
            $this->resetDefaults();
        }
    }

    private function resetDefaults(): void
    {
        $this->soloistComposer = 'Break';
        $this->soloistName = 'Break';
        $this->soloistTitle = 'Break';
        $this->schoolName = 'Break';
        $this->category = 'Break';


    }
}

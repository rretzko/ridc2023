<?php

namespace App\Exports;

use App\Models\Accepted;
use App\Models\CurrentEvent;
use App\Models\Event;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AcceptedStatusExport implements FromCollection, WithMapping, WithHeadings
{
    private $rows;

    public function __construct()
    {
        $roxbury = [1,91,92,93]; //Retzko, Hachey, Salyerds, Sweer

        $this->rows = Accepted::where('event_id', CurrentEvent::currentEvent()->id)
            ->whereNotIn('user_id', $roxbury) //roxbury directors
            ->get()
            ->sortBy('user.last');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            'director',
            'school',
            'colors',
            'arrival',
            'hotel',
            'adult #',
            'student #',
            'soloist #',
            'ensemble 1',
            'ensbl 1 cat',
            'ensbl 1 rep',
            'ensbl 1 set-up',
            'ensemble 2',
            'ensbl 2 cat',
            'ensbl 2 rep',
            'ensbl 2 set-up',
            'ensemble 3',
            'ensbl 3 cat',
            'ensbl 3 rep',
            'ensbl 3 set-up',
        ];
    }

    public function map($row): array
    {
        $director = User::find($row['user_id']);
        $school = $director->school();
        $event = Event::find('event_id');
        $ensembleCount = $row['ensemble_count'];

        $stats = [
            $director->nameAlpha,
            $school->school_name,
            $school->schoolColorsCsv,
            $school->eta,
            $school->accomodation,
            $school->attendingAdults,
            $school->countStudents,
            $school->countSoloists,
        ];

        return array_merge($stats, $this->ensembles($school->acceptedEnsembles));
    }

    /**
     * @param Collection $ensembles
     * @return array|string
     */
    private function ensembles(Collection $ensembles): array
    {
        $a = [];

        foreach($ensembles AS $key => $ensemble){

            $a[] = $ensemble->ensemble_name;
            $a[] = $ensemble->category->descr;
            $a[] = $ensemble->countRepertoire;
            $a[] = ($ensemble->hasSetup) ? 'Yes' : 'No';
        }

        return $a;
    }
}

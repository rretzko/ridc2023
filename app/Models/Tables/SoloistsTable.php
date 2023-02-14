<?php

namespace App\Models\Tables;


use App\Models\CurrentEvent;
use App\Models\EventEnsemble;
use App\Models\Soloist;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SoloistsTable
{
    private $event, $eventId, $table;

    public function __construct()
    {
        $this->event = CurrentEvent::currentEvent();
        $this->eventId = $this->event->id;
        $this->table = '';

        $this->init();
    }

    public function table(): string
    {
        return $this->table;
    }

    /** END OF PUBLIC FUNCTION  =================================================*/

    /**
     * Return the first EVENTENSEMBLE timeslot found for the current event with $school_id
     * @param int $school_id
     * @return string
     */
    private function firstTimeSlot(int $school_id): string
    {
        $eventEnsembles = EventEnsemble::where('school_id', $school_id)
            ->whereNotNull('timeslot')
            ->orderBy('timeslot')
            ->get();

        return ($eventEnsembles->count())
            ? Carbon::parse($eventEnsembles->first()->timeslot)->format('g:i a')
            : 'none';
    }

    private function init(): void
    {
        $soloists = Soloist::where('event_id', $this->eventId)->get();

        $this->table = $this->tableStyle();
        $this->table .= $this->tableStart();
        $this->table .= $this->tableHeader();
        $this->table .= $this->tableRows($soloists);
        $this->table .= $this->tableEnd();
    }

    private function tableEnd(): string
    {
        return '</table>';
    }

    private function tableHeader(): string
    {
        return '<tr>
            <th>###</th>
            <th>School</th>
            <th>Name</th>
            <th>Category</th>
            <th>PerfTime</th>
            </tr>';
    }

    private function tableRows(Collection $soloists): string
    {
        $str = '';

        if($soloists->count()) {

            foreach ($soloists as $key => $soloist) {

                $timeslot = $soloist->timeslot ? Carbon::parse($soloist->timeslot)->format('g:i a') : 'tbd';

                $str .= '<tr>';
                $str .= '<td>' . ($key + 1) . '</td>';
                $str .= '<td>' . $soloist->schoolName . ' (' . $this->firstTimeSlot($soloist->school_id). ')</td>';
                $str .= '<td>' . $soloist->fullName . '</td>';
                $str .= '<td style="text-align: center;">' . $soloist->category . '</td>';
                $str .= '<td style="text-align: center;">' . $timeslot . '</td>';
                $str .= '</tr>';
            }
        }else{

            $str .= '<tr><td colspan="5" style="text-align: center;" >No soloists found...</td>';
        }

        return $str;
    }

    private function tableStart(): string
    {
        return '<table>';
    }

    private function tableStyle(): string
    {
        $str = '<style>';
        $str .= 'table{margin: 1rem auto;}';
        $str .= 'td,th{border: 1px solid black; padding: 0 .25rem;}';
        $str .= '</style>';

        return $str;
    }
}

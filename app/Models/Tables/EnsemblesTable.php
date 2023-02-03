<?php

namespace App\Models\Tables;

use App\Models\CurrentEvent;
use App\Models\EventEnsemble;
use Illuminate\Support\Collection;

class EnsemblesTable
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

    private function init(): void
    {
        $eventEnsembles = EventEnsemble::ensembles();

        $this->table = $this->tableStyle();
        $this->table .= $this->tableStart();
        $this->table .= $this->tableHeader();
        $this->table .= $this->tableRows($eventEnsembles);
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

    private function tableRows(Collection $eventEnsembles): string
    {
        $str = '';

        if($eventEnsembles->count()) {

            foreach ($eventEnsembles as $key => $ensemble) {

                $str .= '<tr>';
                $str .= '<td>' . ($key + 1) . '</td>';
                $str .= '<td>' . $ensemble->schoolName . '</td>';
                $str .= '<td>' . $ensemble->ensembleName . '</td>';
                $str .= '<td style="text-align: center;" >' . $ensemble->ensemble->category->descr .' </td>';
                $str .= '<td style="text-align: center;" >tbd</td>';
                $str .= '</tr>';
            }
        }else{

            $str .= '<tr><td colspan="5">No ensembles found...</td></tr>';
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

<?php

namespace App\Models\Tables;

use App\Models\Accepted;
use App\Models\CurrentEvent;
use App\Models\EventEnsemble;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class StatusTable
{
    private string $table='';

    public function __construct()
    {
        $this->init();
    }

    public function table(): string
    {
        return $this->table;
    }

/** END OF PUBLIC FUNCTION  =================================================*/

    private function buildEnsembles(Collection $ensembles): string
    {
        $str = '<div>';

        foreach($ensembles AS $key => $ensemble){

            /*
             * If there are multiple ensembles add shading to odd-numbered ensembles
             */
            $borderBottom = ($ensembles->count() > 1) ? 'border-bottom: 1px solid black;' : '';
            $shading = '';//(($ensembles->count() > 1) && (!($key % 2))) ? 'bg-gray-100' : '';
            $setup = ($ensemble->hasSetup) ? 'Yes' : 'No';

            $str .= '<div class="'. $shading . '" style="' . $borderBottom . '">'
                . '<b>' . $ensemble->ensemble_name . '</b>'
                . ' ('
                . $ensemble->category->descr
                . ')'
                    //Repertoire
                    . '<div class="ml-12 text-mid">'
                        . 'Rep: ' . $ensemble->countRepertoire
                    . '</div>'
                    //Setup
                    . '<div class="ml-12 text-mid">'
                        . 'Set-Up: ' . $setup
                    . '</div>'
                . '</div>';
        }

        $str .= '</div>';

        return $str;
    }

    private function init(): void
    {
        $roxbury = [1,91,92,93]; //Retzko, Hachey, Salyerds, Sweer

        $rows = Accepted::where('event_id', CurrentEvent::currentEvent()->id)
            ->whereNotIn('user_id', $roxbury)
            ->get()
            ->sortBy('user.last');

        $this->table = $this->tableStyle();
        $this->table .= $this->tableStart();
        $this->table .= $this->tableHeader();
        $this->table .= $this->tableRows($rows);
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
            <th>Director</th>
            <th>School/Tickets</th>
            <th>Students</th>
            <th>Ensembles (Desc/Rep/Setup)</th>
            <th>Soloists</th>
            </tr>';
    }

    private function tableRows(Collection $rows): string
    {
        $str = '';

        if($rows->count()) {

            foreach ($rows as $key => $accepted) {

                $shaded = (!($key % 2)) ? 'bg-gray-100' : '';

                $school = $accepted->user->school();

                $str .= '<tr class="' . $shaded . '">';
                    $str .= '<td>' . ($key + 1) . '</td>';
                    $str .= '<td>' . $accepted->user->last . '</td>';
                    $str .= '<td>' . $school->school_name
                        . '<br />'
                        . 'Arrival ETA: ' . $school->eta
                        . '<br />'
                        . '<span style="font-size: 0.8rem">( as of: '
                            . $school->etaUpdatedDateFormatted
                        . ')</span>'
                        . '</td>';
                    $str .= '<td style="text-align: center;" >' . $school->countStudents . '</td>';
                    $str .= '<td>' . $this->buildEnsembles($school->acceptedEnsembles) . '</td>';
                    $str .= '<td style="text-align: center;" >' . $school->countSoloists . '</td>';
                $str .= '</tr>';
            }
        }else{

            $str .= '<tr><td colspan="5" style="text-align: center;">No ensembles found...</td></tr>';
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
        $str .= '.concert{background-color: rgba(0,255,0,.1)}';
        $str .= '</style>';

        return $str;
    }

}

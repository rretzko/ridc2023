<?php

namespace App\Services;

use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EventEnsemble;
use Illuminate\Support\Collection;

class EnsemblesTxtService
{
    private $txt;

    public function __construct()
    {
        //initialize
        $this->txt = '';

        $this->init();
    }

    public function txt(): string
    {
        return $this->txt;
    }

/** ************************************************************************* */

    private function artists($rep): string
    {
        $artists = [];

        if(! is_null($rep->composer)){ $artists[] = $rep->composer; }

        if(! is_null($rep->arranger)){ $artists[] = 'arr. '.$rep->arranger; }

        if(! is_null($rep->lyricist)){ $artists[] = 'lyr. '.$rep->lyricist; }

        if(! is_null($rep->choreographer)){ $artists[] = 'chor. '.$rep->choreographer; }

        return (count($artists))
            ? implode(', ', $artists)
            : 'no artist found';
    }

    private function buildFile(Collection $ensembles): void
    {
        $return = "\n";
        $tab = "\t";

        foreach($ensembles AS $ensemble) { //array

            $directedBy = $ensemble->directed_by ?? 'none found';
            $schoolString = $ensemble->city . ', ' . $ensemble->abbr . ' - ' . $ensemble->student_body . ' students';
            $eventEnsemble = EventEnsemble::find($ensemble->id);
            $repertoire = $eventEnsemble->repertoire;

            $this->txt .= $ensemble->ensemble_name . ' (' . $ensemble->descr . ')' . $return;
            $this->txt .= $tab . $directedBy . $return;
            $this->txt .= $tab . $tab . $ensemble->school_name . $return;
            $this->txt .= $tab . $tab . $tab . $schoolString . $return;

            if($repertoire->count()) {

                foreach ($repertoire as $rep) {

                    $this->txt .= $tab . $tab . $tab . $tab . $rep->title . $return;
                    $this->txt .= $tab . $tab . $tab . $tab . $tab . $this->artists($rep) . $return;
                    $this->txt .= $tab . $tab . $tab . $tab . $tab . $tab . $this->programNotes($rep) . $return;
                }

            }else{

                $this->txt .= $tab . $tab . $tab . $tab . 'no rep found' . $return;
            }
            $this->txt .= $tab . $tab . $tab . $tab . $tab . $tab . $tab . $ensemble->ensembleDescr . $return;

            $this->txt .= $return;
        }
    }

    private function init(): void
    {
        //ensembles in performance order
        $ensembles = EventEnsemble::ensemblesByTimeslots();

        $this->buildFile($ensembles);
    }

    private function programNotes($rep): string
    {
        return (is_null($rep->notes))
            ? 'no program notes'
            : $rep->notes;
    }
}

<?php

namespace App\Http\Livewire\Admin\Schedules\Ensembles;

use App\Models\CurrentEvent;
use App\Models\Ensemble;
use App\Models\EnsembleTimeslot;
use App\Models\EventEnsemble;
use App\Models\Tables\EnsemblesTable;
use Carbon\Carbon;
use FontLib\TrueType\Collection;
use Livewire\Component;

class EnsembleComponent extends Component
{
    public $eventEnsembleId=0;
    public $eventEnsembles;
    public $flashMessage='';
    public $table='';
    public $times;
    public $timeValue;

    protected $rules =
        [
            'eventEnsembleId' => ['required','integer','min:1','exists:event_ensembles,id'],
            'timeValue' => ['required','integer','min:1','max:30'],
        ];

    public function mount()
    {
        $this->eventEnsembles = $this->eventEnsembles();

        $this->table = $this->table();

        $this->times = $this->times();
    }

    public function render()
    {
        return view('livewire..admin.schedules.ensembles.ensemble-component');
    }

    public function store()
    {
        $this->reset('flashMessage');

        $this->validate();

        EventEnsemble::where('id', $this->eventEnsembleId)
            ->update(['timeslot' => $this->times[$this->timeValue]['dateTime'] ]);

        $eventEnsemble = EventEnsemble::find($this->eventEnsembleId);

        $this->flashMessage = $eventEnsemble->schoolName.' has been updated';

        $this->table = $this->table();

        $this->reset('eventEnsembleId','timeValue');
    }

    public function updated()
    {
        $this->reset('flashMessage');
    }

    private function eventEnsembles()
    {
        return EventEnsemble::ensemblesByTimeslots();
    }

    private function table(): string
    {
        $table = new EnsemblesTable;

        return $table->table();
    }

    /**
     * Return collection of Carbon objects from $start to $finish in $duration increments
     * @return Collection
     */
    private function times(): array
    {
        $duration = (20 * 60); //20 minutes
        //start time is set earlier than realistic to ensure that a '0' value in <select> can be tested as invalid
        $start = Carbon::create(2023,3,25,7,40,0,'America/New_York');
        $finish = Carbon::create(2023,3,25,17,0,0,'America/New_York');
        $diff = ($finish->diffInSeconds($start));
        $intervals = ($diff / $duration);

        $times = [];

        for($i=1; $i<=$intervals; $i++){

            $newTime = (Carbon::parse($start)->addSeconds($duration * $i));

            $times[$i] =
                [
                    'dateTime' => $newTime->format('Y-m-d G:i:s'),
                    'time' => $newTime->format('g:i a'),
                ];
        }

        return $times;
    }
}

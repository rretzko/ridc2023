<?php

namespace App\Http\Livewire\Admin\Schedules\Soloists;

use App\Models\Soloist;
use App\Models\Tables\SoloistsTable;
use Carbon\Carbon;
use Livewire\Component;

class SoloistComponent extends Component
{
    public $soloistId=0;
    public $soloists;
    public $flashMessage='';
    public $table='';
    public $times;
    public $timeValue;

    protected $rules =
        [
            'soloistId' => ['required','integer','min:1','exists:soloists,id'],
            'timeValue' => ['required','integer','min:1','max:30'],
        ];

    public function mount()
    {
        $this->soloists = $this->soloists();

        $this->table = $this->table();

        $this->times = $this->times();
    }

    public function render()
    {
        return view('livewire..admin.schedules.soloists.soloist-component');
    }

    public function store()
    {
        $this->reset('flashMessage');

        $this->validate();

        Soloist::where('id', $this->soloistId)
            ->update(['timeslot' => $this->times[$this->timeValue]['dateTime'] ]);

        $soloist = Soloist::find($this->soloistId);

        $this->flashMessage = $soloist->fullNameAlpha.' has been updated';

        $this->table = $this->table();

        $this->reset('soloistId','timeValue');
    }

    public function updated()
    {
        $this->reset('flashMessage');
    }

    private function soloists()
    {
        return Soloist::soloistsBySchoolAlphaName();
    }

    private function table(): string
    {
        $table = new SoloistsTable;

        return $table->table();
    }

    /**
     * Return collection of Carbon objects from $start to $finish in $duration increments
     * @return Collection
     */
    private function times(): array
    {
        $duration = (8 * 60); //20 minutes
        //start time is set earlier than realistic to ensure that a '0' value in <select> can be tested as invalid
        $start = Carbon::create(2023,3,25,9,00,0,'America/New_York');
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

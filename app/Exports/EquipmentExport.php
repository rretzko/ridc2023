<?php

namespace App\Exports;

use App\Models\CurrentEvent;
use App\Models\Setup;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EquipmentExport implements FromCollection, WithMapping, WithHeadings
{
    private $setups;

    public function __construct()
    {
        $this->setups = Setup::where('event_id', CurrentEvent::currentEvent()->id)
            ->whereNotIn('ensemble_id', [1,2]) //Nonesuch, Cinnamins test ensembles
            ->get();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->setups;
    }

    public function headings(): array
    {
        return [
            'school',
            'ensemble',
            'director',
            'category',
            'piano',
            'amp',
            'drumset',
            'accompaniment',
            'band_award',
            'platform',
            'microphone',
            'instructions',
            'instrumentation',
            'props',
        ];
    }

    public function map($row): array
    {
        $setup = Setup::find($row['id']);

        if($setup->ensembleName === 'A cappella Ensemble'){ dd($setup);}
        return [
            $setup->schoolName,
            $setup->ensembleName,
            $setup->director,
            $setup->categoryDescr,
            $setup->piano ? 'yes' : 'no',
            $setup->amp ? 'yes' : 'no',
            $setup->drumset ? 'yes' : 'no',
            $setup->accompaniment,
            $setup->band_award,
            $setup->platform,
            $setup->microphone,
            $setup->instructions,
            $setup->instrumentation,
            $setup->props,
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\CurrentEvent;
use App\Models\School;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentRosterExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Exclude sample student in FJR Music Academy (school_id = 120)
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $currentEventId = CurrentEvent::currentEvent()->id;
        $eventYear = CurrentEvent::seniorYear();

        $ids = DB::table("students")
            ->join('ensemble_school', 'students.school_id', '=', 'ensemble_school.school_id')
            ->join('ensembles', 'ensemble_school.ensemble_id', '=', 'ensembles.id')
            ->join('event_ensembles', 'ensembles.id', '=', 'event_ensembles.ensemble_id')
            ->where('event_ensembles.event_id', $currentEventId)
            ->where('students.class_of', '>=', $eventYear)
            ->where('ensemble_school.school_id', '!=', 120) //FJR Academy
            ->distinct()
            ->select("students.id")
            ->pluck("students.id")
            ->toArray();

        return Student::whereIn('id', $ids)
            ->get()
            ->sortBy(['schoolName','fullNameAlpha']);
    }

    public function headings(): array
    {
        return [
            'id',
            'school',
            'first',
            'last',
            'middle',
            'classOf',
            'grade',
        ];
    }

    public function map($row): array
    {
        //early exit for sample students
        //if($row->school_id == 120){ return [];} //FJR Academy of Music

        return [
            $row->id,
            $row->schoolName,
            $row->first,
            $row->last,
            $row->middle,
            $row->class_of,
            $row->grade,
        ];
    }
}

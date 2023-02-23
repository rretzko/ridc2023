<?php

namespace App\Exports;

use App\Models\School;
use App\Models\Student;
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
        return Student::whereNot('school_id', 120)
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

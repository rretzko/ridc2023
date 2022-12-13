<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Utility\ClassOf;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel,WithHeadingRow
{
    private $school_id;

    public function __construct()
    {
        $this->school_id = auth()->user()->school()->id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'school_id' => $this->school_id,
            'first' => $row['first'],
            'middle' => $row['middle'],
            'last' => $row['last'],
            'class_of' => ClassOf::classOf($row['classgrade']),
        ]);
    }
}

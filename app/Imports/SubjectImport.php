<?php

namespace App\Imports;

use App\Models\subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new subject([
            'subject_code'=> $row['subject_code'],
            'subject_name'=> $row['subject_name'],
            'subject_credithr'=> $row['subject_credithr'],
            'subject_category'=> $row['subject_category'],
            'subject_prerequisite'=> $row['subject_prerequisite'],
            'subject_semester'=> $row['subject_semester'],
            'subject_year'=> $row['subject_year'],
        ]);
    }
}

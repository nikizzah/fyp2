<?php

namespace App\Imports;

use App\Models\advisee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdviseeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new advisee([
            'advisee_id'=> $row['advisee_id'],
            'advisee_fname'=> $row['advisee_fname'],
            'advisee_address'=> $row['advisee_address'],
            'advisee_town'=> $row['advisee_town'],
            'advisee_state'=> $row['advisee_state'],
            'advisee_postcode'=> $row['advisee_postcode'],
            'advisee_email'=> $row['advisee_email'],
            'advisee_contact'=> $row['advisee_contact'],
            'advisee_cgpa'=> $row['advisee_cgpa'],
            //'advisee_contact'=> $row['advisee_contact'],
            //'advisee_contact'=> $row['advisee_contact'],
        ]);
    }
}

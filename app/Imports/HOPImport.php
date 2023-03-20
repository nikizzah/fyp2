<?php

namespace App\Imports;

use App\Models\hop;
use Maatwebsite\Excel\Concerns\ToModel;

class HOPImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new hop([
            //
        ]);
    }
}

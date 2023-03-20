<?php

namespace App\Imports;

use App\Models\advisor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdvisorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new advisor([
            'advisor_id'=> $row['advisor_id'],
            'advisor_name'=> $row['advisor_name'],
            'advisor_ext'=> $row['advisor_ext'],
            'advisor_email'=> $row['advisor_email'],
            'advisor_quota'=> $row['advisor_quota'],
            'advisor_position'=> $row['advisor_position'],
        ]);
    }
}

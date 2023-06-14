<?php

namespace App\Imports;

use App\Models\advisee;
use App\Models\subject;
use App\Models\CourseStructure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class AdviseeImport implements ToModel, WithHeadingRow
{
    private $intakeId;
    private $importedAdvisees = [];

    public function __construct($intakeId)
    {
        $this->intakeId = $intakeId;
    }

    public function model(array $row)
    {
        $advisee = advisee::create([
            'advisee_id' => $row['advisee_id'],
            'advisee_password' => Hash::make($row['advisee_password']),
            'advisee_fname' => $row['advisee_fname'],
            'advisee_address' => $row['advisee_address'],
            'advisee_town' => $row['advisee_town'],
            'advisee_state' => $row['advisee_state'],
            'advisee_postcode' => $row['advisee_postcode'],
            'advisee_email' => $row['advisee_email'],
            'advisee_contact' => $row['advisee_contact'],
            'advisee_cgpa' => $row['advisee_cgpa'],
            'advisee_calculateCGPA' => $row['advisee_calculateCGPA'] ?? null,
            'cs_id' => $this->intakeId,
        ]);

        $this->importedAdvisees[] = $row['advisee_id'];
        
        return $advisee;
    }

    public function getImportedAdvisees()
    {
        return $this->importedAdvisees;
    }
}

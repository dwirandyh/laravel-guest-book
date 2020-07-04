<?php

namespace App\Imports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\ToModel;

class GuestImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Guest([
            'name'  => $row[0],
            'email'  => $row[1],
            'identity'  => $row[2],
            'identity_id'  => $row[3],
            'phone_number'  => $row[4],
            'intended_person'  => $row[5],
            'relation'  => $row[6],
            'purpose'  => $row[7],
            'estimated_time'  => 0,
            'created_at' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]),
            'checkout'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
        ]);
    }
}

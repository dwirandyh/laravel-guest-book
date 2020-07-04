<?php

namespace App\Imports;

use App\Models\CompanyGuest;
use Maatwebsite\Excel\Concerns\ToModel;

class CompanyGuestImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CompanyGuest(
            [
                'name'  => $row[0],
                'email'  => $row[1],
                'identity'  => $row[2],
                'identity_id'  => $row[3],
                'phone_number'  => $row[4],
                'company'  => $row[5],
                'role'  => $row[6],
                'intended_person'  => $row[7],
                'relation'  => $row[8],
                'purpose'  => $row[9],
                'estimated_time'  => 0,
                'created_at' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]),
                'checkout'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]),
            ]
        );
    }
}

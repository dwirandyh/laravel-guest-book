<?php

namespace App\Exports;

use App\Models\CompanyGuest;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompanyGuestExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return CompanyGuest::all(['name', 'email', 'identity', 'identity_id', 'phone_number', 'company', 'role', 'intended_person', 'relation', 'purpose', 'created_at', 'checkout']);
    }
}

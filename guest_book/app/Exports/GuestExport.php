<?php

namespace App\Exports;

use App\Models\Guest;


class GuestExport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Guest::all([
            'name', 'email', 'identity', 'identity_id', 'phone_number', 'intended_person', 'relation', 'purpose', 'created_at', 'checkout'
        ]);
    }
}

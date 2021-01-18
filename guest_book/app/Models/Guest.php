<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name', 'email', 'identity', 'identity_id', 'identity_file', 'photo_file', 'swab_file', 'phone_number', 'intended_person', 'relation', 'purpose', 'estimated_time', 'checkout', 'visit_date'
    ];
}

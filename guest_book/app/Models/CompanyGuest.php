<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyGuest extends Model
{
    protected $fillable = [
        'name', 'is_leader', 'email', 'identity', 'identity_id', 'identity_file', 'photo_file', 'phone_number', 'company', 'role', 'intended_person', 'relation', 'purpose', 'estimated_time', 'checkout'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name', 'identity', 'identity_id', 'email', 'phone_number', 'company', 'purpose', 'identity_file'
    ];
}

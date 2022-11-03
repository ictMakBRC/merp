<?php

namespace App\Models\Humanresource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'contact_relationship',
        'contact_name', 'contact_email', 'contact_address', 'contact_phone', ];
}

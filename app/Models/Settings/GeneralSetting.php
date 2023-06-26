<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'usd_rate',
        'employee_nssf',
        'employer_nssf',
        'paye',
        'vat',
        'eur_rate',
        'gbp_rate',
        'status',
    ];
}

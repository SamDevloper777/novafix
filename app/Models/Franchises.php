<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchises extends Model
{
    use HasFactory;

    protected $fillable = [
        'franchise_name',
        'contact_no',
        'email',
        'password',
        'aadhaar_no',
        'pan_no',
        'ifsc_code',
        'account_no',
        'street',
        'city',
        'district',
        'pincode',
        'state',
        'country',
        'doc',
        'status',
    ];
}

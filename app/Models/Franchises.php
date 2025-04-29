<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Franchises extends Authenticatable
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
        'bank_name',
        'branch_name',
        'district',
        'pincode',
        'state',
        'country',
        'doc',
        'status',
    ];
    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
    public function requests()
    {
        return $this->hasMany(Request::class, 'franchise_id');
    }

    public function receptionists()
    {
        return $this->hasMany(Receptioner::class, 'franchise_id');

}
}

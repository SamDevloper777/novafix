<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Type;
class Staff extends Authenticatable
{
    use HasFactory;

    protected $guard = "staff";
    protected $fillable = [
        'franchise_id',
        'receptionist_id',
        'name',
        'email',
        'contact',
        'salary',
        'type_id',
        'status',
        'image',
        'aadhar',
        'pan',
        'address',
        'password'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function type(): HasOne
    {
        return $this->HasOne(Type::class, "id", "type_id");
    }
    public function franchise()
    {
        return $this->belongsTo(Franchises::class);
    }

    public function receptioner()
    {
        return $this->belongsTo(Receptioner::class, 'receptionist_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'franchise_id',
        'reciptionist_id',
        'service_code',
        'technician_id',
        'owner_name',
        'product_name',
        'email',
        'contact',
        'brand',
        'serial_no',
        'color',
        'MAC',
        'type_id',
        'problem',
    ];

    public function type(): HasOne
    {
        return $this->HasOne(Type::class, "id", "type_id");
    }
    public function technician(): HasOne
    {
        return $this->HasOne(Staff::class, "id", "technician_id");
    }

    public function receptionist()
    {
        return $this->belongsTo(Receptioner::class, 'reciptionist_id');
    }


    public function getStatus()
    {
        $status = $this->status;
        switch ($status) {
            case 0:
                return "pending";
                break;
            case 1:
                return "confirm";
                break;
            case 2:
                return "work in progress";
                break;
            case 2.1:
                return "Deassemble";
                break;
            case 2.2:
                return "Repiring in progress ";
                break;
            case 2.3:
                return "Assemble";
                break;
            case 3:
                return "rejected";
                break;
            case 4:
                return "work done";
                break;
            case 5:
                return "delivered";
                break;
        }

    }

}

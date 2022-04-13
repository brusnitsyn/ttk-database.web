<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technique extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'equipment_manufacturer_id'
    ];

    public function manufacturer()
    {
        return $this->hasOne(EquipmentManufacturer::class, 'id');
    }

    public function kind()
    {
        return $this->hasOne(MachineTypeForMachine::class, 'machine_type_id');
    }
}

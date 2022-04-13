<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineTypeForMachine extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'machine_type_id'
    ];

    public function machine()
    {
        return $this->hasOne(Technique::class, 'id');
    }

    public function machineType()
    {
        return $this->hasOne(MachineTypeForMachine::class, 'id');
    }
}

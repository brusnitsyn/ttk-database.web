<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'machine_type_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function kind()
    {
        return $this->belongsTo(MachineType::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineForProduct extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'product_id',
    ];
}

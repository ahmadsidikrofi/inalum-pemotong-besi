<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConveyingEquipmentModel extends Model
{
    use HasFactory;

    protected $table = 'conveying_equipment';

    protected $fillable = [
        'id',
        'name',
        'type',
        'location',
        'capacity',
        'condition',
        'status',
    ];
}

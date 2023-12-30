<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConveyingModel extends Model
{
    use HasFactory;
    protected $table = "conveying_equipment";
    protected $guarded = [];

    public function order_billet()
    {
        return $this->belongsTo(OrderModel::class, 'order_id');
    }
    public function material()
    {
        return $this->belongsTo(MaterialModel::class);
    }
}

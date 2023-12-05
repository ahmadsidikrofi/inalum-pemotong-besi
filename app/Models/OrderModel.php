<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = "order_billet";
    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(MaterialModel::class, "material_id");
    }
}

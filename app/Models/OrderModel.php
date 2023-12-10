<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = "order_billet";
    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(MaterialModel::class, "material_id");
    }

    public function calculateRemainingTime()
    {
        if ($this->status === "pemotongan panjang" && $this->durasi_pemotongan_panjang || $this->status === "pemotongan diameter" && $this->durasi_pemotongan_panjang) {
            $endDate = Carbon::parse($this->durasi_pemotongan_panjang);
            $now = Carbon::now();
            $remainingTime = $endDate->diff($now);
            return $remainingTime->format('%I menit %S detik');
        }
        return '';
    }

    public function isTimeExpired()
    {
        $endDate = Carbon::parse($this->durasi_pemotongan_panjang);
        $now = Carbon::now();
        return $now >= $endDate;
    }

}

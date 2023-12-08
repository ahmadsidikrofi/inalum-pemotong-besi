<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_billet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("material_id")->nullable();
            $table->integer("diameter_billet")->nullable();
            $table->integer("panjang")->nullable();
            $table->integer("quantity");
            $table->timestamp("tanggal_order");
            $table->enum("status", ["menunggu konfirmasi", "pemotongan panjang", "pemotongan diameter", "selesai"])->default("menunggu konfirmasi");
            $table->time("durasi_pemotongan_panjang")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_billet');
    }
};

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
        Schema::create('conveying_equipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("material_id")->nullable();
            $table->unsignedBigInteger("conveying_id")->nullable();
            $table->enum("status_pengangkutan", ["menunggu diangkut", "selesai diangkut"])->default("menunggu diangkut");
            // $table->string("status_pengangkutan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conveying_equipment');
    }
};

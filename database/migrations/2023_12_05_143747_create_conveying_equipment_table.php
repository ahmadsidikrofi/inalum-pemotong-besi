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
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('condition')->nullable();
            $table->enum("status_pengangkutan", ["menunggu diangkut", "selesai diangkut"])->default("menunggu diangkut");
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

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
            // $table->string("status_pengangkutan");
            $table->string('name');
            $table->string('type');
            $table->string('location');
            $table->integer('capacity');
            $table->string('condition');
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

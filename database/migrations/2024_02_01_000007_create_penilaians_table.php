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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ami');
            $table->unsignedBigInteger('id_tilik');
            $table->foreign('id_ami')->references('id')->on('ami');
            $table->foreign('id_tilik')->references('id')->on('tilik');
            $table->tinyInteger('angka');
            $table->string('catatan')->nullable();
            $table->string('kelebihan')->nullable();
            $table->integer('kekurangan_kategori')->nullable();
            $table->string('peluang_peningkatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};

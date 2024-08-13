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
        Schema::create('rancangan_anggaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ami');
            $table->foreign('id_ami')->references('id')->on('ami');
            $table->string('nama_item');
            $table->integer('harga_satuan');
            $table->integer('jumlah_item');
            $table->integer('subtotal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rancangan_anggaran');
    }
};

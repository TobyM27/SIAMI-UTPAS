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
        Schema::create('pengesahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ami');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_ami')->references('id')->on('ami');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('nama');
            $table->string('jabatan');
            $table->timestamp('tanggal');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengesahan');
    }
};

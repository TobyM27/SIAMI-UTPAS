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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ami');
            $table->unsignedBigInteger('id_soalstandar');
            $table->foreign('id_ami')->references('id')->on('ami');
            $table->foreign('id_soalstandar')->references('id')->on('soal__standars')->onDelete('cascade');
            $table->string('link');
            $table->boolean('jawaban')->nullable(true);
            $table->string('keterangan')->nullable(true);
            $table->boolean('status_verifikasi')->nullable();
            $table->string('komentar_verifikasi')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique([
                'id_ami','id_soalstandar'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};

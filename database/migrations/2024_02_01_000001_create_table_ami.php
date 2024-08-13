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
        Schema::create('ami', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user_auditor1');
            $table->unsignedBigInteger('id_user_auditor2');
            $table->unsignedBigInteger('id_user_auditee');
            $table->unsignedBigInteger('id_user_lpm');
            $table->foreign('id_user_auditor1')->references('id')->on('users');
            $table->foreign('id_user_auditor2')->references('id')->on('users');
            $table->foreign('id_user_auditee')->references('id')->on('users');
            $table->foreign('id_user_lpm')->references('id')->on('users');
            $table->string('prodi');
            $table->string('siklus');
            $table->date('tanggal_mulai');
            $table->date('tanggal_ami');
            $table->date('tanggal_akhir');
            $table->string('nama_rektor_utpas');
            $table->string('nama_warek_utpas');
            $table->string('nama_spmi');
            $table->boolean('sah')->default(false);
            $table->string('link_file');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ami');
    }
};

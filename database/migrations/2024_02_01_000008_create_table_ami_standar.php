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
        Schema::create('ami_standar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ami');
            $table->unsignedBigInteger('id_standar');
            $table->foreign('id_ami')->references('id')->on('ami');
            $table->foreign('id_standar')->references('id')->on('standar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ami_standar');
    }
};

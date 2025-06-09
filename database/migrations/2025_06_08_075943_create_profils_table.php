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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akun_id');
            $table->string('nama', 100);
            $table->unsignedBigInteger('alamat_id');
            $table->string('no_hp', 20);
            $table->foreign('akun_id')->references('id')->on('akuns');
            $table->foreign('alamat_id')->references('id')->on('alamats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};

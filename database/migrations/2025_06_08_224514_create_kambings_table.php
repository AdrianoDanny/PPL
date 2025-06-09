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
        Schema::create('kambings', function (Blueprint $table) {
            $table->id();
            $table->float('berat');
            $table->integer('usia');
            $table->boolean('status_tersedia')->default(true);
            $table->string('jenis');
            $table->decimal('harga', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('pemasok_id');
            $table->string('foto_kambing')->nullable();
            $table->foreign('pemasok_id')->references('id')->on('profils');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kambings');
    }
};

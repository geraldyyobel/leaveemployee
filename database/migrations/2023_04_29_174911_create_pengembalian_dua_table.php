<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian_dua', function (Blueprint $table) {
            $table->id('id_pengembalian');
            $table->date('tgl_pengembalian');
            $table->enum('status_pengembalian', ['Pending', 'Ya','Tidak']);
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
        Schema::table('pengembalian_dua', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ruangan');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan');
        });
        Schema::table('pengembalian_dua', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peminjaman');
            $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman_dua');
        });
        Schema::table('pengembalian_dua', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian_dua');
    }
};

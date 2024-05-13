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
        Schema::create('peminjaman_dua', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->enum('status_peminjaman', ['Pending', 'Disetujui','Ditolak']);
            $table->date('tgl_ambil');
            $table->date('tgl_kembali');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
        Schema::table('peminjaman_dua', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ruangan');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        Schema::table('peminjaman_dua', function (Blueprint $table) {
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
        Schema::dropIfExists('peminjaman_dua');
    }
};

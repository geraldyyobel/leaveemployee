<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id('id_ruangan');
            $table->string('no_ruangan');
            $table->enum('status_ruangan', ['Dipinjam', 'Tersedia', 'Pengarsipan', 'Rejected','softdelete', 'Menunggu Approval']);
            $table->string('nama_ruangan');
            $table->integer('kapasitas');
            $table->dateTime('tgl_upload');
            $table->string('file_foto');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangan');
    }
};

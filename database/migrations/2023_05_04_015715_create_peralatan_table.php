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
        Schema::create('peralatan', function (Blueprint $table) {
            $table->id('id_peralatan');
            $table->string('no_peralatan');
            $table->enum('status_peralatan', ['Dipinjam', 'Tersedia', 'Pengarsipan', 'Rejected','softdelete', 'Menunggu Approval']);
            $table->string('nama_peralatan');
            $table->integer('stok');
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
        Schema::dropIfExists('peralatan');
    }
};

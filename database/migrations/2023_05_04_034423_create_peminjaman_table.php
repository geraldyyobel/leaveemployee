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
        Schema::create('pengajuan_cuti', function (Blueprint $table) {
            $table->id();
            $table->integer('real_id')->nullable();
            $table->string('name');
            $table->string('reason');
            $table->string('acc_by')->nullable();
            $table->double('type_reason');
            $table->enum('status_cuti', ['Pending', 'Disetujui', 'Ditolak']);
            $table->date('tgl_cuti');
            $table->date('tgl_kembali');
            $table->integer('jumlah_cuti')->nullable();
            $table->string('catatan')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->unsignedBigInteger('id_karyawan'); // Gunakan unsignedBigInteger untuk foreign key.
            $table->timestamps();
            // Definisi foreign key ke tabel users
            $table->foreign('id_karyawan')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('pengajuan_cuti');
        Schema::table('pengajuan_cuti', function (Blueprint $table) {
            $table->dropForeign(['id_karyawan']);
        });

        Schema::dropIfExists('pengajuan_cuti');
    }
};


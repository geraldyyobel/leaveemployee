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
        Schema::create('pengarsipan_dua', function (Blueprint $table) {
            $table->id('id_pengarsipan');
            $table->dateTime('tgl_pengarsipan')->nullable();
            $table->enum('status_pengarsipan', ['Pending', 'Ya','Tidak']);
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
        Schema::table('pengarsipan_dua', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ruangan');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        Schema::table('pengarsipan_dua', function (Blueprint $table) {
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
        Schema::dropIfExists('pengarsipan_dua');
    }
};

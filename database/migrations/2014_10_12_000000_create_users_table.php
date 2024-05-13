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
        Schema::create('users', function (Blueprint $table) {
    $table->id(); // Kolom 'id' akan ditambahkan otomatis
    $table->bigInteger('id_karyawan');
    $table->string('name');
    $table->string('username')->unique();
    $table->string('password');
    $table->double('kuota_cuti')->default(12);
    $table->timestamps();
    $table->boolean('aktif')->default(1);
    $table->string('level')->default('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

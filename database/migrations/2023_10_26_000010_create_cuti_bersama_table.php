
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
        Schema::create('cuti_bersama', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_cuti');
            $table->dateTime('tgl_cuti');
            $table->string('catatan');
            $table->string('surat')->nullable();
            $table->integer('point');
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
        Schema::dropIfExists('pengarsipan');
    }
};


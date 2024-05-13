<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peminjaman')->insert([
            [
                'id_peminjaman' => '1',
                'id_dokumen' => '1',
                'status_peminjaman'=> 'Tidak',
                'tgl_ambil'=> '2020-10-25',
                'tgl_kembali' => '2021-12-25 ',
                'id' => '1',
            ]]);
    }
}

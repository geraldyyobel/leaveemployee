<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengembalianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengembalian')->insert([
            [
                'id_pengembalian' => '1',
                'id_dokumen' => '1',
                'id_peminjaman' => '1',
                'tgl_pengembalian' => '2021-12-25',
                'id' => '1'
            ],

        ]);
    }
}

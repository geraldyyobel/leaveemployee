<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokumen')->insert([
            [
                'id_dokumen' => '1',
                'no_dokumen' => 'xxx/2311',
                'status_dokumen' => 'Tersedia',
                'nama_dokumen' => 'ITSR',
                'tahun_dokumen' => '2019',
                'deskripsi' => 'ITSR Website BAST',
                'tgl_upload' => \Carbon\Carbon::now(),
                'file_dokumen' => 'default_file',
                'created_at' => \Carbon\Carbon::now(),
            ],
            [
                'id_dokumen' => '2',
                'no_dokumen' => 'xxx/CFF90',
                'status_dokumen' => 'Tersedia',
                'nama_dokumen' => 'ITSR C-ad',
                'tahun_dokumen' => '2019',
                'deskripsi' => 'Retensi Dokumen Lama',
                'tgl_upload' => \Carbon\Carbon::now(),
                'file_dokumen' => 'default_file2',
                'created_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}

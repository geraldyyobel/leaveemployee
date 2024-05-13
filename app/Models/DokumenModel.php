<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DokumenModel extends Model
{

    public function allDataTerbuka()
    {
        return DB::table('pengajuan_cuti')
            ->where('status_cuti', '=', 'Disetujui');
            // ->where('status_cuti', '=', 'Pending')
            // ->where('status_cuti', '=', 'Ditolak');
            // ->orwhere('jenis_peralatan', '=', 'Terbuka')
            // ->where('status_cuti', '!=', 'softdelete');

            return DB::table('pengajuan_cuti')

            // ->Where('status_cuti')
            ->get();
    }

    public function getLastIdDokumen()
    {
        return DB::table('peralatan')
            ->select('id_peralatan')
            ->orderBy('id_peralatan', 'DESC')
            ->limit(1)
            ->get();
    }

    public function addDokumen($data)
    {
        if (DB::table('peralatan')->insert($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_dokumen($update_peralatan, $no_peralatan)
    {
        if (DB::table('pengajuan_cuti')->where('id', $no_peralatan)->update($update_peralatan)) {
            return true;
        
        } else {
            return false;
        }
    }

    //modal add arsip
    public function insert_pengarsipan($data2)
    {
        if (DB::table('pengarsipan')->insert($data2)) {
            return true;
        } else {
            return false;
        }
    }

    public function getDokumenById($id)
    {
        return DB::table('pengajuan_cuti')
            ->select('*')
            // ->leftJoin('pengarsipan', 'pengarsipan.id_peralatan', '=', 'peralatan.id_peralatan')
            ->where('pengajuan_cuti.id', $id)
            ->get();
    }

    public function getNamaPeminjam($id)
    {
        return DB::table('Peminjaman')
            // ->leftJoin('peralatan', 'peralatan.id_peralatan', '=', 'peminjaman.id_peralatan')
            ->select('users.name')
            ->leftJoin('users', 'users.id', '=', 'peminjaman.id')
            ->where('status_peminjaman', '=', 'Ya')
            ->where('id_peralatan', $id)
            ->get();
    }
    public function peralatanDipinjam($id)
    {
        return DB::table('peminjaman')
            ->select('peminjaman.id_peminjaman', 'peminjaman.status_peminjaman', 'peminjaman.tgl_kembali', 'pengembalian.status_pengembalian', 'users.name')
            ->leftJoin('pengembalian', 'pengembalian.id_peminjaman', '=', 'peminjaman.id_peminjaman')
            ->leftJoin('users', 'users.id', '=', 'peminjaman.id')
            ->where('peminjaman.id_peralatan', $id)
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->limit(1)
            ->get();
    }


    public function softdelete_peralatan($update_peralatan, $id_peralatan)
    {
        if (DB::table('peralatan')->where('id_peralatan', $id_peralatan)->update($update_peralatan)) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_peminjaman($insert_peminjaman)
    {
        if (DB::table('peminjaman')->insert($insert_peminjaman)) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_pengembalian($insert_pengembalian)
    {
        if (DB::table('pengembalian')->insert($insert_pengembalian)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_pengembalian($pengembalian, $id_peminjaman)
    {
        if (DB::table('pengembalian')->where('id_peminjaman', $id_peminjaman)->update($pengembalian)) {
            return true;
        } else {
            return false;
        }
    }
    public function cekPengembalian($id_peminjaman)
    {
        return DB::table('pengembalian')->where('id_peminjaman', $id_peminjaman)->get();
    }
    protected $table = 'peralatan';
    protected $primaryKey = 'id_peralatan';
    protected $fillable = ['no_peralatan', 'status_peralatan', 'no_peralatan', 'stok', 'file_foto'];
}

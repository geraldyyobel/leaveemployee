<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralModel extends Model
{
    use HasFactory;

    public function get_profil()
    {
        return DB::table('users')->select('id', 'nama_trainset')->get();
    }


    public function get_pengarsipan_pending()
    {
        return DB::table('pengarsipan')
            ->where('status_pengarsipan', '=', 'Pending')
            ->count();
    }


    public function get_peminjaman_pending()
    {
        return DB::table('pengajuan_cuti')
            ->where('status_cuti', '=', 'Pending')
            ->count();
    }

    public function get_pengembalian_pending()
    {
        return DB::table('pengajuan_cuti')
            ->where('status_cuti', '=', 'Pending')
            ->count();
    }

    public function get_pengarsipan_pending_ruangan()
    {
        return DB::table('pengarsipan_dua')
            ->where('status_pengarsipan', '=', 'Pending')
            ->count();
    }


    public function get_peminjaman_pending_ruangan()
    {
        return DB::table('peminjaman_dua')
            ->where('status_peminjaman', '=', 'Pending')
            ->count();
    }

    public function get_pengembalian_pending_ruangan()
    {
        return DB::table('pengembalian_dua')
            ->where('status_pengembalian', '=', 'Pending')
            ->count();
    }


    public function get_pengarsipan_pending_admin($id)
    {
        return DB::table('pengarsipan')
            ->leftJoin('users', 'users.id', '=', 'pengarsipan.id')
            ->where('status_pengarsipan', '=', 'Pending')
            ->where('users.id', '=', $id)
            ->count();
    }


    public function get_peminjaman_pending_admin($id)
    {
        return DB::table('pengajuan_cuti')
            ->leftJoin('users', 'users.id_karyawan', '=', 'pengajuan_cuti.id_karyawan')
            ->where('status_cuti', '=', 'Pending')
            ->where('users.id_karyawan', '=', $id)
            ->count();
    }

    public function get_pengembalian_pending_admin($id)
    {
        return DB::table('pengajuan_cuti')
            ->leftJoin('users', 'users.id_karyawan', '=', 'pengajuan_cuti.id_karyawan')
            ->where('status_cuti', '=', 'Pending')
            ->where('users.id_karyawan', '=', $id)
            ->count();
    }

    public function get_pengarsipan_pending_admin_ruangan($id)
    {
        return DB::table('pengarsipan_dua')
            ->leftJoin('users', 'users.id', '=', 'pengarsipan_dua.id')
            ->where('status_pengarsipan', '=', 'Pending')
            ->where('users.id', '=', $id)
            ->count();
    }


    public function get_peminjaman_pending_admin_ruangan($id)
    {
        return DB::table('peminjaman_dua')
            ->leftJoin('users', 'users.id', '=', 'peminjaman_dua.id')
            ->where('status_peminjaman', '=', 'Pending')
            ->where('users.id', '=', $id)
            ->count();
    }

    public function get_pengembalian_pending_admin_ruangan($id)
    {
        return DB::table('pengembalian_dua')
            ->leftJoin('users', 'users.id', '=', 'pengembalian_dua.id')
            ->where('status_pengembalian', '=', 'Pending')
            ->where('users.id', '=', $id)
            ->count();
    }
}


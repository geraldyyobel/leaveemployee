<?php

namespace App\Models\approval;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengembalianModel extends Model
{
    public function allData()
    {
        return DB::table('pengajuan_cuti')
        // ->leftJoin('peralatan', 'peralatan.id_peralatan', '=', 'pengembalian.id_peralatan')
        // ->leftJoin('peminjaman', 'peminjaman.id_peminjaman', '=', 'pengembalian.id_peminjaman')
        // ->leftJoin('users', 'users.id', '=', 'pengembalian.id')
        
        ->get();
    }
    
    public function masa_cuti($keyword)
    {
        return DB::table('pengajuan_cuti')
    ->where(function($query) use ($keyword) {
        $query->orWhere('pengajuan_cuti.name', 'like', '%'.$keyword.'%')
              ->orWhere('pengajuan_cuti.id_karyawan', 'like', '%'.$keyword.'%')
              ->orWhere('pengajuan_cuti.reason', 'like', '%'.$keyword.'%')
              ->orWhere('pengajuan_cuti.type_reason', 'like', '%'.$keyword.'%');
    })
    ->where('status_cuti', 'Disetujui')
    ->paginate(20);

    }

    public function user_not_found($keyword)
    {
        return DB::table('pengajuan_cuti')
    ->where(function($query) use ($keyword) {
        $query->orWhere('pengajuan_cuti.name', 'like', '%'.$keyword.'%')
              ->orWhere('pengajuan_cuti.real_id', 'like', '%'.$keyword.'%');
    })
    ->where('status_cuti', 'Disetujui')
    ->get();

    }

    public function approval_pengembalian($update_pengembalian, $id_pengembalian)
    {
        if(DB::table('pengembalian')->where('id_pengembalian', $id_pengembalian)->update($update_pengembalian)) {
            return true;
        } else {
            return false;
        }
    }
    public function getDataById($id)
    {
        return DB::table('pengembalian')
            ->leftJoin('peralatan', 'peralatan.id_peralatan', '=', 'pengembalian.id_peralatan')
            ->leftJoin('users', 'users.id', '=', 'pengembalian.id')
            ->where('id_pengembalian', '=', $id)
            ->get();
    }

    public function getPengembalianByDivisi($id_user)
    {
        return DB::table('pengembalian')
            ->leftJoin('peralatan', 'peralatan.id_peralatan', '=', 'pengembalian.id_peralatan')
            ->leftJoin('users', 'users.id', '=', 'pengembalian.id')
            // ->where('peralatan.id_departemen', '=', $divisi)
            ->where('users.id', '=', $id_user)
            ->get();
    }
}

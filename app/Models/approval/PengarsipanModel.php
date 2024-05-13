<?php

namespace App\Models\approval;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengarsipanModel extends Model
{
    public function allData($keyword)
    {        
        return DB::table('Pengajuan_cuti')
            // ->leftJoin('peralatan', 'peralatan.id_peralatan', '=', 'pengarsipan.id_peralatan')
            // ->leftJoin('users', 'users.id', '=', 'pengarsipan.id')
            // ->where('status_peralatan', '=', 'Pengarsipan')
            // ->where('peralatan.nama_peralatan', 'like', '%'.$keyword.'%')
            // ->orwhere('peralatan.no_peralatan', 'like', '%'.$keyword.'%')
            // ->orwhere('peralatan.stok', 'like', '%'.$keyword.'%')


            // ->orwhere('pengajuan_cuti.name', 'like', '%'.$keyword.'%')
            // ->orwhere('pengajuan_cuti.id_karyawan', 'like', '%'.$keyword.'%')
            // ->orwhere('pengajuan_cuti.reason', 'like', '%'.$keyword.'%')
            // ->orwhere('pengajuan_cuti.type_reason', 'like', '%'.$keyword.'%')

        // ->where('acc_by', 'like', '%'.$keyword.'%')
        ->where('acc_by', 'like', '%'.auth()->user()->name.'%')


            ->paginate(20);
    }


    public function approval_arsip($update_peralatan, $update_pengarsipan, $no_peralatan)
    {
        if (DB::table('peralatan')->where('id_peralatan', $no_peralatan)->update($update_peralatan) && DB::table('pengarsipan')->where('id_peralatan', $no_peralatan)->update($update_pengarsipan)) {
            return true;
        } else {
            return false;
        }
    }
}

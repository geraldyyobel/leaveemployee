<?php

namespace App\Models\approval;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // Add this line
use Illuminate\Support\Facades\DB;

class PeminjamanModel extends Model
{
    use HasFactory;
    use HasFactory, Notifiable; // Make sure to include Notifiable
    protected $table = 'pengajuan_cuti';

    protected $fillable = [
        'id_karyawan',
        'real_id',
        'name',
        'reason',
        'type_reason',
        'status_cuti',
        'jumlah_cuti',
        'tgl_cuti',
        'tgl_kembali',
        'catatan',
        'file_pendukung',
        'acc_by',
    ];
// }

    public function allData()
    {
        return DB::table('Pengajuan_cuti')
            // ->leftJoin('users', 'users.id_karyawan', '=', 'pengajuan_cuti.id_karyawan')
            // ->leftJoin('users', 'users.id', '=', 'pengajuan_cuti.id_karyawan')

            ->get();
    }

    public function pengajuanCuti()
    {
        return $this->belongsTo(User::class, 'id_karyawan', 'id');
    
    }
    // public function addQty($data)
    // {
    //     if (DB::table('Peminjaman')->insert($data)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function update_dokumen($update_peminjaman, $id_peminjaman)
    {
        if (DB::table('pengajuan_cuti')->where('id', $id_peminjaman)->update($update_peminjaman)) {
            return true;
        } else {
            return false;
        }
    }
    public function approval_peminjaman($update_peminjaman, $id_peminjaman)
    {
        

        if (DB::table('users')->where('id_karyawan', $id_peminjaman)->update($update_peminjaman)) {
            return true;
        } else {
            return false;
        }
    }

    // public function getDataById($id)
    // {
    //     return DB::table('peminjaman')
    //         ->leftJoin('peralatan', 'peralatan.id_peralatan', '=', 'peminjaman.id_peralatan')
    //         ->leftJoin('users', 'users.id', '=', 'peminjaman.id')
    //         ->where('id_peminjaman', '=', $id)
    //         ->get();
    // }

    public function getPeminjamanByDivisi()
    {
        return DB::table('pengajuan_cuti')
        // ->leftJoin('users', 'users.id', '=', 'pengajuan_cuti.real_id')
        ->where('pengajuan_cuti.real_id', '=', auth()->user()->id_karyawan)
        ->get();

    // return DB::table('pengajuan_cuti')
    //     ->where('pengajuan_cuti.real_id', '=', auth()->user()->id)
    //     ->get();


    }
    public function employee_not_found()
    {
        return DB::table('pengajuan_cuti')
        // ->leftJoin('users', 'users.id', '=', 'pengajuan_cuti.real_id')
        // ->where('pengajuan_cuti.real_id', '=', auth()->user()->id_karyawan)
        ->get();

    // return DB::table('pengajuan_cuti')
    //     ->where('pengajuan_cuti.real_id', '=', auth()->user()->id)
    //     ->get();


    }

    public function getPeminjamanByDivisiSuperAdmin($id)
    {
        return DB::table('pengajuan_cuti')
        // ->leftJoin('users', 'users.id', '=', 'pengajuan_cuti.real_id')
        ->where('pengajuan_cuti.real_id', '=', $id)
        ->get();

    // return DB::table('pengajuan_cuti')
    //     ->where('pengajuan_cuti.real_id', '=', auth()->user()->id)
    //     ->get();


    }

    // public function getPengembalian($id_user)
    // {
    //     return DB::table('pengembalian')
    //     ->where('id', '=', $id_user)
    //         ->get();
    // }

    // public function Peralatan(){

    //     return $this ->hasMany(PeralatanModel::class);
    // }

}

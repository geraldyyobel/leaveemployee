<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{

    public function dokumen()
    {
        return $this->hasMany(PengembalianModel::class, 'kuota_cuti', 'id');
    }

    public function getPaginateUser($keyword)
    {
        return DB::table('users')
            ->orwhere('users.name', 'like', '%'.$keyword.'%')
            ->orwhere('users.username', 'like', '%'.$keyword.'%')
            ->orwhere('users.level', 'like', '%'.$keyword.'%')
            ->paginate(10);
    }

    //Tambah Data User
    public function insert_datauser($data)
    {
        if (DB::table('users')->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function allData()
    {
        return DB::table('users')
            // ->leftJoin('users', 'users.id_karyawan', '=', 'pengajuan_cuti.id_karyawan')
            // ->leftJoin('users', 'users.id', '=', 'pengajuan_cuti.id_karyawan')
        
            ->get();
    }

    public function profilUser()
    {
        return DB::table('users')
            ->where('id', (Auth::user()->id))
            ->get();
    }

    public function masa_cuti($keyword)
    {
        return DB::table('users')
    ->where(function($query) use ($keyword) {
        $query->orWhere('users.name', 'like', '%'.$keyword.'%')
              ->orWhere('users.id_karyawan', 'like', '%'.$keyword.'%')
              ->orWhere('users.kuota_cuti', 'like', '%'.$keyword.'%');
    })
    ->where('level', ['admin','user'])
    ->paginate(20);
    }


    public function getPeminjamanByDivisiSuperAdmin($id)
    {
        return DB::table('users')
        ->leftJoin('pengajuan_cuti', 'pengajuan_cuti.real_id', '=', 'users.id_karyawan')
        ->where('pengajuan_cuti.real_id', '=', $id)
        ->paginate(1);

    // return DB::table('pengajuan_cuti')
    //     ->where('pengajuan_cuti.real_id', '=', auth()->user()->id)
    //     ->get();


    }
    //Delete Data User
    public function delete_datauser($id)
    {
        DB::table('users')->where('id', $id)->delete();
    }

    public function update_user($data, $id)
    {
        if (DB::table('users')->where('id',$id)->update($data)){
            return true;
        }else{
            return false;
        }
    }

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'kuota_cuti',
        'id_karyawan',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'username_verified_at' => 'datetime',
    ];
}

<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CutiBersamaModel extends Model
{
    use HasFactory;
    use HasFactory, Notifiable; // Make sure to include Notifiable
    protected $table = 'cuti_bersama';

    protected $fillable = [
        'nama_cuti',
        'tgl_cuti',
        'catatan',
        'surat',
        'point',
    ];

    public function allData()
    {
        return DB::table('cuti_bersama')
            ->get();
    }
}

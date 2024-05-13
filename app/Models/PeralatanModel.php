<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeUnit\FunctionUnit;

class PeralatanModel extends Model
{
    use HasFactory;

    protected $table = 'peralatan';
    protected $primaryKey = 'id_peralatan';
    protected $fillable = ['no_peralatan', 'status_peralatan', 'no_peralatan', 'stok', 'file_foto'];

    public function Peminjaman(){

        return $this ->hasMany(PeminjamanModel::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganModel extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';
    protected $fillable = ['no_ruangan', 'status_ruangan', 'no_ruangan', 'kapasitas', 'file_foto'];
}
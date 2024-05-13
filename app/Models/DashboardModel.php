<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class DashboardModel extends Model
{
    use HasFactory;
    // protected $fillable = ['stockName', 'stockPrice', 'stockYear'];


    public function getDokumen()
    {
        // return DB::table('peralatan')->count();
    }
    public function getRuangan()
    {
        // return DB::table('ruangan')->count();
    }
}

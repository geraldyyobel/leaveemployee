<?php

namespace App\Http\Controllers\admin\riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\approval\RetensiModel;
use Illuminate\Support\Facades\Auth;

class RiwayatretensiController extends Controller
{

    public function __construct()
    {
        $this->Model = new RetensiModel;
    }

    public function index()
    {
        $data = [
            'dokumen' => $this->Model->getRetensiByDivisi(Auth::user()->id_departemen)
        ];
        return view('admin.riwayat.riwayat-retensi', $data, $this->notif_pending());
    }

    public function show_detail($id)
    {
        $data = [
            'retensi' => $this->Model->getRetensiById($id),
        ];

        return view('admin.riwayat.d_riwayat_retensi', $data, $this->notif_pending());
    }

}

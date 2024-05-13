<?php

namespace App\Http\Controllers\admin\riwayat;

use App\Http\Controllers\Controller;
use App\Models\approval\PengarsipanModel;
use Illuminate\Support\Facades\Auth;

class RiwayatpengarsipanController extends Controller
{

    public function __construct()
    {
        $this->Model = new PengarsipanModel();
    }

    public function index()
    {
        $data = [
            'dokumen' => $this->Model->getDataByDivisi(Auth::user()->id_departemen),
        ];

        return view('admin.riwayat.riwayat-pengarsipan', $data, $this->notif_pending());
    }

    public function show_detail($id)
    {
        $data = [
            'pengarsipan' => $this->Model->getDataById($id),
        ];

        return view('admin.riwayat.d_riwayat_pengarsipan', $data, $this->notif_pending());
    }

}

<?php

namespace App\Http\Controllers\user;

use App\Models\DokumenModel;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->Model = new DokumenModel();
    }


    public function dokumen_terbuka()
    {
        $data = [
            'dokumen' => $this->Model->allDataTerbuka(),
        ];
        return view('user.dokumen_terbuka_user', $data);
    }

    public function detail_data($id)
    {

        $data = [
            'dokumen' => $this->Model->getDokumenById($id),
            'dipinjam'    => $this->Model->dokumenDipinjam($id)

        ];
        return view('user.detail_dokumen_user', $data);
    }

    public function showPdfUser($namePDF)
    {
        return Response::make(file_get_contents('data_file/'.$namePDF.'.pdf'), 200, [
            'content-type'=>'application/pdf',
        ]);
    }



}

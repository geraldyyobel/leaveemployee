<?php

namespace App\Http\Controllers\admin\riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\approval\PeminjamanModel;
use Illuminate\Support\Facades\Auth;

class RiwayatpeminjamanController extends Controller
{
    public function __construct()
    {
        $this->Model = new PeminjamanModel();
    }

    public function index()
    {
        $data = [
            'users' => $this->Model->getPeminjamanByDivisi()
            // 'users' => $this->Model->getPerPage(Auth::user()->id)
        ];
        return view('admin.riwayat.riwayat-peminjaman', $data, $this->notif_pending());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show_detail($id)
    // {
    //     $data = [
    //         'peminjaman' => $this->Model->getDataById($id)
    //     ];

    //     return view('admin.riwayat.d_riwayat_peminjaman', $data, $this->notif_pending());
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

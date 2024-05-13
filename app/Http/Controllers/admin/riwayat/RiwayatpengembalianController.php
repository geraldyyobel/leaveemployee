<?php

namespace App\Http\Controllers\admin\riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\approval\PengembalianModel;
use Illuminate\Support\Facades\Auth;

class RiwayatpengembalianController extends Controller
{
    public function __construct()
    {
        $this->Model = new PengembalianModel();
    }

    public function index()
    {
        $data = [
            'dokumen' => $this->Model->getPengembalianByDivisi(Auth::user()->id)
        ];

        return view('admin.riwayat.riwayat-pengembalian', $data, $this->notif_pending());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'pengembalian' => $this->Model->getDataById($id)
        ];

        return view('admin.riwayat.d_riwayat_pengembalian', $data, $this->notif_pending());
    }

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

<?php

namespace App\Http\Controllers\superadmin\approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\approval\PengarsipanModel;
use App\Models\approval\PengembalianModel;
use App\Traits\notif_sidebar;

class PengarsipanController extends Controller
{
    use notif_sidebar;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->PengarsipanModel = new PengarsipanModel();
    }
    // public function __construct()
    // {
    //     $this->PengarsipanModel = new PengarsipanModel();
    // }

    public function index(Request $request)
    {
         $keyword = $request->keyword;
        
        $data = [
            'users' => $this->PengarsipanModel->allData($keyword),
        ];

        return view('superadmin.approval.pengarsipan', $data, $this->approval_pending());
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
        //
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
    public function update(Request $request, $no_dokumen)
    {
        $update_pengarsipan = [
            'tgl_pengarsipan' => \Carbon\Carbon::now(),
            'status_pengarsipan' =>  $request->input('pengarsipan'),
            'updated_at' => \Carbon\Carbon::now(),
            'catatan'    =>$request->input('catatan_tolak'),
        ];

        if ($request->input('jenis') == 'approve') {
            if ($this->PengarsipanModel->approval_arsip($update_dokumen, $update_pengarsipan, $no_dokumen)) {
                return redirect('/approval/pengarsipan')->with('toast_success', 'Pengarsipan di-Approve!');
            } else {
                return redirect('/approval/pengarsipan');
            }
        } elseif ($request->input('jenis') == 'tolak') {
            $update_dokumen = [
                'status_dokumen' => $request->input('status_dok'),
                'updated_at' => \Carbon\Carbon::now()
            ];

            if ($this->PengarsipanModel->approval_arsip($update_dokumen, $update_pengarsipan, $no_dokumen)) {
                return redirect('/approval/pengarsipan')->with('toast_success', 'Pengarsipan di-Reject!');
            } else {
                return redirect('/approval/pengarsipan');
            }
        }
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

<?php

namespace App\Http\Controllers\superadmin\approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\approval\PengembalianModel;
use App\Models\DokumenModel;
use App\Models\CutiBersamaModel;
use App\Models\User;
use App\Traits\notif_sidebar;
use App\Models\approval\PeminjamanModel;

class PengembalianController extends Controller
{
    use notif_sidebar;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->DokumenModel = new DokumenModel();
        $this->PengembalianModel = new PengembalianModel();
        $this->User = new User();
        $this->Model = new PeminjamanModel();
        $this->CutiBersamaModel = new CutiBersamaModel();
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        $data = [
            // 'users' => $this->PengembalianModel->masa_cuti($keyword),
            'users' => $this->User->masa_cuti($keyword),
            'cuti_bersama' => $this->CutiBersamaModel->allData()
        ];

        return view('superadmin.approval.pengembalian', $data, $this->approval_pending());
    }

    public function detail_cuti_user(Request $request, $id_user)
    {
        $keyword = $request->keyword;
        $id_user = $request->input('id_karyawan');
        $data = [
            'users' => $this->Model->getPeminjamanByDivisiSuperAdmin($id_user),
            'users2' => $this->User->getPeminjamanByDivisiSuperAdmin($id_user)
            // 'users' => $this->Model->getPerPage(Auth::user()->id)
        ];

        return view('superadmin.menu_dokumen.detail_cuti_user', $data, $this->approval_pending());
    }

    public function calculateTotalPoint($userId)
{
    $totalPoint = CutiBersamaModel::where('id', 1)->sum('point');
    return $totalPoint;
}
    public function employee_not_found(Request $request)
{
    $keyword = $request->keyword;
        
    $data = [
        'users' => $this->PengembalianModel->masa_cuti($keyword)
    ];

    return view('superadmin.approval.tidak_ketemu_karyawan', $data, $this->approval_pending());
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
    public function update(Request $request, $id_pengembalian)
    {

        if($request->input('jenis') == 'approve'){
            $update_dokumen = [
                'status_peralatan'    => 'Tersedia'
            ];

            if($this->DokumenModel->update_dokumen($update_dokumen, $request->input('id_dokumen'))) {
                $update_pengembalian = [
                    'tgl_pengembalian' => $request->input('tgl_pengembalian'),
                    'status_pengembalian' =>  $request->input('pengembalian'),
                    'updated_at' => \Carbon\Carbon::now()
                ];
                $this->PengembalianModel->approval_pengembalian($update_pengembalian, $id_pengembalian);
                return redirect('/approval/pengembalian')->with('toast_success', 'Pengembalian Diterima, Riwayat Pengembalian Admin sudah di Update!');
            }else {
                return redirect('/approval/pengembalian')->with('toast_error', 'Update Dokumen Error');
            }
        } elseif ($request->input('jenis') == 'tolak') {

            $request->validate(
                [
                    'catatan_tolak_pengembalian' => 'required'
                ],
                [
                    'catatan_tolak_pengembalian.required' => 'Catatan Wajib Diisi!'
                ]
            );
                $update_pengembalian = [
                    'tgl_pengembalian' => $request->input('tgl_pengembalian'),
                    'status_pengembalian' =>  $request->input('pengembalian'),
                    'catatan'             => $request->input('catatan_tolak_pengembalian'),
                    'updated_at' => \Carbon\Carbon::now()
                ];
            if ($this->PengembalianModel->approval_pengembalian($update_pengembalian, $id_pengembalian)) {
                return redirect('/approval/pengembalian')->with('toast_success', 'Pengembalian Ditolak, Riwayat Pengembalian Admin sudah di Update!');
            } else {
                return redirect('/approval/pengembalian')->with('toast_error', 'Gagal Tolak Pengembalian!'.$request->input('id_dokumen'));
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

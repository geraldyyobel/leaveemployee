<?php

namespace App\Http\Controllers\superadmin\approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\approval\PeminjamanModel;
use App\Models\approval\PengembalianModel;
use App\Models\DokumenModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exports\Export;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->PeminjamanModel = new PeminjamanModel();
        $this->User = new User();
        $this->DokumenModel = new DokumenModel();
        $this->PengembalianModel = new PengembalianModel();
    }

    public function index()
    {
        $data = [
            'peralatan' => $this->PeminjamanModel->allData(),
            'users' => $this->User->allData()
        ];
        return view('superadmin.approval.peminjaman', $data, $this->notif_pending());
    }

    public function createPDF() {
        // retreive all records from db
        $data = User::select('id_karyawan','name','kuota_cuti')->where('level',['admin','user'])->get();
        $pdf = PDF::loadView('user_pdf', array('users' =>  $data))
        ->setPaper('a4', 'portrait');

        return $pdf->download('users-details.pdf');  
      }
    public function createCutiPDF() {
        // retreive all records from db
        $data = PeminjamanModel::select('real_id', 'name', 'reason', 'status_cuti', 'tgl_cuti', 'tgl_kembali', 'catatan', 'created_at', 'acc_by')->get();
        $pdf = PDF::loadView('cuti_pdf', array('users' =>  $data))
        ->setPaper('a4', 'landscape');

        return $pdf->download('all-cuti.pdf');  
      }
    public function createNotFoundUserPDF(Request $request) {
        $keyword = $request->keyword_dua;
        // retreive all records from db
        $data = PeminjamanModel::select('real_id', 'name','type_reason', 'jumlah_cuti', 'reason', 'status_cuti', 'tgl_cuti', 'tgl_kembali', 'catatan', 'created_at', 'acc_by')
        ->where(function($query) use ($keyword) {
            $query->orWhere('name', 'like', '%'.$keyword.'%')
                ->orWhere('real_id', 'like', '%'.$keyword.'%');
        })
        ->where('status_cuti', 'Disetujui')
        ->get();

    $pdf = PDF::loadView('pdf_notfound_user', array('users'=>$data))
        ->setPaper('a4', 'landscape');

    return $pdf->download('all-cuti.pdf');
    // return view('pdf_notfound_user', array('users'=>$data), $this->notif_pending());
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
    public function update(Request $request, $id_peminjaman)
    {
        // $kuota_cuti = auth()->user()->kuota_cuti;
        if($request->input('jenis') == 'approve'){    
            // Kemudian dalam fungsi update Anda:
            $update_dokumen = [
                'status_cuti' => 'Disetujui',
                'catatan' => $request->input('catatan'),
                'acc_by' =>  $request->input('acc_by')//input ke tabel lain
                // 'kuota_cuti' =>  $request->input('kuota_cuti')
            ];
            
            if ($this->PeminjamanModel->update_dokumen($update_dokumen, $request->input('id'))) {
                $update_peminjaman = [
                    'acc_by' =>  $request->input('acc_by'),
                    'catatan' => $request->input('pengajuan_cuti'), // Menggunakan input 'catatan' dari request
                    'status_cuti' => $request->input('pengajuan_cuti'),
                    'updated_at' => \Carbon\Carbon::now()
                ];
                $update_kuota = [
                    'kuota_cuti' =>  $request->input('kuota_cuti'),//input ke tabel lain
                ];
                // dd($update_kuota);
                $id_karyawan = $request->input('id_karyawan');
                // dd($update_kuota);
                $this->PeminjamanModel->approval_peminjaman($update_kuota, $id_karyawan);
                // $kuota_cuti = $request->input('id');
                
                
                // User::where('id', $kuota_cuti)->update($update_kuota);
                // $this->PeminjamanModel->approval_peminjaman($update_peminjaman, $id_peminjaman);
                // return view('nama_tampilan', ['peminjamanperalatan' => $peminjamanperalatan]);
                return redirect('/approval/peminjaman')->with('toast_success', 'Karyawan berhasil dapat cuti!');
            }else {
                return redirect('/approval/peminjaman');
            }
        } elseif ($request->input('jenis') == 'tolak') {
            $update_dokumen = [
                'status_cuti'    => 'Ditolak',
                'catatan' => $request->input('catatan'),
                'acc_by' => $request->input('acc_by')
            ];

            if($this->DokumenModel->update_dokumen($update_dokumen, $request->input('id'))) {
                $update_peminjaman = [
                    'status_cuti' =>  $request->input('pengajuan_cuti'),
                    'acc_by' =>  $request->input('acc_by'),
                    'updated_at' => \Carbon\Carbon::now(),
                    'catatan'    =>$request->input('pengajuan_cuti'),
                ];
                // $this->PeminjamanModel->approval_peminjaman($update_peminjaman, $id_peminjaman);
                return redirect('/approval/peminjaman')->with('toast_success', 'Karyawan tidak dapat cuti!');
            } else {
                return redirect('/approval/peminjaman');
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
        $data = PeminjamanModel::first();
        $data->delete();
        return redirect('/approval/peminjaman');
    }

    public function export()
	{
		return Excel::download(new Export, 'cuti-karyawan-ptbcu.xlsx');
	}
    public function exportUser()
	{
		return Excel::download(new ExportUser, 'cuti-user-karyawan-ptbcu.xlsx');
	}
}

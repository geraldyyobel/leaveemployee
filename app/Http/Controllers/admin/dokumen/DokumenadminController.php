<?php

namespace App\Http\Controllers\admin\dokumen;

use Response;
use App\Models\DokumenModel;
use Illuminate\Http\Request;
use App\Models\PeralatanModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\approval\PeminjamanModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class DokumenadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->DokumenModel = new DokumenModel();
        $this->PeminjamanModel = new PeminjamanModel();
    }

    public function showPdfAdmin($namaPDF)
    {
        return Response::make(file_get_contents('data_file/'.$namaPDF.'.pdf'), 200, [
            'content-type'=>'application/pdf',
        ]);
    }
    //Halaman Detail Dokumen
    public function detail_data($id)
    {
        $data = [
            'dokumen' => $this->DokumenModel->getDokumenById($id),
            // ''    => $this->DokumenModel->dokumenDipinjam($id),
        ];
        return view('admin.menu_dokumen.detail_dokumen_admin', $data, $this->notif_pending());
    }

    public function dokumen_terbuka_admin()
    {
        $data = User::select('*')
                ->get();
        $data2 = PeminjamanModel::select('*')
                ->get();
        return view('admin.menu_dokumen.dokumen_admin_terbuka', ['user'=>$data, 'peralatan'=>$data2], $this->notif_pending());
    }

    public function store(Request $request)
    {
        $direktori_file = 'data_file';

         if ($request->input('jenis') == 'Pengarsipan') {
            $request->validate(
                [
                    'file_pengarsipan' => 'nullable|unique:dokumen,file_dokumen|max:50000|mimes:pdf',
                    // 'file_pengarsipan' => 'required|unique:dokumen,file_dokumen|max:50000|mimes:pdf',
                    'nama_dokumen_pengarsipan' => 'required',
                    'nomor_dokumen_pengarsipan' => 'required',
                    'nomor_dokumen_pengarsipan' => 'required|unique:dokumen,no_dokumen',
                    'stok_dokumen_pengarsipan' => 'required',
                ],
                [
                    // 'file_pengarsipan.required' => 'File dokumen wajib diupload!',
                    'file_pengarsipan.mimes' => 'File dokumen wajib berekstensi .pdf',
                    'file_pengarsipan.max' => 'File dokumen tidak boleh lebih dari 50Mb',
                    'nama_dokumen_pengarsipan.required' => 'Nama Dokumen wajib diisi!',
                    'nomor_dokumen_pengarsipan.required' => 'Nomor Dokumen wajib diisi!',
                    'nomor_dokumen_pengarsipan.unique' => 'Nomor Dokumen sudah ada!',
                    'stok_dokumen_pengarsipan.required' => 'Deskripsi wajib diisi!',
                ]
            );

            $file = $request->file('file_pengarsipan');
            $dok = $request->input('nama_dokumen_pengarsipan');
            $file_dokumen = $file->move($direktori_file, "$dok" . ".pdf");
            $data = [
                'no_peralatan' => $request->nomor_dokumen_pengarsipan,
                'nama_peralatan' => $request->nama_dokumen_pengarsipan,
                'stok' => $request->stok_dokumen_pengarsipan,
                'tgl_upload' => \Carbon\Carbon::now(),
                'file_foto' => $file_dokumen,
                'status_peralatan' => 'Tersedia',
                'created_at' => \Carbon\Carbon::now(),
            ];

            if ($this->DokumenModel->addDokumen($data)) {
                $last_id_peralatan = $this->DokumenModel->getLastIdDokumen();
                if (count($last_id_peralatan) == 1) {
                    $idDokumen = $last_id_peralatan[0]->id_peralatan;
                    $data2 = [
                        'status_pengarsipan' => 'Pending',
                        'created_at' => \Carbon\Carbon::now(),
                        'id_peralatan' => $idDokumen,
                        'id' => Auth::user()->id,
                    ];
                    $this->DokumenModel->insert_pengarsipan($data2);
                }

                return redirect('/riwayat/riwayat_pengarsipan')->with('toast_success', 'Pengajuan Pengarsipan diteruskan ke Approval Arsip superadmin!');
            }else {
                return redirect('/riwayat/riwayat_pengarsipan')->with('toast_error', 'Gagal Arsip Dokumen');
            }
        }
    }

    public function ajukan_cuti(Request $request, $id)
    {
        $request->validate([
            'tgl_cuti' => 'required|date',
            'name' => 'required',
            'real_id' => 'required',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_cuti',
            'reason' => 'required',
            'type_reason' => 'required',
            'file_pendukung' => 'nullable|file|max:50000|mimes:pdf',
        ]);

        // Upload file
        $fileName = null; // Inisialisasi variabel $fileName
        // Hitung jumlah hari cuti
    $tglCuti = Carbon::parse($request->input('tgl_cuti'));
    $tglKembali = Carbon::parse($request->input('tgl_kembali'));
    $jumlahCuti = $tglKembali->diffInDays($tglCuti)+1;
    // dd($jumlahCuti);

// Upload file
if ($request->hasFile('file_pendukung')) {
    $file = $request->file('file_pendukung');
    $fileName = $file->getClientOriginalName();
    $file->move(public_path('uploads'), $fileName);
}

// Simpan data ke database sesuai dengan model Anda
PeminjamanModel::create([
    'id_karyawan' => auth()->user()->id,
    'name' => $request->input('name'),
    'real_id' => $request->input('real_id'),
    'tgl_cuti' => $request->input('tgl_cuti'),
    'tgl_kembali' => $request->input('tgl_kembali'),
    'reason' => $request->input('reason'),
    'jumlah_cuti' => $jumlahCuti,//hitungan jumlah hari dari tgl cuti dan tgl_kembali
    'type_reason' => $request->input('type_reason'),
    'file_pendukung' => $fileName, // Nama file yang diunggah
    // 'id_peralatan' => $request->input('id_peralatan'),
]);

    // $Email = 'geraldyyobel17@gmail.com'; 
    // $adminEmail = 'geraldyexplore@gmail.com'; 
    // Mail::to($adminEmail)->send(new mailNotify($Email));


    return redirect('/dokumen_terbuka_admin')
->with('toast_success', 'Pengajuan Pengarsipan diteruskan ke Super Admin!');
    }   

    public function pengembalian_dokumenById(Request $request)
    {
        if (count($this->DokumenModel->cekPengembalian($request->input('id_peminjaman'))) == 0) {
            $last_id_peralatan = $this->DokumenModel->getLastIdDokumen();
            $id_peralatan = $last_id_peralatan[0]->id_peralatan;
            $pengembalian = [
                'id_peralatan'        => $id_peralatan,
                'tgl_pengembalian'  => $request->input('tgl_kembali'),
                'status_pengembalian' => 'Pending',
                'id_peminjaman'       => $request->input('id_peminjaman'),
                'id'                  => Auth::user()->id,
            ];

            if ($this->DokumenModel->insert_pengembalian($pengembalian)) {
                return redirect('/riwayat/riwayat_peminjaman')->with('toast_success', 'Pengembalian Dokumen diteruskan ke Super Admin!');
            } else {
                return redirect('/riwayat/riwayat_peminjaman')->with('toast_error', 'Pengembalian Dokumen Gagal diteruskan ke Super Admin!');
            }
        } else {
            $pengembalian = [
                'tgl_pengembalian'  => $request->input('tgl_kembali'),
                'status_pengembalian' => 'Pending',
            ];

            if ($this->DokumenModel->update_pengembalian($pengembalian, $request->input('id_peminjaman'))) {
                return redirect('/riwayat/riwayat_peminjaman')->with('toast_success', 'Pengembalian Dokumen diteruskan ke Super Admin!');
            } else {
                return redirect('/riwayat/riwayat_peminjaman')->with('toast_error', 'Pengembalian Dokumen Gagal diteruskan ke Super Admin!');
            }
        }

    }
}

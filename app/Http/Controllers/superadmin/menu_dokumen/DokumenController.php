<?php

namespace App\Http\Controllers\superadmin\menu_dokumen;

use Response;
use App\Models\DokumenModel;
use Illuminate\Http\Request;
use App\Traits\notif_sidebar;
use App\Models\PeralatanModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\approval\PengarsipanModel;
use App\Models\approval\PeminjamanModel;
use App\Models\CutiBersamaModel;

class DokumenController extends Controller
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
        $this->PengarsipanModel = new PengarsipanModel();
        $this->notif = $this->approval_pending();
        $this->cutiBersamaModel = new CutiBersamaModel();
    }

    public function cuti_bersama(Request $request)
    {
        $request->validate([
            'tgl_cuti' => 'nullable|date',
            'nama_cuti' => 'nullable',
            'catatan' => 'nullable',
            'point' => 'required',
            'surat' => 'nullable|file|max:50000|mimes:pdf',
        ]);

        // Upload file
        $fileName = null; // Inisialisasi variabel $fileName
        // Hitung jumlah hari cuti

// Upload file
if ($request->hasFile('surat')) {
    $file = $request->file('surat');
    $fileName = $file->getClientOriginalName();
    $file->move(public_path('uploads'), $fileName);
}
// dd($request);
// Simpan data ke database sesuai dengan model Anda
CutiBersamaModel::create([
    'nama_cuti' => $request->input('nama_cuti'),
    'tgl_cuti' => $request->input('tgl_cuti'),
    'catatan' => $request->input('catatan'),
    'point' => $request->input('point'),
    'surat' => $fileName, 
]);

return redirect('/dashboard')
->with('toast_success', 'Cuti Bersama ditambahkan!');
    }   
    

    public function showPdf($namaPDF)
    {
        return Response::make(file_get_contents('data_file/' . $namaPDF . '.pdf'), 200, [
            'content-type' => 'application/pdf',
        ]);
    }
    //Halaman Detail Dokumen
    public function detail_data($id)
    {
        $data = [
            'dokumen' => $this->DokumenModel->getDokumenById($id)
        ];
        return view('superadmin.menu_dokumen.detail_dokumen', $data, $this->notif);
    }



    // public function dokumen_terbuka()
    // {
    //     $data = [
    //         'dokumen' => $this->DokumenModel->allDataTerbuka(),
    //     ];
    //     return view('superadmin.menu_dokumen.dokumen_terbuka', $data, $this->notif);
    // }


    public function dokumen_terbuka()
    {
        $data = PeminjamanModel::select('*')
                ->get();
        return view('superadmin.menu_dokumen.dokumen_terbuka', ['peralatan'=>$data], $this->notif);
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

        $direktori_file = 'data_file';
        if ($request->input('jenis') == 'Pengarsipan') {
            $request->validate(
                [
                    'file_pengarsipan' => 'required|unique:peralatan,file_foto|max:50000|mimes:pdf',
                    'nama_dokumen_pengarsipan' => 'required',
                    'nomor_dokumen_pengarsipan' => 'required',
                    'nomor_dokumen_pengarsipan' => 'required|unique:peralatan,no_peralatan',
                    'stok_dokumen_pengarsipan' => 'required',
                ],
                [
                    'file_pengarsipan.required' => 'File dokumen wajib diupload!',
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
                        'status_pengarsipan' => 'Ya',
                        'created_at' => \Carbon\Carbon::now(),
                        'id_peralatan' => $idDokumen,
                        'id' => Auth::user()->id,
                    ];
                    $this->DokumenModel->insert_pengarsipan($data2);
                }

                return redirect('/approval/pengarsipan')->with('toast_success', 'Berhasil Arsip Dokumen!');
            }else {
                return redirect('/approval/pengarsipan')->with('toast_error', 'Gagal Arsip Dokumen!');
            }
        }
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
    public function update(Request $request, $no_peralatan)
    {
        if ($request->input('jenis') == 'softdelete') {
            //untuk pengajuan retensi dokumen, ubah status_dokumen - table dokumen
            $update_dokumen = [
                'status_peralatan' => $request->input('status_dok'),
                'updated_at' => \Carbon\Carbon::now(),
            ];
            if ($this->DokumenModel->softdelete_dokumen($update_dokumen, $no_peralatan)) {
                return redirect('/dokumen_terbuka')->with('toast_success', 'Dokumen telah dihapus!');
            } else {
                return redirect('/dokumen_terbuka');
            }
        }
    }

    public function edit_dokumen(Request $request, $id_peralatan)
    {
        $jenis = strtolower($request->jenisDokumen);
        if ($request->file('file_edit') != null) {
            if ($request->oldNamaPeralatan != $request->nama_peralatan_edit) {
                $request->validate([
                    'file_edit' => 'required',
                    'nomor_peralatan_edit' => 'required',
                    'nama_peralatan_edit' => 'required|unique:peralatan,nama_peralatan',
                    'deskripsi_peralatan_edit' => 'required',
                ],[
                    'file_edit.required' => 'Dokumen Tidak Boleh Kosong!',
                    'nomor_peralatan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'nama_peralatan_edit.required' => 'Nama Dokumen Tidak Boleh Kosong!',
                    'nama_peralatan_edit.unique' => 'Nama Dokumen Tidak Boleh Sama Dengan Dokumen Lain!',
                    'deskripsi_peralatan_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',
                ]);
                $file = $request->file('file_edit');
                $dok = $request->input('nama_peralatan_edit');
                $file_dokumen = $file->move('data_file', "$dok" . ".pdf");
                unlink("data_file/".$request->oldNamaPeralatan.".pdf");

                $data = [
                    'no_peralatan' => $request->nomor_peralatan_edit,
                    'nama_peralatan' => $request->nama_peralatan_edit,
                    'stok' => $request->deskripsi_peralatan_edit,
                    'file_foto' => $file_dokumen,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            } else {
                $request->validate([
                    'file_edit' => 'required',
                    'nomor_peralatan_edit' => 'required',
                    'deskripsi_peralatan_edit' => 'required',

                ],[
                    'file_edit.required' => 'Dokumen Tidak Boleh Kosong!',
                    'nomor_peralatan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'deskripsi_peralatan_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',
                ]);
                $file = $request->file('file_edit');
                $dok = $request->input('nama_peralatan_edit');
                $file_dokumen = $file->move('data_file', "$dok" . ".pdf");
                $data = [
                    'no_peralatan' => $request->nomor_peralatan_edit,
                    'nama_peralatan' => $request->nama_peralatan_edit,
                    'stok' => $request->deskripsi_peralatan_edit,
                    'file_foto' => $file_dokumen,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            }


            if ($this->DokumenModel->update_dokumen($data, $id_peralatan)) {
                return redirect('/dokumen_terbuka')->with('toast_success', 'Berhasil Edit Dokumen!');
            } else {
                return redirect('/dokumen_terbuka')->with('toast_success', 'Gagal Edit Dokumen!');
            }

        } else {
            if ($request->oldNamaPeralatan != $request->nama_peralatan_edit) {
                $request->validate([
                    'nomor_peralatan_edit' => 'required',
                    'nama_peralatan_edit' => 'required|unique:peralatan,nama_peralatan',
                    'deskripsi_peralatan_edit' => 'required',

                ],[
                    'nomor_peralatan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'nama_peralatan_edit.required' => 'Nama Dokumen Tidak Boleh Kosong!',
                    'nama_peralatan_edit.unique' => 'Nama Dokumen Tidak Boleh Sama Dengan Dokumen Lain!',
                    'deskripsi_peralatan_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',

                ]);
                $alamat_file = "data_file\\".$request->nama_peralatan_edit.".pdf";
                // rename("data_file/".$request->oldNamaDokumen.".pdf", "data_file/".$request->nama_dokumen_edit.".pdf");
                $data = [
                    'no_peralatan' => $request->nomor_peralatan_edit,
                    'nama_peralatan' => $request->nama_peralatan_edit,
                    'stok' => $request->deskripsi_peralatan_edit,
                    'file_foto' => $alamat_file,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            } else {
                $request->validate([
                    'nomor_peralatan_edit' => 'required',
                    'deskripsi_peralatan_edit' => 'required',

                ],[
                    'nomor_peralatan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'deskripsi_peralatan_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',

                ]);
                $data = [
                    'no_peralatan' => $request->nomor_peralatan_edit,
                    'stok' => $request->deskripsi_peralatan_edit,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            }
            if ($this->DokumenModel->update_dokumen($data, $id_peralatan)) {
                return redirect('/dokumen_terbuka')->with('toast_success', 'Berhasil Edit Dokumen!');
            } else {
                return redirect('/dokumen_terbuka')->with('toast_success', 'Gagal Edit Dokumen!');
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

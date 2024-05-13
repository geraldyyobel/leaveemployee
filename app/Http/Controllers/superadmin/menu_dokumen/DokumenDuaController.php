<?php

namespace App\Http\Controllers\superadmin\menu_dokumen;

use Response;
use App\Models\RuanganModel;
use Illuminate\Http\Request;
use App\Traits\notif_sidebar;
use App\Models\DokumenDuaModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\approval\PengarsipanDuaModel;

class DokumenDuaController extends Controller
{
    use notif_sidebar;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->DokumenDuaModel = new DokumenDuaModel();
        $this->PengarsipanDuaModel = new PengarsipanDuaModel();
        $this->notif = $this->approval_pending();
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
            'ruangan' => $this->DokumenDuaModel->getDokumenById($id),
            'dipinjam'    => $this->DokumenDuaModel->dokumenDipinjam($id),
        ];
        return view('superadmin.menu_dokumen.detail_dokumen_dua', $data, $this->notif);
    }


    // public function dokumen_terbuka_dua()
    // {
    //     $data = [
    //         'ruangan' => $this->DokumenDuaModel->allDataTerbuka(),
    //     ];
    //     return view('superadmin.menu_dokumen.dokumen_terbuka_dua', $data, $this->notif);
    // }

    public function dokumen_terbuka_dua()
    {
        $data = RuanganModel::select('*')
                ->get();
        return view('superadmin.menu_dokumen.dokumen_terbuka_dua', ['ruangan'=>$data], $this->notif);
    }

    // public function tampilsantri()
    // {
    //     $santri = SantriModel::select('*')
    //             ->get();
                
    //     return view('tampilsantri', ['santri' => $santri]);
    // }
    

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
                    'file_pengarsipan' => 'required|unique:ruangan,file_foto|max:50000|mimes:pdf',
                    'nama_dokumen_pengarsipan' => 'required',
                    'nomor_dokumen_pengarsipan' => 'required',
                    'nomor_dokumen_pengarsipan' => 'required|unique:ruangan,no_ruangan',
                    'kapasitas_dokumen_pengarsipan' => 'required',
                ],
                [
                    'file_pengarsipan.required' => 'File dokumen wajib diupload!',
                    'file_pengarsipan.mimes' => 'File dokumen wajib berekstensi .pdf',
                    'file_pengarsipan.max' => 'File dokumen tidak boleh lebih dari 50Mb',
                    'nama_dokumen_pengarsipan.required' => 'Nama Dokumen wajib diisi!',
                    'nomor_dokumen_pengarsipan.required' => 'Nomor Dokumen wajib diisi!',
                    'nomor_dokumen_pengarsipan.unique' => 'Nomor Dokumen sudah ada!',
                    'kapasitas_dokumen_pengarsipan.required' => 'Deskripsi wajib diisi!',
                ]
            );
            $file = $request->file('file_pengarsipan');
            $dok = $request->input('nama_dokumen_pengarsipan');
            $file_dokumen = $file->move($direktori_file, "$dok" . ".pdf");
            $data = [
                'no_ruangan' => $request->nomor_dokumen_pengarsipan,
                'nama_ruangan' => $request->nama_dokumen_pengarsipan,
                'kapasitas' => $request->kapasitas_dokumen_pengarsipan,
                'tgl_upload' => \Carbon\Carbon::now(),
                'file_foto' => $file_dokumen,
                'status_ruangan' => 'Tersedia',
                'created_at' => \Carbon\Carbon::now(),
            ];

            if ($this->DokumenDuaModel->addDokumen($data)) {
                $last_id_ruangan = $this->DokumenDuaModel->getLastIdDokumen();
                if (count($last_id_ruangan) == 1) {
                    $idDokumen = $last_id_ruangan[0]->id_ruangan;
                    $data2 = [
                        'status_pengarsipan' => 'Ya',
                        'created_at' => \Carbon\Carbon::now(),
                        'id_ruangan' => $idDokumen,
                        'id' => Auth::user()->id,
                    ];
                    $this->DokumenDuaModel->insert_pengarsipan($data2);
                }

                return redirect('/approval/pengarsipan_dua')->with('toast_success', 'Berhasil Arsip Dokumen!');
            }else {
                return redirect('/approval/pengarsipan_dua')->with('toast_error', 'Gagal Arsip Dokumen!');
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
    public function update(Request $request, $no_ruangan)
    {
        if ($request->input('jenis') == 'softdelete') {
            //untuk pengajuan retensi dokumen, ubah status_dokumen - table dokumen
            $update_ruangan = [
                'status_ruangan' => $request->input('status_dok'),
                'updated_at' => \Carbon\Carbon::now(),
            ];
            if ($this->DokumenDuaModel->softdelete_dokumen($update_ruangan, $no_ruangan)) {
                return redirect('/dokumen_terbuka_dua')->with('toast_success', 'Dokumen telah dihapus!');
            } else {
                return redirect('/dokumen_terbuka_dua');
            }
        }
    }

    public function edit_dokumen_dua(Request $request, $id_ruangan)
    {
        $jenis = strtolower($request->jenisDokumen);
        if ($request->file('file_edit') != null) {
            if ($request->oldNamaRuangan != $request->nama_ruangan_edit) {
                $request->validate([
                    'file_edit' => 'required',
                    'nomor_ruangan_edit' => 'required',
                    'nama_ruangan_edit' => 'required|unique:ruangan,nama_ruangan',
                    'deskripsi_dokumen_edit' => 'required',
                ],[
                    'file_edit.required' => 'Dokumen Tidak Boleh Kosong!',
                    'nomor_ruangan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'nama_ruangan_edit.required' => 'Nama Dokumen Tidak Boleh Kosong!',
                    'nama_ruangan_edit.unique' => 'Nama Dokumen Tidak Boleh Sama Dengan Dokumen Lain!',
                    'deskripsi_dokumen_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',

                ]);
                $file = $request->file('file_edit');
                $dok = $request->input('nama_ruangan_edit');
                $file_dokumen = $file->move('data_file', "$dok" . ".pdf");
                unlink("data_file/".$request->oldNamaRuangan.".pdf");
                $data = [
                    'no_ruangan' => $request->nomor_ruangan_edit,
                    'nama_ruangan' => $request->nama_ruangan_edit,
                    'kapasitas' => $request->deskripsi_dokumen_edit,
                    'file_foto' => $file_dokumen,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            } else {
                $request->validate([
                    'file_edit' => 'required',
                    'nomor_ruangan_edit' => 'required',
                    'deskripsi_dokumen_edit' => 'required',

                ],[
                    'file_edit.required' => 'Dokumen Tidak Boleh Kosong!',
                    'nomor_ruangan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'deskripsi_dokumen_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',

                ]);
                $file = $request->file('file_edit');
                $dok = $request->input('nama_ruangan_edit');
                $file_dokumen = $file->move('data_file', "$dok" . ".pdf");
                $data = [
                    'no_ruangan' => $request->nomor_ruangann_edit,
                    'nama_ruangan' => $request->nama_ruangan_edit,
                    'kapasitas' => $request->deskripsi_dokumen_edit,
                    'file_foto' => $file_dokumen,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            }


            if ($this->DokumenDuaModel->update_dokumen($data, $id_ruangan)) {
                return redirect('/dokumen_terbuka_dua')->with('toast_success', 'Berhasil Edit Dokumen!');
            } else {
                return redirect('/dokumen_terbuka_dua')->with('toast_success', 'Gagal Edit Dokumen!');
            }

        } else {
            if ($request->oldNamaRuangan != $request->nama_ruangan_edit) {
                $request->validate([
                    'nomor_ruangan_edit' => 'required',
                    'nama_ruangan_edit' => 'required|unique:ruangan,nama_ruangan',
                    'deskripsi_dokumen_edit' => 'required',

                ],[
                    'nomor_ruangan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'nama_ruangan_edit.required' => 'Nama Dokumen Tidak Boleh Kosong!',
                    'nama_ruangan_edit.unique' => 'Nama Dokumen Tidak Boleh Sama Dengan Dokumen Lain!',
                    'deskripsi_dokumen_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',

                ]);
                $alamat_file = "data_file\\".$request->nama_ruangan_edit.".pdf";
                // rename("data_file/".$request->oldNamaRuangan.".pdf", "data_file/".$request->nama_ruangan_edit.".pdf");
                $data = [
                    'no_ruangan' => $request->nomor_ruangan_edit,
                    'nama_ruangan' => $request->nama_ruangan_edit,
                    'kapasitas' => $request->deskripsi_dokumen_edit,
                    'file_foto' => $alamat_file,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            } else {
                $request->validate([
                    'nomor_ruangan_edit' => 'required',
                    'deskripsi_dokumen_edit' => 'required',

                ],[
                    'nomor_ruangan_edit.required' => 'Nomor Dokumen Tidak Boleh Kosong!',
                    'deskripsi_dokumen_edit.required' => 'Deskripsi Dokumen Tidak Boleh Kosong!',

                ]);
                $data = [
                    'no_ruangan' => $request->nomor_ruangan_edit,
                    'kapasitas' => $request->deskripsi_dokumen_edit,
                    'updated_at' => \Carbon\Carbon::now(),

                ];
            }
            if ($this->DokumenDuaModel->update_dokumen($data, $id_ruangan)) {
                return redirect('/dokumen_terbuka_dua')->with('toast_success', 'Berhasil Edit Dokumen!');
            } else {
                return redirect('/dokumen_terbuka_dua')->with('toast_success', 'Gagal Edit Dokumen!');
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

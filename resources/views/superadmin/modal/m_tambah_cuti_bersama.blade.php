<div class="modal fade" id="cuti_bersama" tabindex="-1" aria-labelledby="cuti_bersama"
     aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajukan Cuti Bersama</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM PEMINJAMAN DOKUMEN-->
                    <form action="/input_cuti_bersama" method="post" enctype="multipart/form-data">
                        @csrf

                    <div class="form-group">
                    <label for="nama_cuti">Nama Cuti</label>
                    <input type="text" class="form-control" id="nama_cuti" name="nama_cuti" aria-describedby="emailHelp" >
                    </div>
                        <div class="form-group">
                            <label for="tgl_ambil">Tanggal Cuti</label>
                            <input type="date" class="form-control" id="tgl_cuti" name="tgl_cuti"
                                aria-describedby="emailHelp" value="{{ old('tgl_cuti') }}">

                        </div>
                        <div class="form-group">
                            <label for="tgl_ambil">Beri Pengumuman/Catatan</label>
                            <input type="text" class="form-control" id="catatan" name="catatan"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="tgl_ambil">Point Cuti</label>
                            <input type="text" class="form-control" id="point" name="point"
                                aria-describedby="emailHelp">
                        </div>

                    <!-- <input type="text" name="kuota_cuti" id="file_pendukung" value="" hidden> -->

                        <div class="form-group">
                        <label for="file_pengarsipan">Upload Surat Keputusan (*bila ada)</label>
                         <div class="form-group">
                            <div class="">
                                <input type="file" name="surat" id="file_pendukung">
                            </div>
                            <span class="text-danger" style="font-size: 12px">*Max file 50MB & Format PDF | cth: surat sakit, surat izin, dll</span>
                        </div>
                    </div>
                    
                        <button type="submit" class="btn btn-primary tombol-aksi float-right mt-3">Ajukan</button>
                        
                    </form>
                </div>
                <!--END FORM PEMINJAMAN DOKUMEN-->
            </div>
        </div>
    </div>


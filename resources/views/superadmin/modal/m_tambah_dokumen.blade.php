<div class="modal fade" id="tambah_dokumen" tabindex="-1" aria-labelledby="tambah_dokumen" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Form Pengajuan Cuti Karyawan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!--FORM TAMBAH-->
                <!-- <form action="/input_pengarsipan" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="jenis" type="text" value="Pengarsipan" hidden>
                    <div class="form-group">
                        <label for="nomor_dokumen_pengarsipan"><b>ID Karyawan </b></label>
                        <input type="text" class="form-control" id="nomor_dokumen_pengarsipan"
                            name="nomor_dokumen_pengarsipan" value="{{ old('nomor_dokumen_pengarsipan') }}">
                            <span class="text-danger" style="font-size: 12px">*ID karyawan harus benar, jika salah tidak akan di approve</span>
                        
                            @error('nomor_dokumen_pengarsipan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_dokumen_pengarsipan"><b>Nama</b></label>
                        <input type="text" class="form-control" id="nama_dokumen_pengarsipan"
                            name="nama_dokumen_pengarsipan" value="{{ old('nama_dokumen_pengarsipan') }}">
                        @error('nama_dokumen_pengarsipan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stok_dokumen_pengarsipan"><b>Lama Cuti</b></label>
                        <input type="text" class="form-control" id="stok_dokumen_pengarsipan"
                            name="stok_dokumen_pengarsipan" value="{{ old('stok_dokumen_pengarsipan') }}">
                        @error('stok_dokumen_pengarsipan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file_pengarsipan">Upload File Pendukung</label>
                         <div class="form-group">
                            <div class="">
                                <input type="file" name="file_pengarsipan" id="file_pengarsipan">
                                @error('file_pengarsipan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                            <span class="text-danger" style="font-size: 12px">*Max file 50MB & Format PDF | cth: surat sakit, surat izin, dll</span>
                       
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary tombol-aksi float-right">Ajukan</button>
                    <button class="btn btn-danger tombol-aksi float-right" type="button"
                        data-bs-dismiss="modal">Batal</button> -->
                <!-- </form> -->
                <div style="text-align: center;">
    <span class="badge badge-danger">Pengajuan ditolak!</span> <p></p>
    please use your <span class="badge badge-warning"> user</span> account to apply for leave
</div>
<!--END FORM TAMBAH-->
            </div>

        </div>
    </div>
</div>

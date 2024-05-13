<div class="modal fade" id="tambah_dokumen" tabindex="-1" aria-labelledby="tambah_dokumen" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Form Pengarsipan Ruangan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!--FORM TAMBAH-->
                <form action="/input_pengarsipan_dua" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="jenis" type="text" value="Pengarsipan" hidden>
                    <div class="form-group">
                        <label for="nomor_dokumen_pengarsipan"><b>Nomor Ruangan </b></label>
                        <input type="text" class="form-control" id="nomor_dokumen_pengarsipan"
                            name="nomor_dokumen_pengarsipan" value="{{ old('nomor_dokumen_pengarsipan') }}">
                        @error('nomor_dokumen_pengarsipan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_dokumen_pengarsipan"><b>Nama Ruangan</b></label>
                        <input type="text" class="form-control" id="nama_dokumen_pengarsipan"
                            name="nama_dokumen_pengarsipan" value="{{ old('nama_dokumen_pengarsipan') }}">
                        @error('nama_dokumen_pengarsipan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kapasitas_dokumen_pengarsipan"><b>Kapasitas Ruangan</b></label>
                        <input type="text" class="form-control" id="kapasitas_dokumen_pengarsipan"
                            name="kapasitas_dokumen_pengarsipan" value="{{ old('kapasitas_dokumen_pengarsipan') }}">
                        @error('kapasitas_dokumen_pengarsipan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file_pengarsipan">Upload File</label>
                        <span class="text-danger" style="font-size: 12px">*Max file 50MB & Format dokumen harus
                            berformat PDF</span>
                        <div class="form-group">
                            <div class="">
                                <input type="file" name="file_pengarsipan" id="file_pengarsipan">
                                @error('file_pengarsipan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary tombol-aksi float-right">Ajukan</button>
                    <button class="btn btn-danger tombol-aksi float-right" type="button"
                        data-bs-dismiss="modal">Batal</button>
                </form>
                <!--END FORM TAMBAH-->
            </div>

        </div>
    </div>
</div>

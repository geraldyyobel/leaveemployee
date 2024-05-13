@foreach ($peralatan as $item)
    <div class="modal fade" id="editRuangan{{ $item->id_peralatan }}" tabindex="-1" aria-labelledby="tambah_peralatan"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Form Edit Peralatan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!--FORM TAMBAH-->
                    <form action="/peralatan/edit/{{ $item->id_peralatan }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input name="oldNamaPeralatan" type="text" value="{{ $item->nama_peralatan }}" hidden>
                        <div class="form-group">
                            <label for="nomor_peralatan_edit"><b>Nomor Peralatan</b></label>
                            <input type="text" class="form-control" id="nomor_peralatan_edit" name="nomor_peralatan_edit"
                                value="{{ $item->no_peralatan }}">
                            @error('nomor_peralatan_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_peralatan_edit"><b>Nama Peralatan</b></label>
                            <input type="text" class="form-control" id="nama_peralatan_edit" name="nama_peralatan_edit"
                                value="{{ $item->nama_peralatan }}">
                            {{-- @error('nama_peralatan_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_peralatan_edit"><b>Deskripsi Peralatan</b></label>
                            <input type="text" class="form-control" id="deskripsi_peralatan_edit"
                                name="deskripsi_peralatan_edit" value="{{ $item->kapasitas }}">
                            {{-- @error('deskripsi_peralatan_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>                     
                        <div class="form-group">
                            <label for="file_edit">Upload File</label>
                            <span class="text-danger" style="font-size: 12px">*Max file 50MB & Format peralatan harus
                                berformat PDF</span>
                            <div class="form-group">
                                <div class="">
                                    {{-- <label for="file_edit"></label> --}}
                                    <input type="file" name="file_edit" id="file_edit"
                                        value="{{ $item->file_foto }}">
                                    {{-- @error('file_edit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror --}}
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
@endforeach

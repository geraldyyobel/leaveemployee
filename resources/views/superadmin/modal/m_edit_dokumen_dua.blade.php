@foreach ($ruangan as $item)
    <div class="modal fade" id="editRuangan{{ $item->id_ruangan }}" tabindex="-1" aria-labelledby="tambah_ruangan"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Form Edit Ruangan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!--FORM TAMBAH-->
                    <form action="/ruangan/edit/{{ $item->id_ruangan }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input name="oldNamaRuangan" type="text" value="{{ $item->nama_ruangan }}" hidden>
                        <div class="form-group">
                            <label for="nomor_ruangan_edit"><b>Nomor Ruangan</b></label>
                            <input type="text" class="form-control" id="nomor_ruangan_edit" name="nomor_ruangan_edit"
                                value="{{ $item->no_ruangan }}">
                            @error('nomor_ruangan_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_ruangan_edit"><b>Nama Ruangan</b></label>
                            <input type="text" class="form-control" id="nama_ruangan_edit" name="nama_ruangan_edit"
                                value="{{ $item->nama_ruangan }}">
                            {{-- @error('nama_ruangan_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        {{-- <div class="form-group">
                            <label for="tahun_dokumen_edit"><b>Tahun Ruangan</b></label>
                            <select class="form-control custom-select" name="tahun_dokumen_edit"
                                id="tahun_dokumen_edit">
                                <option selected disabled>--Pilih Tahun Ruangan--</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}"
                                        @if ($item->tahun_dokumen == $i) selected @endif>
                                        {{ $i }}</option>
                                @endfor
                            </select> --}}
                            {{-- @error('tahun_dokumen_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        {{-- </div> --}}
                        <div class="form-group">
                            <label for="deskripsi_dokumen_edit"><b>Deskripsi Ruangan</b></label>
                            <input type="text" class="form-control" id="deskripsi_dokumen_edit"
                                name="deskripsi_dokumen_edit" value="{{ $item->kapasitas }}">
                            {{-- @error('deskripsi_dokumen_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>                     
                        <div class="form-group">
                            <label for="file_edit">Upload File</label>
                            <span class="text-danger" style="font-size: 12px">*Max file 50MB & Format dokumen harus
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

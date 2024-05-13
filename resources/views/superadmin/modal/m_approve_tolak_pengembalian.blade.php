<!-- Modal Hapus -->
@foreach ($pengembalianperalatan as $item)
    <div class="modal fade" id="tolak_pengembalian{{ $item->id_pengembalian }}" tabindex="-1" role="dialog"
        aria-labelledby="delete_box" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="nama_pengembalian">Reject Pengarsipan Dokumen</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    Reject pengajuan pengembalian dokumen {{ $item->nama_peralatan }} ?
                </div>
                <form action="/pengembalian_dua/{{ $item->id_pengembalian }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Jenis input untuk memisahkan jenis update berdasarkan jenis --}}
                    <input name="jenis" type="text" value="tolak" hidden>

                    {{-- Value untuk Reject pengembalian - update ke table pengembalian --}}

                    <div class="modal-body">
                        <label for="catatan_tolak">Catatan</label>
                        <input type="text" cols="30" class="form-control" id="catatan_tolak"
                            name="catatan_tolak_pengembalian">
                        @error('catatan_tolak_pengembalian')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <input name="tgl_pengembalian" type="text" value="{{ $item->tgl_kembali }}" hidden>
                        <input name="id_dokumen" type="text" value="{{ $item->id_peralatan }}" hidden>
                        <input name="pengembalian" type="text" value="Tidak" hidden>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal retensi peralatan pada halaman peralatan -->
@foreach ($peralatan as $item)
    <div class="modal fade" id="softdelete_peralatan{{ $item->id_peralatan }}" tabindex="-1" role="dialog"
        aria-labelledby="delete_box" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="nama_retensi">Hapus Dokumen</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    Hapus peralatan {{ $item->nama_peralatan }} ?
                </div>
                <form action="/softdelete_dua/{{ $item->id_peralatan }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Jenis input untuk memisahkan jenis update berdasarkan jenis --}}
                    <input name="jenis" type="text" value="softdelete" hidden>

                    {{-- value untuk ubah status peralatan. update ke table peralatan --}}
                    <input name="status_dok" type="text" value="softdelete" hidden>

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal Hapus -->
@foreach ($peminjamanruangan as $item)
    <div class="modal fade" id="approve_peminjaman{{ $item->id_peminjaman }}" tabindex="-1" role="dialog"
        aria-labelledby="delete_box" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="id_peminjaman">Approve peminjaman Dokumen</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    Approve pengajuan peminjaman dokumen {{ $item->nama_ruangan }} ?
                </div>
                <form action="/peminjaman_dua/{{ $item->id_peminjaman }}" method="POST">
                    @csrf
                    @method('PUT')
                     {{-- Jenis input untuk memisahkan jenis update berdasarkan jenis --}}
                    <input name="jenis" type="text" value="approve" hidden>
                    <input name="tgl_peminjaman" type="text" value="{{ $item->tgl_ambil }}" hidden>
                    <input name="id_dokumen" type="text" value="{{ $item->id_ruangan }}" hidden>
                    {{-- value untuk ubah status peminjaman. update ke table peminjaman --}}
                    <input name="peminjaman" type="text" value="Ya" hidden>

                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

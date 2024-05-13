<!-- Modal Hapus -->
@foreach ($pengarsipanruangan as $item)
    <div class="modal fade" id="approve_pengarsipan{{ $item->id_ruangan }}" tabindex="-1" role="dialog"
        aria-labelledby="delete_box" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="nama_retensi">Approve Pengarsipan Dokumen</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body ml-2 mr-2">
                    <form action="/pengarsipan_dua/{{ $item->id_ruangan }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Jenis input untuk memisahkan jenis update berdasarkan jenis --}}
                        <input name="jenis" type="text" value="approve" hidden>

                        {{-- value untuk approve pengarsipan. update ke table pengarsipan --}}
                        <input name="pengarsipan" type="text" value="Ya" hidden>

                        {{-- value untuk ubah status dokumen. update ke table dokumen --}}
                        <input name="status_dok" type="text" value="Tersedia" hidden>

                        <p class="mt-3">Approve pengajuan pengarsipan dokumen {{ $item->nama_ruangan }} ?</p>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal Pengembalian Dokumen -->
<!-- @foreach ($peralatan as $item)
    <div class="modal fade" id="pengembalian_peralatan{{ $item->id_peminjaman }}" tabindex="-1" role="dialog"
        aria-labelledby="undo_peralatan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="undo_peralatan">Pengembalian Dokumen</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    Yakin Ingin Mengembalikan Dokumen <b>{{ $item->nama_peralatan }}</b>?
                </div>
                <form action="/input_pengembalian_peralatan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="id_peralatan" type="text" id="id_peralatan" value="{{ $item->id_peralatan }}" hidden>
                    <input name="id_peminjaman" type="text" value="{{ $item->id_peminjaman }}" hidden> -->
                    <!-- <input name="status_pengembalian" type="text" value="Pending" hidden> -->
                    <!-- <input name="tgl_kembali" type="text" value="{{ $item->tgl_kembali }}" hidden>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach -->

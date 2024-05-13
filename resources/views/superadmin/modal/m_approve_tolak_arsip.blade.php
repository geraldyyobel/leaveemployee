<!-- Modal Hapus -->

@foreach ($peminjamanperalatan as $item)
    <div class="modal fade" id="tolak_peminjaman{{ $item->id_peminjaman }}" tabindex="-1" role="dialog"
        aria-labelledby="delete_box" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="nama_peminjaman">Reject peminjaman Dokumen</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    Reject pengajuan peminjaman dokumen {{ $item->nama_peralatan }} ?
                </div>
                <form action="/peminjaman_dua/{{ $item->id_peminjaman }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input name="jenis" type="text" value="tolak" hidden>

                    <div class="modal-body">
                        <label for="catatan_tolak">Catatan</label>
                        <input type="text" cols="30" class="form-control" id="catatan_tolak" name="catatan_tolak_peminjaman">
                    </div>
                    @error('catatan_tolak_pengembalian')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    {{-- value untuk tolak peminjaman. - Update ke table peminjaman --}}
                    <input name="id_dokumen" type="text" value="{{ $item->id_peralatan }}" hidden>
                    <input name="peminjaman" type="text" value="Tidak" hidden>
                    <input name="tgl_pinjam" type="text" value="{{ $item->tgl_ambil }}" hidden>

                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- Perulangan untuk cek error --}}
<?php $listError = ['catatan_tolak_peminjaman']; ?>
@foreach ($listError as $err)
    @error($err)
        <script type="text/javascript">
             window.onload = function() {
                OpenBootstrapPopup();
            };

            function OpenBootstrapPopup() {
                $("#catatan_tolak_peminjaman").modal('show');
            }
        </script>
    @break
    @enderror
@endforeach

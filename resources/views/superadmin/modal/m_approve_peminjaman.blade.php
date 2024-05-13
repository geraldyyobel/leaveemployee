<!-- Modal Hapus -->




@foreach ($peralatan as $item)
    <div class="modal fade" id="approve_peminjaman{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="delete_box" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="id">Approve Cuti</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    Approve pengajuan Cuti dari {{ $item->name }} ?
                </div>
                <form action="/peminjaman/{{ $item->id}}" method="POST">

                

    @php
        // Cari item yang sesuai dalam $users
        $user = $users->where('id', $item->id_karyawan)->first();
        if ($user) {
            $a = $user->kuota_cuti;
            $b = $item->type_reason;
            $d = $item->jumlah_cuti;
            $c = $a - ($b*$d);
        } else {
            $c = 0; // Atau nilai default lainnya jika tidak ada hubungan yang ditemukan
        }
    @endphp





    @csrf
    @method('PUT')
    {{-- Jenis input untuk memisahkan jenis update berdasarkan jenis --}}
    <input name="jenis" type="text" value="approve" hidden>
    <input name="id" type="text" value="{{ $item->id }}" hidden>
    <input name="tgl_cuti" type="text" value="{{ $item->tgl_cuti }}" hidden>
    <input name="id_karyawan" type="text" value="{{ $item->real_id }}" hidden>
    <input name="acc_by" type="text" value="{{ auth()->user()->name }}" hidden>
    <input name="kuota_cuti" type="text" value="{{ $c }}" hidden>
    {{-- value untuk ubah status peminjaman. update ke table peminjaman --}}
    <!-- <input name="peminjaman" type="text" value="Ya" hidden> -->
    <div class="modal-body">
                        <label for="catatan">Catatan</label>
                        <input type="text" cols="30" class="form-control" id="catatan" name="catatan">
                    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" type="submit">Approve</button>
    </div>
</form>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal Hapus -->
@foreach ($users as $item)
    <div class="modal fade" id="delete_user{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="delete_user"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="nama_user">Hapus Data User</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    Yakin Ingin Menghapus User {{ $item->name }}?
                </div>
                <form action="/data_user/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success" type="submit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

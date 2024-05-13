@foreach ($users as $item)

<form action="{{ '/master_setup/data_user/'.$item->id }}" method="POST">
    <div class="modal fade" id="modaleditPassword_user{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Password</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                @csrf
                <!-- @method('put') -->
                <div class="modal-body">
                    @if (session("status"))
                        <div class="alert alert-success" role="alert" name="status">
                            {{ session('status') }}
                        </div>
                    @elseif(session("error"))
                        <div class="alert alert-danger" role="alert" name="status">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="form-group mt-4">
                        <label><b>New Password</b></label>
                        <input type="password" class="form-control" placeholder="Enter password" name="new_password" @error('new_password') is-invalid @enderror />
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label ><b>Confirm Password</b></label>
                        <input type="password" class="form-control" placeholder="Enter password confirmation" name="new_password_confirmation" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach

{{-- Perulangan untuk cek error --}}
<?php $listError = ['old_password', 'new_password']; ?>
@foreach ($listError as $err)
    @error($err)
        <script type="text/javascript">
            Swal.fire(
                'Gagal Update',
                '{{ $message }}',
                'error'
            );
        </script>
    @break
@enderror
@endforeach
<div class="modal fade" id="tambah_user" tabindex="-1" aria-labelledby="tambah_user" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!--FORM TAMBAH BARANG-->
                <form action="/data_user" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="nama_user">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user"
                            aria-describedby="emailHelp" value="{{ old('nama_user') }}">
                            @error('nama_user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_karyawan">ID User</label>
                        <input type="text" class="form-control" id="id_karyawan" name="id_karyawan"
                            aria-describedby="idHelp" value="{{ old('id_karyawan') }}">
                            @error('nama_user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="username_user">Username</label>
                        <input type="username" class="form-control" id="username_user" name="username_user"
                            aria-describedby="usernameHelp" value="{{ old('username_user') }}">
                            @error('username_user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            aria-describedby="emailHelp" value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_user">Status</label>
                        <select class="form-control" name="status_user" id="status_user">
                            <option selected disabled>--Pilih Status--</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        @error('status_user')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Roles</label>
                        <select class="form-control" name="role" id="role">
                            <option selected disabled>--Pilih Role--</option>
                                <option value="user" @if (old('role') == 'Terbuka') selected @endif>User</option>
                                <option value="admin" @if (old('role') == 'admin') selected @endif>Admin</option>
                                <option value="superadmin" @if (old('role') == 'superadmin') selected @endif>Super Admin</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary tombol-aksi float-right">Simpan</button>
                    <button class="btn btn-danger tombol-aksi float-right" type="button" data-bs-dismiss="modal">Batal</button>
                </form>
                <!--END FORM TAMBAH BARANG-->
            </div>

        </div>
    </div>
</div>

{{-- Perulangan untuk cek error --}}
<?php $listError = ['nama_user', 'username_user','password']; ?>
@foreach ($listError as $err)
    @error($err)
        <script type="text/javascript">
             window.onload = function() {
                OpenBootstrapPopup();
            };

            function OpenBootstrapPopup() {
                $("#tambah_user").modal('show');
            }
        </script>
    @break
    @enderror
@endforeach

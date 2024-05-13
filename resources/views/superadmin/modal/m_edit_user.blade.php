@foreach ($users as $item)
    <div class="modal fade" id="edit_user{{ $item->id }}" tabindex="-1" aria-labelledby="edit_user" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!--FORM TAMBAH USER-->
                    <form action="{{ '/data_user/' . $item->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_user_edit">Nama User</label>
                            <input type="text" value="{{ $item->name }}" class="form-control" id="nama_user_edit"
                                name="nama_user_edit" aria-describedby="emailHelp">
                            @error('nama_user_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username_user_edit">Username</label>
                            <input type="username" value="{{ $item->username }}" class="form-control" id="username_user_edit"
                                name="username_user_edit" aria-describedby="emailHelp">
                            <input type="text" name="old_username_edit" class="form-control"
                                value="{{ $item->username }}" hidden>

                            @error('username_user_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status_user_edit">Status</label>
                            <select class="form-control" name="status_user_edit" id="status_user_edit" value="{{ $item->aktif }}">
                                <option value="1" <?php if($item->aktif == 1 ) {
                                    echo 'selected';
                                } ?> > Aktif</option>
                                <option value="0" <?php if($item->aktif == 0) {
                                    echo 'selected';
                                } ?> > Tidak Aktif</option>
                            </select>
                            @error('status_user_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role_user_edit">Roles</label>
                            <select class="form-control" name="role_user_edit" id="role_user_edit" value="{{ $item->level }}">
                                <option value="user" <?php if($item->level == 'user') {
                                    echo 'selected';
                                } ?> >User</option>
                                <option value="admin" <?php if($item->level == 'admin') {
                                    echo 'selected';
                                } ?> >Admin</option>
                                <option value="superadmin" <?php if($item->level == 'superadmin') {
                                    echo 'selected';
                                } ?> >Super Admin</option>
                            </select>
                            @error('role_user_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_user_edit">Jatah Cuti </label>
                            <input type="text" value="{{ $item->kuota_cuti}}" class="form-control" id="nama_user_edit"
                                name="kuota_cuti_edit" aria-describedby="emailHelp">
                                <a style="color: red;">*sebelum dikurangin cuti bersama</a>
                            @error('nama_user_edit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary tombol-aksi float-right">Simpan</button>
                        <button class="btn btn-danger tombol-aksi float-right" type="button"
                            data-bs-dismiss="modal">Batal</button>
                    </form>
                    <!--END FORM TAMBAH BARANG-->
                </div>

            </div>
        </div>
    </div>
@endforeach

<?php $listError = ['nama_user_edit', 'username_user_edit','id_departemen_edit', 'status_user_edit', 'role_user_edit']; ?>
@foreach ($listError as $err)
    @error($err)
        <script type="text/javascript">
             window.onload = function() {
                OpenBootstrapPopup();
            };

            function OpenBootstrapPopup() {
                $("#edit_user{{ $item->id }}").modal('show');
            }
        </script>
    @break
    @enderror
@endforeach

@foreach ($user as $item)
<div class="modal fade" id="ajukan_cuti" tabindex="-1" aria-labelledby="ajukan_cuti"
     aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajukan Cuti</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM PEMINJAMAN DOKUMEN-->
                    <form action="/input_cuti/{id}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="enableName" name="enableName">
    <label class="form-check-label" for="enableName">Masukkan Nama Orang lain</label>
</div> -->

<div class="form-group">
    <label for="nama_peralatan">Nama</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{ auth()->user()->name }}" >
</div>
<div class="form-group">
    <label for="deskripsi_peralatan">ID Karyawan</label>
    <input type="deskripsi_peralatan" class="form-control" id="real_id" name="real_id" value="{{ auth()->user()->id_karyawan }}" >
    <input type="deskripsi_peralatan" class="form-control" id="id_karyawan" name="id_karyawan" value="{{ auth()->user()->id }}" hidden>
</div>


                        <div class="form-group">
                            <label for="tgl_ambil">Tanggal Cuti</label>
                            <input type="date" class="form-control" id="tgl_cuti" name="tgl_cuti"
                                aria-describedby="emailHelp" value="{{ old('tgl_cuti') }}">
                            @error('tgl_ambil')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="tgl_kembali">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali"
                                aria-describedby="emailHelp" value="{{ old('tgl_kembali') }}">
                            @error('tgl_kembali')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <p></p>
                        <div class="form-group">
    <label for="reason">Keperluan</label>
    <select class="form-control" id="type_reason" name="type_reason" aria-describedby="emailHelp" >
        <option value="1">Cuti tahunan</option>
        <option value="0.2">Sakit dengan surat dokter</option>
        <option value="0.5">Cuti Dispensasi 0.5 hari</option>
        <option value="0.5">Cuti Setengah Hari</option>
        <option value="1">Cuti Dispensasi</option>
        <option value="0.1">Sakit Dengan Surat Dokter - 0.5 hari</option>
        <option value="0">Cuti Ijin Khusus</option>
        <option value="0">Work From Home</option>
        <option value="0">Cuti Melahirkan</option>
        <option value="0">Dinas Luar</option>
    </select>
</div>
                    <!-- <input type="text" name="kuota_cuti" id="file_pendukung" value="" hidden> -->
                        <div class="form-group">
                            <label for="reason">Alasan Permohonan</label>
                            <input type="text" class="form-control" id="reason" name="reason"
                                aria-describedby="emailHelp" value="">
                        </div>
                        <div class="form-group">
                        <label for="file_pengarsipan">Upload File Pendukung</label>
                         <div class="form-group">
                            <div class="">
                                <input type="file" name="file_pendukung" id="file_pendukung">
                                @error('file_pengarsipan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <span class="text-danger" style="font-size: 12px">*Max file 50MB & Format PDF | cth: surat sakit, surat izin, dll</span>
                        </div>
                    </div>
                    
                        <button type="submit" class="btn btn-primary tombol-aksi float-right mt-3">Ajukan</button>
                        <button class="btn btn-danger tombol-aksi float-right mt-3" type="button"
                            data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
                <!--END FORM PEMINJAMAN DOKUMEN-->
            </div>
        </div>
    </div>
    <!-- end model -->
@endforeach 

{{-- Perulangan untuk cek error --}}
<?php $listError = ['tgl_cuti', 'tgl_kembali']; ?>
@foreach ($listError as $err)
    @error($err)
        <script type="text/javascript">
            window.onload = function() {
                OpenBootstrapPopup();
            };

            function OpenBootstrapPopup() {
                $("#pinjam_peralatan{{$item->id_karyawan}}").modal('show');
            }
        </script>
    @enderror
@endforeach

<!-- <script>
    document.getElementById('enableName').addEventListener('change', function() {
        var nameInput = document.getElementById('name');
        var idInput = document.getElementById('real_id');
        if (this.checked) {
            nameInput.removeAttribute('readonly');
            nameInput.removeAttribute('disabled');
            idInput.removeAttribute('readonly');
            idInput.removeAttribute('disabled');
        } else {
            nameInput.setAttribute('readonly', 'readonly');
            nameInput.setAttribute('disabled', 'disabled');
            idInput.setAttribute('readonly', 'readonly');
            idInput.setAttribute('disabled', 'disabled');
        }
    });
</script> -->


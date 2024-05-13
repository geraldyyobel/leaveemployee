@extends('layout.template') @section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Tabel Cuti Seluruh Karyawan</p>
            <!-- <p class="mb-0 text-gray-800 text-small"> PT Bumi Cahaya Unggul</p> -->
        </div>

        <div class="d-none d-sm-inline-block justify-content-end p-2">
            <button class="d-none d-sm-inline-block btn btn-success shadow-sm tombol" data-bs-toggle="modal"
                data-bs-target="#tambah_dokumen">
                <i class="fas fa-plus fa-sm text-white-80 mr-2"></i>
                Ajukan Cuti
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Karyawan</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Mulai Cuti</th>
                            <th>Selesai Cuti</th>
                            <th>Alasan</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- Ambil data dari controller --}}
                        @foreach ($peralatan as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->real_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_cuti)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_kembali)) }}</td>
                                <td>{{ $item->reason }}</td>
                                <td class="text-center">
                                    @if ($item->status_cuti == 'Disetujui')
                                        <span title="Dokumen Tersedia"
                                            class="badge badge-success p-2">{{ $item->status_cuti }}</span>
                                    @elseif ($item->status_cuti == 'Pending')
                                        <span title="Menunggu Approval Superadmin"
                                            class="badge badge-warning p-2">{{ $item->status_cuti }}</span>
                                    @else
                                        <span title="Dokumen sedang Dipinjam"
                                            class="badge badge-danger p-2">{{ $item->status_cuti }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                            <a title="Lihat Dokumen" class="btn btn-sm bg-primary text-white"
                                                href="/detail_dokumen/{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div>{{ $peralatan->links('pagination::bootstrap-5') }}</div> --}}
            </div>
        </div>
    </div>
    {{--
</div> --}}
    <?php
    $listErrorPengarsipan = ['nomor_dokumen_pengarsipan', 'nama_dokumen_pengarsipan', 'stok_dokumen_pengarsipan', 'deskripsi_dokumen_pengarsipan', 'file_pengarsipan',];
    $listErrorEdit = ['nomor_dokumen_edit', 'nama_dokumen_edit', 'stok_dokumen_edit', 'deskripsi_dokumen_edit', 'file_edit'];
    ?>
    <script>
        window.onload = function() {
            @foreach ($listErrorPengarsipan as $err)
                @error($err)
                    OpenBootstrapPopup();

                    function OpenBootstrapPopup() {
                        $("#tambah_dokumen").modal('show');
                    }
                    @break
                @enderror
            @endforeach
            @foreach ($listErrorEdit as $err)
                @error($err)
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Edit Gagal!',
                        text: '{{ $message }}',

                        animation: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 6000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    @break
                @enderror
            @endforeach          
        };
    </script>
    <!-- /.container-fluid -->
    @include('superadmin.modal.m_tambah_dokumen')
    @include('superadmin.modal.m_edit_dokumen')
    @include('superadmin.modal.m_delete_dokumen')
    @include('sweetalert::alert')
@endsection

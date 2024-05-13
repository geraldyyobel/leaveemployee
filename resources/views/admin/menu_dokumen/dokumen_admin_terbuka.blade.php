@extends('layout.template') @section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Dokumen</p>
            <p class="mb-0 text-gray-800 text-small">Table Dokumen Terbuka</p>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-3">
    <p class="mb-0 bg-primary rounded text-white p-2" style="margin-right: 1px;">
        <i class="far fa-calendar"></i>{{ date(' j F Y') }} | {{ date(' H:i')}} WIB
    </p>
    <button class="d-none d-sm-inline-block btn btn-success shadow-sm tombol" data-bs-toggle="modal" data-bs-target="#ajukan_cuti" style="margin-left: 1px;">

        <i class="fas fa-plus fa-sm text-white-80 mr-2"></i>
        Ajukan Cuti
    </button>
</div>

    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
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
                                        <span title="Disetujui"
                                            class="badge badge-success p-2">{{ $item->status_cuti }}</span>
                                    @elseif ($item->status_cuti == 'Pending')
                                        <span title="Menunggu Approval Superadmin"
                                            class="badge badge-warning p-2">{{ $item->status_cuti }}</span>
                                    @else
                                        <span title="Ditolak"
                                            class="badge badge-danger p-2">{{ $item->status_cuti }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                            <a title="Lihat Dokumen" class="btn btn-sm bg-primary text-white"
                                                href="/detail_dokumen_admin/{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div>{{ $peralatan->links('pagination::bootstrap-4') }}</div> --}}

        </div>
    </div>

    <!-- model -->
 
    

<!-- </div>  -->
    <script>
        <?php $listErrorPengarsipanAdmin = ['reason', 'tgl_cuti', 'tgl_kembali', 'file_pendukung'];
        $listErrorRetensiAdmin = ['reason', 'tgl_cuti', 'tgl_kembali', 'file_pendukung'];
        $listErrorPeminjamanAdmin = ['tgl_cuti', 'tgl_kembali'];
        ?>
        window.onload = function() {
            @foreach ($listErrorPengarsipanAdmin as $err)
                @error($err)
                    OpenBootstrapPopup();

                    function OpenBootstrapPopup() {
                        $("#tambah_peralatan_admin").modal('show');
                    }
                    @break
                @enderror
            @endforeach
        };
    </script>
    <!-- @if(session('toast_error'))
    <script>
        toastr.error('{{ session('toast_error') }}');
    </script>
@endif -->

   
    <!-- /.container-fluid -->
    @include('admin.modal.m_pinjam_dokumen')
    @include('sweetalert::alert')
@endsection

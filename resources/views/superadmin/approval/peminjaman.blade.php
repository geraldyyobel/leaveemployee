@extends('layout.template')
@section('content')
    <!-- Page Heading -->

    <div class="d-flex align-items-center mb-3">
    <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Transaksi</p>
    <p class="mb-0 text-gray-800 text-small">Data Approval Peminjaman</p>
    <div class="ml-auto">
        <a href="/approval/peminjaman/export" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
        <a class="btn btn-primary" href="/approval/peminjaman/exportCutiPDF">Export to PDF</a>
    </div>
</div>


    <!-- DataTales Example -->
    
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
                            <th>Approval</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- Ambil data dari controller --}}
                        @foreach ($peralatan as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->id_karyawan}}</td>
                                <td>{{ $item->name}}</td>
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
                                <td class="text-center">
                                    @if ($item->status_cuti == 'Pending')
                                        <button title="Setuju" class="btn btn-sm bg-success text-white" data-bs-toggle="modal"
                                            data-bs-target="#approve_peminjaman{{$item->id}}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button class="btn btn-sm bg-danger text-white" data-bs-toggle="modal"
                                            data-bs-target="#tolak_peminjaman{{$item->id}}">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    @else
                                    <span title="Dokumen Tersedia"
                                            class="badge badge-success p-2">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('superadmin.modal.m_approve_peminjaman')
    @include('superadmin.modal.m_approve_tolak_peminjaman')
    @include('sweetalert::alert')

@endsection

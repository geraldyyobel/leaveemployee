@extends('layout.template')
@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-3">
    <div class="d-flex align-items-center">
        <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Total Cuti</p>
        <p class="mb-0 text-gray-800 text-small">Seluruh Karyawan</p>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h4 class="text-success">
                            Cuti Bersama: <span class="badge badge-pill badge-success">{{ \App\Models\CutiBersamaModel::sum('point') }} Hari</span>
                        </h4>
                   
                </div>
                
            </div>
            
            <div class="d-flex align-items-center justify-content-between">
                
            <form action="/tidak_ketemu/hitung_cuti" method="GET" class="d-none d-sm-inline-block form-inline mw-100 navbar-search" style="justify-content: flex-end;">
    <div class="input-group">
        <input type="text" name="keyword" id="hitungSearch" class="form-control bg-light border-0 small" placeholder="Tulis ID/Nama Karyawan" aria-label="Search" aria-describedby="basic-addon2" value="{{ request('keyword') }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" onclick="copyKeyword()">Hitung Cuti <i class="fas fa-calculator fa-sm"></i></button>
        </div>
    </div>
</form>

<form action="/exportUserNotFoundPDF" method="GET" class="d-none d-sm-inline-block form-inline mw-100 navbar-search" style="justify-content: flex-end;">
    <input type="text" name="keyword_dua" id="exportSearch" class="form-control bg-light border-0 small" placeholder="Tulis ID/Nama Karyawan" aria-label="Search" aria-describedby="basic-addon2" value="{{ request('keyword') }}" hidden>

    <button class="btn btn-primary ml-auto">Export to PDF</button>
</form>

<script>
    function copyKeyword() {
        const hitungSearchInput = document.getElementById('hitungSearch');
        const exportSearchInput = document.getElementById('exportSearch');

        if (hitungSearchInput && exportSearchInput) {
            exportSearchInput.value = hitungSearchInput.value;
        }
    }
</script>

                

            </div>
                <table class="table table-bordered" id="hitung" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Cuti</th>
                            <th>Nama</th>
                            <th>Mulai Cuti</th>
                            <th>Selesai Cuti</th>
                            <th>Status Cuti</th>
                            <th>Alasan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    @php
                        $total = 0;
                    @endphp
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- Ambil data dari controller --}}
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->tgl_cuti }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
                                <td class="text-center">
                                    @if ($item->status_cuti == 'Disetujui')
                                        <span title="Disetujui" class="badge badge-success p-2">{{ $item->status_cuti }}</span>
                                    @elseif ($item->status_cuti == 'Pending')
                                        <span title="Menunggu Approval Superadmin" class="badge badge-warning p-2">{{ $item->status_cuti }}</span>
                                    @else
                                        <span title="Ditolak" class="badge badge-danger p-2">{{ $item->status_cuti }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->reason }}
                                    @if ($item->status_cuti == 'Disetujui')
                                        @php
                                            $total += $item->type_reason*$item->jumlah_cuti;
                                        @endphp
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
                <div class="card">
                    <h4 class="text-primary">
                        Cuti Terpakai: <span class="badge badge-pill badge-primary">{{ $total }} Hari</span>
                    </h4>
                </div>
                </div>
                    <div class="col-md-4">
                        <h4 class="text-info">
                            Sisa Cuti: <span class="badge badge-pill badge-info">{{ 12- $total - \App\Models\CutiBersamaModel::sum('point') }} Hari</span>
                        </h4>
                    </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

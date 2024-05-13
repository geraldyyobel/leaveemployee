@extends('layout.template')
@section('content')
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Arsip</p>
            <p class="mb-0 text-gray-800 text-small">Cuti Karyawan</p>
        </div>      
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-between mb-1 p-1">
                    <div></div>
                    <div></div>
                    <div class="d-flex align-items-center justify-content-between">
                    </div>
                </div>
                <div class="card-body">
        <div class="row">

            
            <div class="col-md-4 mb-3">
                <h4 class="text-success">
                    Cuti Bersama: <span class="badge badge-pill badge-success">{{ \App\Models\CutiBersamaModel::sum('point') }} Hari</span>
                </h4>
            </div>
            
            <div class="col-md-4">
                <h4 class="text-info">
                    Sisa Cuti: <span class="badge badge-pill badge-info">{{ auth()->user()->kuota_cuti - \App\Models\CutiBersamaModel::sum('point') }} Hari</span>
                </h4>
            </div>
        </div>
    </div>
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
                         $total= 0;
                         @endphp
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- Ambil data dari controller --}}
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->tgl_cuti }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
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
                                <td>
                                {{ $item->reason }}
                                @if($item->status_cuti == 'Disetujui')
                                        @php
                                        $total += ($item->type_reason*$item->jumlah_cuti);
                                        @endphp
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
                <div class="card">
                <h4 class="text-primary">
                                Cuti Terpakai: <span class="badge badge-pill badge-primary">{{$total }} Hari</span>
                            </h4>

            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection

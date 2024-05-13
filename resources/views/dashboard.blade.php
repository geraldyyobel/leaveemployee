@extends('layout.template')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <p class="h3 text-gray-800 mb-0 mr-1 font-weight-bold">Dashboard</p>
            <p class="mb-0 text-gray-800 text-small">Overview & Info Cuti Bersama</p>
        </div>
        <p class="mb-0 bg-primary rounded text-white p-2">
            <i class="far fa-calendar"></i>{{ date(' j F Y') }} | {{ date('  H:i')}} WIB
        </p>
    </div>

    @if(auth()->user()->level === 'superadmin')
    <button class="d-none d-sm-inline-block btn btn-success shadow-sm tombol" data-bs-toggle="modal" data-bs-target="#cuti_bersama" style="margin-left: 1px;">
        <i class="fas fa-plus fa-sm text-white-80 mr-2"></i>
        Tambah Cuti Bersama
    </button>
    @endif

    <div class="row">
        <div class="col-xl-8 mb-3 mt-2">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-success mb-2">
                                Pengumuman
                            </div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                            @if ($cuti && $cuti->last())
    {{ $cuti->last()->catatan }}
@endif
                        </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="text-gray-800 text-sm">RESMI</div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-3 mt-2">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-success mb-2">
                                Cuti Bersama
                            </div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                {{ $cuti->sum('point') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="text-gray-800 text-sm">Total Point Cuti Bersama Tahun ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Cuti</th>
                                    <th>Mulai Cuti</th>
                                    <th>catatan</th>
                                    <th>Poin Cuti</th>
                                    <th>Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Ambil data dari controller --}}
                                @foreach($cuti as $cuti)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cuti->nama_cuti }}</td>
                                        <td>{{ $cuti->tgl_cuti }}</td>
                                        <td>{{ $cuti->catatan }}</td>
                                        <td>{{ $cuti->point }}</td>
                                        <td>{{ $cuti->surat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('superadmin.modal.m_tambah_cuti_bersama')
@include('sweetalert::alert')

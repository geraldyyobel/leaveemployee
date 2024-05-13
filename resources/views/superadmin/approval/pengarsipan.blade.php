@extends('layout.template')
@section('content')
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Arsip</p>
            <p class="mb-0 text-gray-800 text-small">Cuti Karyawan</p>
        </div>

        
    </div>

    <!-- <div class="card shadow mb-4">
        <div class="card-body"> -->
            <!-- <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-between mb-1 p-1"> -->
                    <!-- <div></div>
                    <div></div> -->
                    <!-- <div class="d-flex align-items-center justify-content-between"> -->
                        <!-- <form action="/master_setup/data_cuti" method="GET"
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" name="keyword" id="cutiSearch"
                                    class="form-control bg-light border-0 small" placeholder="Search" aria-label="Search"
                                    aria-describedby="basic-addon2" value="{{ request('keyword') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form> -->
                        <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Mulai Cuti</th>
                            <th>Selesai Cuti</th>
                            <th>Alasan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    @php
                                        
                                        $total= 12;
                                        @endphp
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- Ambil data dari controller --}}
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->id_karyawan}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->tgl_cuti }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
                                <td>{{ $item->reason }}
                                    @if ($item->type_reason == 'Cuti tahunan')
                                        {{ $item->type_reason }}
                                        @php
                                        $cuti_tahunan = 1;
                                        $total= $total - $cuti_tahunan;
                                        @endphp
                                    @elseif ($item->type_reason == 'Sakit dengan surat dokter')
                                        {{ $item->type_reason }}
                                        @php
                                        $sakit_dokter = 0.2;
                                        $total= $total - $sakit_dokter;
                                        @endphp
                                    @elseif ($item->type_reason == 'Cuti Dispensasi 0.5 hari')
                                        {{ $item->type_reason }}
                                        @php
                                        $dispen_set_hari = 0.5;
                                        $total= $total - $dispen_set_hari;
                                        @endphp
                                    @elseif ($item->type_reason == 'Cuti Setengah Hari')
                                        {{ $item->type_reason}}
                                        @php
                                        $cuti_set_hari = 0.5;
                                        $total= $total - $cuti_set_hari;
                                        @endphp
                                    @elseif ($item->type_reason == 'Cuti Dispensasi')
                                        {{ $item->type_reason }}
                                        @php
                                        $cuti_dispen = 1;
                                        $total= $total - $cuti_dispen;
                                        @endphp
                                    @elseif ($item->type_reason == 'Sakit Dengan Surat Dokter - 0.5 hari')
                                        {{ $item->type_reason}}
                                        @php
                                        $sakit_set_hari_dokter = 0.1;
                                        $total= $total - $sakit_set_hari_dokter;
                                        @endphp
                                    @elseif ($item->type_reason == 'Cuti Ijin Khusus')
                                        {{ $item->type_reason }}
                                        @php
                                        $cuti_ijin_khusus = 0;
                                        $total= $total - $cuti_ijin_khusus;
                                        @endphp
                                    @elseif ($item->type_reason == 'Work From Home')
                                        {{ $item->type_reason }}
                                        @php
                                        $wfh = 0;
                                        $total= $total - $wfh;
                                        @endphp
                                    @elseif ($item->type_reason == 'Cuti Melahirkan')
                                        {{ $item->type_reason }}
                                        @php
                                        $melahirkan = 0;
                                        $total= $total - $melahirkan;
                                        @endphp
                                    @elseif ($item->type_reason == 'Dinas Luar')
                                        {{ $item->type_reason }}
                                        @php
                                        $dinas_luar = 0;
                                        $total= $total - $dinas_luar;
                                        @endphp
                                    @endif</td>
                            
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
                <h4>
                                @php
                            
                                @endphp
                                 
                                </h4>
                                {{-- <div>{{ $peralatan->links('pagination::bootstrap-5') }}</div> --}}
            </div>
        </div>
    </div>
 
    @include('sweetalert::alert')
@endsection

@extends('layout.template')
@section('content')
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Arsip</p>
            <p class="mb-0 text-gray-800 text-small">Cuti Karyawan</p>
        </div>

        <div class="ml-auto">
        <a href="/approval/peminjaman/exportUser" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
        <a class="btn btn-primary" href="/approval/peminjaman/exportPDF">Export to PDF</a>
    </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex align-items-center justify-content-between mb-1 p-1">
                    <div></div>
                    <div></div>
                    <div class="input-group">
                    <form action="/tidak_ketemu" method="GET">
    <button class="btn btn-danger" type="submit" style="float: left;">
        Tidak Ketemu <i class="fas fa-user-secret fa-sm"></i>
    </button>
</form>
    <!-- Isi elemen input Anda di sini -->
</div>

                    <div class="d-flex align-items-center justify-content-between">
                        <form action="/master_setup/hitung_cuti" method="GET"
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" name="keyword" id="hitungSearch"
                                    class="form-control bg-light border-0 small" placeholder="Tulis ID/Nama Karyawan" aria-label="Search"
                                    aria-describedby="basic-addon2" value="{{ request('keyword') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Hitung Cuti
                                        <i class="fas fa-calculator fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered" id="hitung" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Sisa Cuti</th>
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
                               <td> {{ $item->kuota_cuti - \App\Models\CutiBersamaModel::sum('point')}}</td>

                               
                            
                                <td class="text-center">
                                <form action="/approval/pengembalian/{{ $item->id }}" method="POST">
                        @csrf
                            <input type="text" value="{{ $item->id_karyawan }}" class="form-control" id="nama_user_edit"
                                name="id_karyawan" aria-describedby="emailHelp" hidden>
                        <button type="submit" class="btn btn-sm bg-primary text-white">Detail</button>             
                                    </div>
                                    </form>
                                </td>

                       
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
 
    @include('sweetalert::alert')
@endsection

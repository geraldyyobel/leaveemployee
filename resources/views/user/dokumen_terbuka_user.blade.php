@extends('layout.template')

@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center">
        <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Dokumen</p>
        <p class="mb-0 text-gray-800 text-small">Table Dokumen Terbuka</p>
    </div>

    <!-- Begin Page Content -->
    {{--
<div class="container-fluid"> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Dokumen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Dokumen</th>
                            <th>Nama Dokumen</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Upload</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- Ambil data dari controller --}}
                        @foreach ($dokumen as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->no_dokumen }}</td>
                                <td>{{ $item->nama_dokumen }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->tgl_upload)) }}</td>
                                <td>{{ $item->status_dokumen }}</td>
                                <td>
                                    <a class="btn btn-sm bg-primary text-white"
                                        href="/detail_dokumen_user/{{ $item->id_dokumen }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>{{ $dokumen->links('pagination::bootstrap-4') }}</div>
        </div>
    </div>
    {{--
</div> --}}
@endsection

@extends('layout.template')

@section('content')
    <!-- Page Heading -->
    @foreach ($dokumen as $item)

    <div class="d-flex align-items-center">
        <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Dokumen</p>
        <p class="mb-0 text-gray-800 text-small">Detail Dokumen {{ $item->name }}</p>
    </div>
        <div class="container row mt-3">
            <div class="col-lg-6 bg-white p-4 mb-2">
                <h4 class="bg-light p-2">Informasi Dokumen</h4>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">No. cuti</label>
                    <div class="col-sm-6">
                        <label class="col-form-label">{{ $item->id }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Nama user</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->name }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Tanggal apply</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->created_at }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Mulai Cuti</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ date('d-m-Y', strtotime($item->tgl_cuti)) }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Cuti Selesai</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ date('d-m-Y', strtotime($item->tgl_kembali))}}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Keperluan Cuti</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->type_reason}}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Alasan Permohonan</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->reason}}</label>
                    </div>
                </div>
                <hr>
                <hr>
                @if ($item->acc_by == '')
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Belum Disetujui</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">Cuti ini belum disetujui {{ $item->acc_by}}</label>
                    </div>
                </div>
@else
                <div class="row justify-content-md-center w-100">
    Telah ditandatanganin oleh : <span style="color: red;">  {{ $item->acc_by }}</span>
</div>
@endif
                
                <hr>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Catatan Dari Atasan</label>
                    <div class="col-sm-6 bg-white p-4 mb-2">
                    @if ($item->catatan == '')
                    <div class="row justify-content-md-center w-100">- Catatan Tidak Ada -</div>
                @else
                <label class=" col-form-label">{{ $item->catatan }}</label>
                @endif
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-lg-6 bg-white p-4 mb-2">
                <h4 class="bg-light p-2">Preview Dokumen</h4>
                @if ($item->file_pendukung == '')
                    <div class="row justify-content-md-center w-100">- File Dokumen Tidak Ada -</div>
                @else
                    <iframe src="{{ asset('uploads/' . $item->file_pendukung) }}" width="100%" height="500"
                        frameborder="0" style="border: 1px black solid;">
                    </iframe>
                @endif
            </div>
        </div>
    @endforeach
@endsection

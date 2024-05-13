@extends('layout.template')

@section('content')
    <!-- Page Heading -->
    @foreach ($dokumen as $item)
        <div class="d-flex align-items-center">
            <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Dokumen</p>
            <p class="mb-0 text-gray-800 text-small">Detail Dokumen {{ $item->jenis_dokumen }}</p>
        </div>
        <div class="container row mt-3">
            <div class="col-lg-6 bg-white p-4 mb-2">
                <h4 class="bg-light p-2">Informasi Dokumen</h4>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">No Dokumen</label>
                    <div class="col-sm-6">
                        <label class="col-form-label">{{ $item->no_dokumen }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Nama Dokumen</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->nama_dokumen }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Tahun Dokumen</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->tahun_dokumen }}</label>
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Deskripsi</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->deskripsi }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Kelengkapan Dokumen</label>
                    <div class="col-sm-6">
                        <label class=" col-form-label">{{ $item->nama_kel_dokumen }}</label>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Tanggal Upload</label>
                    <div class="col-sm-6">
                        <label class="col-form-label">{{ date('d-m-Y', strtotime($item->tgl_upload)) }}</label>
                    </div>
                </div>
                <hr>

                <h4 class="bg-light p-2">Lokasi Dokumen</h4>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Ruang</label>
                    <div class="col-sm-6">
                        @if ($item->nama_ruang == '')
                            <label class="col-form-label">-</label>
                        @else
                            <label class="col-form-label">{{ $item->nama_ruang }}</label>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Rak</label>
                    <div class="col-sm-6">
                        @if ($item->nama_rak == '')
                            <label class="col-form-label">-</label>
                        @else
                            <label class="col-form-label">{{ $item->nama_rak }}</label>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Box</label>
                    <div class="col-sm-6">
                        @if ($item->nama_box == '')
                            <label class="col-form-label">-</label>
                        @else
                            <label class="col-form-label">{{ $item->nama_box }}</label>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5 col-form-label">Map</label>
                    <div class="col-sm-6">
                        @if ($item->nama_map == '')
                            <label class="col-form-label">-</label>
                        @else
                            <label class="col-form-label">{{ $item->nama_map }}</label>
                        @endif
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-lg-6 bg-white p-4 mb-2">
                @if (count($dipinjam) != 0)
                    @if ($dipinjam[0]->status_peminjaman != 'Tidak')
                        @if ($dipinjam[0]->status_pengembalian != 'Ya')
                            <h4 class="bg-light p-2">Status Peminjaman</h4>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-5 col-form-label">Nama Peminjam</label>
                                {{-- {{ json_encode($dipinjam) }} --}}
                                <div class="col-sm-6">
                                    <label class=" col-form-label">{{ $dipinjam[0]->name }}</label>
                                </div>
                            </div>
                            <hr>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Tanggal Kembali</label>
                                <div class="col-sm-6">
                                    <label
                                        class=" col-form-label">{{ date('d-m-Y', strtotime($dipinjam[0]->tgl_kembali)) }}</label>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
                <h4 class="bg-light p-2">Preview Dokumen</h4>
                @if ($item->file_dokumen == '')
                    <div class="row justify-content-md-center w-100">- File Dokumen Tidak Ada -</div>
                @else
                    <iframe src="{{ URL::to('/') }}/showPdfUser/{{ $item->nama_dokumen }}" width="100%" height="600"
                        frameborder="0" style="border: 1px black solid;">
                    </iframe>
                @endif
            </div>
        </div>
    @endforeach
@endsection

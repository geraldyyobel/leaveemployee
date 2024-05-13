


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td,
        th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 18px;
        }


    </style>

</head>
@php
                        $total = 0;
                    @endphp
<body>

  <div class="d-flex align-items-center justify-content-between mb-3">
    <div class="d-flex align-items-center">
        <p class="h3 mb-0 text-gray-800 mr-1 font-weight-bold">Total Cuti Karyawan PT Bumi Cahaya Unggul</p>
        <p class="mb-0 text-gray-800 text-small">Tanggal Cetak : {{ date(' j F Y') }} | {{ date('  H:i:s')}} WIB </p>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-body">
                
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
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        {{-- Ambil data dari controller --}}
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->real_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->tgl_cuti }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
                                <td class="text-center">
                                    @if ($item->status_cuti == 'Disetujui')
                                        <span title="Disetujui" class="badge badge-success p-2">{{ $item->status_cuti }}</span>
                                        @php
                                            $total = $total + ($item->type_reason*$item->jumlah_cuti);
                                        @endphp
                                    
                                        @elseif ($item->status_cuti == 'Pending')
                                        <span title="Menunggu Approval Superadmin" class="badge badge-warning p-2">{{ $item->status_cuti }}</span>
                                    @else
                                        <span title="Ditolak" class="badge badge-danger p-2">{{ $item->status_cuti }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->reason }}
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
                <div class="card">
                    <h4 class="text-primary">
                        Cuti Terpakai: <span class="badge badge-pill badge-primary">{{ $total }} Hari</span>
                    </h4>
                    <h4 class="text-success">
                            Cuti Bersama: <span class="badge badge-pill badge-success">{{ \App\Models\CutiBersamaModel::sum('point') }} Hari</span>
                        </h4>
                </div>
                        <h4 class="text-info">
                            Sisa Cuti: <span class="badge badge-pill badge-info">{{ 12- $total - \App\Models\CutiBersamaModel::sum('point') }} Hari</span>
                        </h4>
                    </div>
            </div>
        </div>
    </div>

    </body>



<!DOCTYPE html>
<html lang="en">

@media print {
    body {
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%; /* Lebarnya 100% untuk menghindari tabrakan dengan margin */
    }
}

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <style>
        table {
            border-collapse: collapse;
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

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            table {
                width: 100%;
            }
        }
    </style>

</head>

<body>
    <div style="width: 95%; margin: 0 auto;">
        
        <div style="width: 100%; float: center;">
            <h1>Kuota Cuti Karyawan</h1>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Catatan</th>
                <th>Tanggal Pengajuan</th>
                <th>Disetujui oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td data-column="First Name">{{ $user->real_id }}</td>
                    <td data-column="Last Name">{{ $user->name }}</td>
                    <td data-column="Last Name">{{ $user->reason }}</td>
                    <td data-column="Last Name">{{ $user->status_cuti }}</td>
                    <td data-column="Date">
                        {{ date('F j, Y', strtotime($user->tgl_cuti)) }}
                    </td>
                    <td data-column="Date">
                        {{ date('F j, Y', strtotime($user->tgl_kembali)) }}
                    </td>
                    <td data-column="Last Name">{{ $user->catatan }}</td>
                    <td data-column="Date">
                        {{ date('F j, Y', strtotime($user->created_at)) }}
                    </td>
                    <td data-column="Date">
                        {{$user->acc_by }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

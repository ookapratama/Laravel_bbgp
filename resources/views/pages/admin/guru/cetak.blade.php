<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Tenaga Pendidik</title>
    <style>
        /* Gaya CSS */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            max-width: 100%;
            word-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .img-fluid {
            max-width: 100px;
            height: auto;
        }
        .badge {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            color: #fff;
            background-color: #138496;
            border-color: #117a8b;
        }
        .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            color: #212529;
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <h2>Data Tenaga Pendidik</h2>
    <table>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Pas Foto</th>
                <th>NPSN Sekolah</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor KTP</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Alamat Rumah</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Status Kepegawaian</th>
                <th>Agama</th>
                <th>Pendidikan Terakhir</th>
                <th>Kabupaten/Kota</th>
                <th>Satuan Pendidikan</th>
                <th>Kecamatan</th>
                <th>Nomor Aktif</th>
                <th>No Rekening</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $i => $data)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><img src="{{ public_path('/upload/guru/' . $data->pas_foto) }}" alt="" class="img-fluid"></td>
                <td>{{ $data->npsn_sekolah }} - {{ $data->sekolah->nama_sekolah ?? '' }}</td>
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->no_ktp }}</td>
                <td>{{ $data->tempat_lahir }}, {{ $data->tgl_lahir }}</td>
                <td>{{ $data->alamat_rumah }}</td>
                <td>{{ $data->gender }}</td>
                <td>{{ $data->jabatan }}</td>
                <td>{{ $data->status_kepegawaian }}</td>
                <td>{{ $data->agama }}</td>
                <td>{{ $data->pendidikan }}</td>
                <td>{{ $data->kabupaten }}</td>
                <td>{{ $data->satuan_pendidikan }}</td>
                <td>{{ $data->alamat_satuan }}</td>
                <td>No. Hp : {{ $data->no_hp }} <br> No. Whatsapp : {{ $data->no_wa }}</td>
                <td>{{ $data->no_rek }}</td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

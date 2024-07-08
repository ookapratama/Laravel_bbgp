<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Honor {{ ucfirst($jenis) }}</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Daftar Honor {{ ucfirst($jenis) }}</h2>
    <table>
        <thead>
            <tr >
                <th style="width: 10px" rowspan="2">No</th>
                <th  style="width: 250px; " rowspan="2">Nama Lengkap</th>
                <th style="width: 10px" rowspan="2">Gol</th>
                <th  colspan="3">Perhitungan</th>
                <th  rowspan="2">Jumlah Diterima</th>
            </tr>
            <tr>
                <th style="width: 10px">Realisasi JP</th>
                <th >Jumlah</th>
                <th >Pot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $i => $honor)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $honor['nama'] }} Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod placeat ab veritatis.</td>
                    <td>{{ explode('/', $honor['golongan'])[0] }}</td>
                    <td>{{ $honor['jp_realisasi'] }}</td>
                    <td>{{ $honor['jumlah'] }}</td>
                    <td>{{ $honor['pot'] }}</td>
                    <td>{{ $honor['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

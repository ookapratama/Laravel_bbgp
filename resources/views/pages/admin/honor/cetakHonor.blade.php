<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Honor {{ ucfirst($jenis) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
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

        ,
        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 80px;
            /* Sesuaikan ukuran gambar */
            height: auto;
        }

        .kop-surat .kop-text {
            flex-grow: 1;
            font-size: 14px;

            /* Biarkan teks tumbuh dan menempati ruang */
            padding: 0 10px;
            /* Beri sedikit jarak antara teks dan gambar */
        }

        .kop-surat h1,
        .kop-surat h2 {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="kop-surat" style="position: relative;">
        <img style="position: absolute; left: 0; width: 110px" src="{{ asset('img_template/iconbbgp.png') }}"
            alt="Logo Kiri">
        <div class="kop-text">
            {{-- <h3>DAFTAR HONOR</h3> --}}
            {{-- <h4>DAFTAR HADIR PESERSTA</h4> --}}

            <h4>HONORARIUM FASILITATOR PAKET MODUL 3 (3.1, 3.2, 3.3), AKSI NYATA 2.3, JURNAL REFLEKSI <br> DWI MINGGUAN
                PROGRAM PENDIDIKAN GURU PENGGERAK ANGKATAN 9</h4>

            <h4>DALAM RANGKA PELATIHAN MODUL CALON GURU PENGGERAK (CGP) WILAYAH PROV. SULAWESI SELATAN</h4>

            <h4>SESUAI SK KEPALA BALAI BESAR GURU PENGGERAK , NO: /B7.6/GT.00.02/2023, TANGGAL DENGAN RINCIAN SBB:</h4>

            <h4>Kode Anggaran : </h4>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 10px" rowspan="2">No</th>
                <th style="width: 250px; " rowspan="2">Nama Lengkap</th>
                <th style="width: 10px" rowspan="2">Gol</th>
                <th colspan="3">Perhitungan</th>
                <th rowspan="2">Jumlah Diterima</th>
            </tr>
            <tr>
                <th style="width: 10px">Realisasi JP</th>
                <th>Jumlah</th>
                <th>Pot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $i => $honor)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $honor['nama'] }} </td>
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

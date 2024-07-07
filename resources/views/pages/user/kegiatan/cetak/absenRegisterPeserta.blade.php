<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .kop-surat img {
            width: 110px;
            height: auto;
        }

        .kop-surat img.logo-kanan {
            width: 150px;
        }

        .kop-surat .kop-text {
            flex-grow: 1;
            text-align: center;
            padding: 0 20px;
        }

        .kop-surat h3,
        .kop-surat h4 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .page-break {
            page-break-after: always;
        }

        .no-border {
            border: none;
        }
    </style>
</head>

<body>
    <div class="kop-surat" style="position: relative;">
        <img src="{{ asset('img_template/iconbbgp.png') }}" style="position: absolute; left: 0; width: 110px"
            alt="Logo Kiri">
        <div class="kop-text">
            <h3>DAFTAR REGISTRASI PESERTA</h3>
            <?php
            setlocale(LC_TIME, 'id_ID.UTF-8');
            
            $tgl_kegiatan = strftime('%d %B', strtotime($kegiatan->tgl_kegiatan));
            $tgl_selesai = strftime('%d %B %Y', strtotime($kegiatan->tgl_selesai));
            ?>
            <h4>{{ $kegiatan->nama_kegiatan }}<br> {{ $kegiatan->tempat_kegiatan }} <br> {{ $tgl_kegiatan }} -
                {{ $tgl_selesai }} </h4>
            {{-- <h4>Koordinasi Teknis Program Gerak Penggerak<br>Balai Besar Guru Penggerak Sulawesi Selatan</h4>
            <h4>TANGGAL: 11 - 13 OKTOBER 2023</h4> --}}
        </div>
        <h4 style="position: absolute; top: 0; right: 0; width: 150px">Lembar Registrasi Peserta</h4>
        {{-- <img class="logo-kanan" style="position: absolute; top: 0; right: 0; width: 150px" src="{{ asset('img_template/absenPeserta.png') }}" alt="Logo Kanan"> --}}
    </div>
    <table style="margin-top: 50px">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Instansi</th>
                <th rowspan="2">Golongan</th>
                <th rowspan="2">Jenis Kelamin</th>
                <th colspan="2">Kelengkapan Peserta</th>
                <th rowspan="2">TTD</th>
            </tr>
            <tr>
                <th>Transport</th>
                <th>Biodata</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $peserta)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $peserta->nama }}</td>
                    <td>{{ $peserta->instansi }}</td>
                    <td>{{ $peserta->golongan }}</td>
                    <td>{{ $peserta->jkl }}</td>
                    <td>{{ $peserta->kelengkapan_peserta_transport }}</td>
                    <td>{{ $peserta->kelengkapan_peserta_biodata }}</td>
                    <td style="height: 50px; width:60px;" class="{{ $key % 2 == 0 ? '' : '' }}"></td>
                </tr>
                @if (($key + 1) % 25 == 0)
        </tbody>
    </table>
    <div class="page-break"></div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Instansi</th>
                <th rowspan="2">Golongan</th>
                <th rowspan="2">Jenis Kelamin</th>
                <th colspan="2">Kelengkapan Peserta</th>
                <th rowspan="2">TTD</th>
            </tr>
            <tr>
                <th>Transport</th>
                <th>Biodata</th>
            </tr>
        </thead>
        <tbody>
            @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>

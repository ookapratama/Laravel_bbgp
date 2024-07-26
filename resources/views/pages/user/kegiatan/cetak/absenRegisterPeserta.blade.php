<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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

        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="kop-surat" style="position: relative;">
        <img style="position: absolute; left: 0; top: -10px;" src="{{ asset('img_template/iconbbgp.png') }}" alt="Logo Kiri">
        <div class="kop-text">
            <h3>DAFTAR REGISTRASI PESERTA</h3>
            <?php
            setlocale(LC_TIME, 'id_ID.UTF-8');
            $tgl_kegiatan = strftime('%d %B', strtotime($kegiatan->tgl_kegiatan));
            $tgl_selesai = strftime('%d %B %Y', strtotime($kegiatan->tgl_selesai));
            ?>
            <h4>{{ $kegiatan->nama_kegiatan }}<br> {{ $kegiatan->tempat_kegiatan }} <br> {{ $tgl_kegiatan }} -
                {{ $tgl_selesai }} </h4>
        </div>
        <h4 style="position: absolute; top: 0; right: 0; width: 150px">Lembar Registrasi Peserta</h4>
    </div>
    <table style="margin-top: 50px">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th style="width:150px;" rowspan="2">Nama</th>
                <th style="width:150px;" rowspan="2">Instansi</th>
                <th style="width:20px !important; " rowspan="2">Gol</th>
                <th style="width:30px !important;" rowspan="2">L / P</th>
                <th style="width:30px;" colspan="2">Kelengkapan Peserta</th>
                <th style="width:100px;" rowspan="2">TTD</th>
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
                    <td>{{ $peserta->instansi }} </td>
                    <td>{{ $peserta->golongan }}</td>
                    <td>{{ $peserta->jkl == 'Perempuan' ? 'P' : 'L' }}</td>
                    <td></td>
                    <td></td>
                    <td style="{{ ($key + 1) % 2 == 0 ? 'text-align:right; padding-right: 50%;' : 'text-align:left;' }}" >{{ $key + 1 }}.</td>
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
                <th rowspan="2">L / P</th>
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
    <footer style="text-align: right; margin-right: 150px">
        <p>Panitia, </p>
    </footer>
</body>

</html>

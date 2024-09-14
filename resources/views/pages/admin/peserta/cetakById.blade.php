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
        }

        .kop-surat img {
            width: 80px;
            /* Sesuaikan ukuran gambar */
            height: auto;
        }

        .kop-surat .kop-text {
            flex-grow: 1;
            /* Biarkan teks tumbuh dan menempati ruang */
            padding: 0 10px;
            /* Beri sedikit jarak antara teks dan gambar */
        }

        .kop-surat h1,
        .kop-surat h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            /* border: 1px solid #000; */
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .page-break {
            page-break-after: always;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            text-transform: uppercase;
        }

        .biodata-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            /* border: 0 solid #fff; */

            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .biodata-table td {
            padding: 5px;
            vertical-align: top;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="kop-surat" style="position: relative;">
        <img style="position: absolute; left: 0; width: 110px" src="{{ asset('img_template/iconbbgp.png') }}"
            alt="Logo Kiri">
        <div class="kop-text">
            {{-- <h3>DAFTAR HADIR PANITIA</h3> --}}
            {{-- <h4>DAFTAR HADIR PESERSTA</h4> --}}
            <?php
            setlocale(LC_TIME, 'id_ID.UTF-8');
            
            // $tahunSekaran = strftime('%Y', strtotime($kegiatan->tgl_kegiatan));
            // $tgl_kegiatan = strftime('%d %B', strtotime($kegiatan->tgl_kegiatan));
            // {{ dd($getById); }}
            $tgl_lahir = strftime('%d %B %Y', strtotime($getById->tgl_lahir ?? date('d-m-Y')));
            
            ?>
            <div style="margin: 50px 0 0 100px; width:500px">
                <h2>{{ strtoupper($namaKegiatan) }} </h2>

            </div>
        </div>
        {{-- <h4>Koordinasi Teknis Program Gerak Penggerak<br>Balai Besar Guru Penggerak Sulawesi Selatan</h4> --}}
    </div>

    <img style="position: absolute; top: -25; right: 0; width: 220px"
        src="{{ public_path(
            'img_template/biodata/bio-' .
                ($peserta->status_keikutpesertaan == 'peserta'
                    ? 'peserta'
                    : ($peserta->status_keikutpesertaan == 'panitia'
                        ? 'panitia'
                        : 'narasumber')) .
                '.png',
        ) }}"
        alt="Logo Kanan">
    </div>
    <div style="margin-top: 20px">
        <div class="container">
            <table cellspacing="0" cellpadding="0" border="0" style="border: none !important;"
                class="biodata-table">
                <tr>
                    <td>1. Nama</td>
                    <td>: {{ $peserta->nama }}</td>
                </tr>
                <tr>
                    <td>2. N I P</td>
                    <td>: {{ $peserta->nip }}</td>
                </tr>
                <tr>
                    <td>3. Jenis Kelamin</td>
                    <td>: {{ $peserta->jkl }}</td>
                </tr>
                <tr>
                    <td>4. Tempat, Tanggal Lahir</td>
                    <td>: {{ $getById->tempat_lahir ?? 'Tidak terdata' }}, {{ $tgl_lahir }} </td>
                </tr>
                <tr>
                    <td>5. Agama</td>
                    <td>: {{ $getById->agama }} </td>
                </tr>

                <tr>
                    <td>6. Pangkat/Golongan</td>
                    <td>: {{ $peserta->golongan }} </td>
                </tr>
                <tr>
                    <td>7. Asal Kabupaten/Kota</td>
                    <td>: {{ $peserta->kabupaten }} </td>
                </tr>
                <tr>
                    <td>8. Instansi</td>
                    <td>: {{ $peserta->instansi }} </td>
                </tr>
                <tr>
                    <td>9. No. HP dan Whatsapp</td>
                    <td>: HP : {{ $peserta->no_hp }} <br> <span style="margin-left: 10px;"> WA : {{ $peserta->no_wa }}
                        </span>
                    </td>
                </tr>
                {{-- <tr>
                    <td>12. Alamat Rumah</td>
                    <td>: _____________________________________________________________</td>
                </tr> --}}
                <tr>
                    <td>10. Pendidikan Terakhir</td>
                    <td>: {{ $getById->pendidikan }} </td>
                </tr>
                @if (
                    $getById->eksternal_jabatan == 'Stakeholder' 
                    
                    )
                    <tr>
                        <td>11. Jabatan</td>
                        <td>: {{ $getById->jenis_jabatan }} </td>
                    </tr>
                @endif
            </table>
            <footer>
                <div style="font-size: 16px; margin-right:20px" class="signature">
                    <p>...................., .................... {{ date('Y') }}</p>
                    <br><br><br><br>
                    <p> {{ $peserta->nama }} </p>
                    <p>NIP. {{ $peserta->nip }} </p>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>

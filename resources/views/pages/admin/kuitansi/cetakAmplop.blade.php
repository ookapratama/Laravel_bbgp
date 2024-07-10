<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amlop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 20px;
            text-align: left; /* Pusatkan teks dalam tabel */
            
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh; /* Mengatur tinggi agar isi berada di tengah */
        }
        table {
            font-size: 18px;
        }
        .table-container {
            margin-left: 20px;
        }
        .table-container table {
            border-collapse: collapse;
            margin: 0 20px;
        }
        .table-container table td {
            border: 2px solid black;
            padding: 10px;
            min-width: 25px; /* Menyesuaikan lebar minimum */
            min-height: 25px; /* Menyesuaikan tinggi minimum */
            text-align: center; /* Pusatkan teks */
        }
        /* Atur lebar kolom kedua */
        .table-container table td:nth-child(2) {
            /* width: 400px; */
        }
        /* Hapus border tabel pertama */
        .no-border table {
            border: none !important;
        }
       
        ul {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }
        li > div {
            margin-left: 10px;
        }
        li > div:first-child {
            flex: 0 0 200px; /* Lebar tetap untuk teks kiri */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <ul>
            <li>
                <span><b>Nama Kegiatan</b></span>
                <span>: Pelatihan Penggunaan dan Pemanfaatan Chromebook</span>
            </li>
            <li>
                <span><b>Lokasi Kegiatan</b></span>
                <span>: BBGP Sulawesi Selatan</span>
            </li>
            <li>
                <span><b>Tanggal Kegiatan</b></span>
                <span>: 26 s.d 28 Maret 2024</span>
            </li>
            <!-- Tambahkan baris selanjutnya sesuai kebutuhan -->
        </ul>

        <div class="table-container">
            <table cellspacing="0" border="2" cellpadding="10">
                <tr>
                    <td>178</td>
                    <td style="text-align: left;" colspan="4">Nur Arif MS, S.Pd.,M.Pd.</td>
                </tr>
                <tr>
                    <td>a.</td>
                    <td style="width: 300px; text-align: left;">Terima</td>
                    <td style="width: 200px">Rp. </td>
                    <td style="width: 320px; text-align: left;" colspan="2">Keterangan</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2"></td>
                </tr>
                <!-- Tambahkan baris selanjutnya sesuai kebutuhan -->
              
            </table>
        </div>

        <div class="table-container">
            <table cellspacing="0" border="2" cellpadding="10">
                
                <tr>
                    <td>b.</td>
                    <td style="width: 300px; text-align: left;">Potongan</td>
                    <td style="width: 200px">Rp. </td>
                    <td style="width: 320px; text-align: left;" colspan="2"></td>
                </tr>
                <tr>
                   <td></td>
                   <td>Total Terima</td>
                   <td>Rp.</td>
                   <td colspan="2"></td>
                </tr>
                <!-- Tambahkan baris selanjutnya sesuai kebutuhan -->
              
            </table>
        </div>
    </div>
</body>
</html>

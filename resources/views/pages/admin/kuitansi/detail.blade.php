<!-- Contoh detail.blade.php -->
<?php
setlocale(LC_TIME, 'id_ID.UTF-8');

$tgl_surat = strftime('%d %B %Y', strtotime($kuitansi->tgl_surat_tugas));
?>
<p><strong>Nomor dan Tanggal Surat Tugas:</strong> <br> {{ $kuitansi->no_surat_tugas }} - {{ $tgl_surat }}</p>
<p><strong>Nama Lengkap:</strong> {{ $kuitansi->peserta->nama ?? '' }}</p>
<p><strong>NIP:</strong> {{ $kuitansi->peserta->pegawai->nip ?? '' }}</p>
<div class="row">
    <div class="col-md-6">
        <p><strong>Nomor Bukti:</strong> {{ $kuitansi->no_bukti }}</p>
        <p><strong>Nomor MAK:</strong> {{ $kuitansi->no_MAK }}</p>
        <p><strong>Jenis Angkutan:</strong> {{ $kuitansi->jenis_angkutan }}</p>
        <p><strong>Biaya:</strong> {{ $kuitansi->jenis_angkutan }}</p>
        <p><strong>Jenis Angkutan:</strong> {{ $kuitansi->jenis_angkutan }}</p>
        <!-- Tambahkan detail lainnya sesuai kebutuhan -->
    </div>
    <div class="col-md-6">
        <p><strong>Lokasi Asal:</strong> {{ $kuitansi->kabupaten->name }}</p>
        <p><strong>Lokasi Tujuan:</strong> {{ $kuitansi->lokasi_tujuan }}</p>
        <!-- Tambahan detail lainnya -->
    </div>
</div>

@extends('layouts.app', ['title' => 'Edit Honor'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Honor</h1>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('honor.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $datas->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Penerima</label>
                                                <select name="id_peserta" id="idPeserta" class="form-control select2">
                                                    <option value="">-- pilih peserta --</option>
                                                    @foreach ($peserta as $v)
                                                        <?php
                                                        setlocale(LC_TIME, 'id_ID.UTF-8');
                                                        $tgl_kegiatan = strftime('%d %B', strtotime($v->tgl_kegiatan));
                                                        $tgl_selesai = strftime('%d %B %Y', strtotime($v->tgl_selesai));
                                                        ?>
                                                        <option {{ $datas->id_peserta == $v->id ? 'selected' : '' }}
                                                            data-jabatan="{{ $v->status_keikutpesertaan }}"
                                                            data-golongan="{{ $v->golongan }}"
                                                            data-jabatan="{{ $v->jabatan }}"
                                                            data-mulai="{{ $tgl_kegiatan }}"
                                                            data-selesai="{{ $tgl_selesai }}"
                                                            data-kegiatan="{{ $v->kegiatan->nama_kegiatan }}"
                                                            value="{{ $v->id }}">
                                                            {{ $v->no_ktp . ' - ' . $v->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jabatan dalam kegiatan</label>
                                                <input readonly required name="jabatan" id="jabatan" type="text"
                                                    class="form-control" value="{{ $datas->peserta->status_keikutpesertaan }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <input readonly required name="golongan" id="golongan" type="text"
                                                    class="form-control" value="{{ $datas->golongan }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kegiatan yang diikuti</label>
                                                <input readonly required name="kegiatan" id="kegiatan" type="text"
                                                    class="form-control" value="{{ $datas->peserta->kegiatan->nama_kegiatan }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>JP Realisasi</label>
                                                <input required name="jp_realisasi" id="jp_realisasi" type="text"
                                                    class="form-control" value="{{ $datas->jp_realisasi }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input required name="jumlah" id="jumlah" type="text"
                                                    class="form-control rupiah" value="{{ $datas->jumlah }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jumlah Honor</label>
                                                <input readonly required name="jumlah_honor" id="jumlah_honor"
                                                    type="text" class="form-control rupiah"
                                                    value="{{ $datas->jumlah_honor }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Potongan</label>
                                                <input readonly required name="potongan" id="potongan" type="text"
                                                    class="form-control rupiah" value="{{ $datas->potongan }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jumlah Diterima</label>
                                                <input readonly required name="jumlah_diterima" id="jumlah_diterima"
                                                    type="text" class="form-control rupiah"
                                                    value="{{ $datas->jumlah_diterima }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('honor.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

        <script>
            $(document).ready(function() {
                // Event listener untuk select peserta
                $('#idPeserta').change(function() {
                    // Dapatkan data atribut dari option yang dipilih
                    var selectedOption = $(this).find('option:selected');
                    var jabatan = selectedOption.data('jabatan');
                    var golongan = selectedOption.data('golongan');
                    var kegiatan = selectedOption.data('kegiatan');
                    var tglKegiatan = selectedOption.data('mulai');
                    var tglSelesai = selectedOption.data('selesai');

                    // Isi input form dengan data yang sesuai
                    $('#jabatan').val(jabatan);
                    $('#golongan').val(golongan);
                    $('#kegiatan').val(kegiatan);
                });

                // Menambahkan perhitungan otomatis untuk jumlah honor
                $('#jp_realisasi, #jumlah').on('input', function() {
                    var jpRealisasi = parseFloat($('#jp_realisasi').val().replace(/[^0-9]/g, '')) || 0;
                    var jumlah = parseFloat($('#jumlah').val().replace(/[^0-9]/g, '')) || 0;
                    var jumlahHonor = jpRealisasi * jumlah;
                    var golongan = getGolonganValue($('#golongan').val());
                    var potongan = (golongan == 'IV') ? jumlahHonor * 0.15 : jumlahHonor * 0.5;
                    var jumlahDiterima = jumlahHonor - potongan;

                    $('#jumlah_honor').val(jumlahHonor);
                    $('#potongan').val(potongan);
                    $('#jumlah_diterima').val(jumlahDiterima);

                    // Format sebagai Rupiah
                    $('#jumlah_honor').val(formatRupiah(jumlahHonor));
                    $('#potongan').val(formatRupiah(potongan));
                    $('#jumlah_diterima').val(formatRupiah(jumlahDiterima));
                });

                // Masking untuk format Rupiah
                $('.rupiah').mask('000.000.000.000.000', {
                    reverse: true
                });
            });

            function getGolonganValue(value) {
                return value.split('/')[0].trim();
            }

            // Fungsi untuk memformat angka menjadi format Rupiah
            function formatRupiah(number) {
                var reverse = number.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                return ribuan.join('.').split('').reverse().join('');
            }
        </script>
    @endpush
@endsection

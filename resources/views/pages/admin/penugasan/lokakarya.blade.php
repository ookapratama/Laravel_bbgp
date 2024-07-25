@extends('layouts.app', ['title' => 'Internal'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Lokakarya</h1>
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form id="lokakaryaForm"
                            action="{{ route('internal.store.lokakarya') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nama Pendamping</label>
                                                <input  value="{{ $pegawai->nama_lengkap ??  $pegawai->nama }}" required name="nama"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input value="{{ $pegawai->no_ktp ??  $pegawai->nik }}" required name="nik" type="text"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input value="{{ $pegawai->nip  }}" required name="nip" type="text"
                                                    class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>-</label>
                                            <input required readonly name="jenis" type="text"
                                                value="Pendamping Lokakarya" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kabupaten / Kota</label>
                                            <select required name="kota" class="form-control select2">
                                                <option value="">-- Pilih kabupaten/kota --</option>
                                                @foreach ($datas['kota'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Mulai Kegiatan</label>
                                                <input type="text" name="mulai_kegiatan"
                                                    class="form-control datetimepicker">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Selesai Kegiatan</label>
                                                <input type="text" name="selesai_kegiatan"
                                                    class="form-control datetimepicker">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Transport Pulang</label>
                                                <input required name="transport_pulang" type="text" class="form-control currency">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Transport Pergi</label>
                                                <input required name="transport_pergi" type="text" class="form-control currency">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hotel</label>
                                                <input required name="hotel" type="text" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 1</label>
                                                <input required name="hari_1" type="text" class="form-control currency">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 2</label>
                                                <input required name="hari_2" type="text" class="form-control currency">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 3</label>
                                                <input required name="hari_3" type="text" class="form-control currency">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ session('role') == 'pegawai' ? route('pegawai.show', session('no_ktp')) : route('internal.index') }}"
                                        class="btn btn-warning">Kembali</a>
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
        <script>
            $(document).ready(function() {
                // Initialize Select2
                $('#selectNama').select2();

                // Handle change event on select element
                $('#selectNama').on('change', function() {
                    // Get selected option
                    var selectedOption = $(this).find(':selected');

                    // Get NIP from data-nip attribute
                    var nip = selectedOption.data('nip');

                    // Set NIP value to input field
                    $('input[name="nip"]').val(nip);
                });

                // Format currency
                $('.currency').on('input', function() {
                    var value = $(this).val();
                    $(this).val(formatRupiah(value, 'Rp '));
                });

                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
                }

                // Remove currency format before form submit
                $('#lokakaryaForm').on('submit', function() {
                    $('.currency').each(function() {
                        var value = $(this).val();
                        $(this).val(value.replace(/[^,\d]/g, ''));
                    });
                });
            });
        </script>
    @endpush
@endsection

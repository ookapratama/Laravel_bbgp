@extends('layouts.app', ['title' => 'Data Kuitansi'])
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
                <h1>Kuitansi - Rencana Biaya Perjalanan Dinas</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('kuitansi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Bukti</label>
                                                <input required name="no_bukti" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor MAK</label>
                                                <input required name="no_MAK" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tujuan Perjalanan</label>
                                                <input required name="no_MAK" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal Surat</label>
                                                <input required name="tgl_surat" type="date" class="form-control"
                                                    id="tgl_surat"  >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tahun Anggaran</label>
                                                <input required name="tahun_anggaran" type="text" class="form-control"
                                                    id="tahun_anggaran" readonly value="{{ date('Y') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Biaya Penginapan (Rp. )</label>
                                                <input required name="biaya_penginapan" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Biaya Uang Harian (Rp. )</label>
                                                <input required name="biaya_uang_harian" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Durasi Penginapan (hari)</label>
                                                <input required name="durasi_penginapan" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Durasi Uang Harian (hari)</label>
                                                <input required name="durasi_uang_harian" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Inputan Transportasi --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Transportasi</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jenis Transportasi</label>
                                                <input required name="transportasis[0][transportasi]" type="text"
                                                    class="form-control" placeholder="selain kendaraan, wajb isi keterangan">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Asal Transportasi</label>
                                                <input required name="transportasis[0][asal_transport]" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <span>
                                            <p>Ke</p>
                                        </span>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tujuan Transportasi</label>
                                                <input required name="transportasis[0][tujuan_transport]" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Biaya Transportasi</label>
                                                <input required name="transportasis[0][biaya_transport]" type="number"
                                                class="form-control">
                                            </div>
                                           
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input name="transportasis[0][keterangan]" type="text"
                                                    class="form-control" placeholder="Keterangan transportasi">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="transportasi_fields"></div>

                                    <!-- Tombol untuk menambahkan transportasi -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary add_transportasi_field" type="button">Tambah
                                                Transportasi</button>
                                        </div>
                                    </div>

                                   

                                    {{-- Tombol Aksi --}}
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('kuitansi.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
        <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.id.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>

        <script>
            // Menambahkan field transportasi tambahan
            $(document).ready(function() {
                var max_fields = 10; // maximum input fields allowed
                var wrapper = $("#transportasi_fields"); // fields wrapper
                var add_button = $(".add_transportasi_field"); // Add button ID

                var x = 1; // initial text box count
                $(add_button).click(function(e) { // on add input button click
                    e.preventDefault();
                    if (x < max_fields) { // max input box allowed
                        x++; // text box increment
                        $(wrapper).append(
                            '<div class="row"><div class="col-md"><div class="form-group"><label>Asal Transportasi</label><input required name="transportasis[' +
                            x +
                            '][asal_transport]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Tujuan Transportasi</label><input required name="transportasis[' +
                            x +
                            '][tujuan_transport]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Jenis Transportasi</label><input required name="transportasis[' +
                            x +
                            '][transportasi]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Keterangan</label><input name="transportasis[' +
                            x +
                            '][keterangan]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Biaya Transportasi</label><input required name="transportasis[' +
                            x +
                            '][biaya_transport]" type="number" class="form-control"></div></div><div class="col-md-1"><a href="#" class="btn btn-danger remove_field"><i class="fas fa-minus"></i></a></div></div>'
                        ); // add input box
                    }
                });

                $(wrapper).on("click", ".remove_field", function(e) { // user click on remove text
                    e.preventDefault();
                    $(this).parent('div').parent('div').remove();
                    x--;
                })
            });
        </script>
    @endpush
@endsection

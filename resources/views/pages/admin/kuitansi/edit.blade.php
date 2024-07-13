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
                <h1>Edit Kuitansi</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('kuitansi.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $kuitansi->id }}">
                            <input required name="tahun_anggaran" type="hidden" class="form-control" id="tahun_anggaran"
                                readonly value="{{ date('Y') }}">


                            <div class="card">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama dan NIK</label>
                                                <select required name="id_pegawai" id="id_pegawai"
                                                    class="form-control select2">
                                                    <option value="">-- Pilih pegawai --</option>
                                                    @foreach ($datas['peserta'] as $i => $v)
                                                        {{-- {{ dd($v->pegawai->nip) }} --}}
                                                        <option {{ $kuitansi->pegawai_id == $v->id ? 'selected' : '' }}
                                                            data-no_ktp="{{ $v->no_ktp }}"
                                                            data-nama="{{ $v->nama }}"
                                                            data-golongan="{{ $v->golongan }}"
                                                            data-kabupaten="{{ $v->kabupaten }}"
                                                            data-jabatan="{{ $v->jabatan ?? $v->status_kepegawaian }}"
                                                            data-instansi="{{ $v->instansi }}"
                                                            data-no_surat_tugas="{{ $v->no_surat_tugas }}"
                                                            data-tgl_surat_tugas="{{ $v->tgl_surat_tugas }}"
                                                            data-status_keikutpesertaan="{{ $v->status_keikutpesertaan }}"
                                                            value="{{ $v->id }}">
                                                            {{ $v->pegawai->nip ?? '' }} - {{ $v->nama }} (
                                                            {{ $v->status_keikutpesertaan }} )
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                    </div>


                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama </label>
                                                <input readonly value="{{ $kuitansi->peserta->pegawai->nama_lengkap }}"
                                                    required name="nama" id="nama" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input readonly value="{{ $kuitansi->peserta->pegawai->nip }}" required
                                                    name="nip" id="nip" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jabatan dalam kegiatan</label>
                                                <input readonly value="{{ $kuitansi->peserta->status_keikutpesertaan }}"
                                                    required name="status_keikutpesertaan" id="status_keikutpesertaan"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <input readonly value="{{ $kuitansi->peserta->golongan }}" required
                                                    name="golongan" id="golongan" type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Instansi </label>
                                                <input readonly value="{{ $kuitansi->peserta->instansi }}" required
                                                    name="instansi" id="instansi" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Surat Tugas</label>
                                                <input readonly value="{{ $kuitansi->peserta->no_surat_tugas }}" required
                                                    name="no_surat_tugas" id="no_surat_tugas" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tanggal Surat Tugas</label>
                                                <input readonly value="{{ $kuitansi->peserta->tgl_surat_tugas }}" required
                                                    name="tgl_surat_tugas" id="tgl_surat_tugas" type="date"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <input readonly required value="{{ $kuitansi->kabupaten->name }}"
                                                    name="kabupaten" id="kabupaten" type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Lokasi Asal</label>
                                                {{-- <input required name="biaya_penginapan" type="number"
                                                    class="form-control"> --}}
                                                <select required name="lokasi_asal" id="lokasi_asal"
                                                    class="form-control select2">
                                                    <option value="">-- Pilih kabupaten / kota --</option>
                                                    @foreach ($datas['kabupaten'] as $i => $v)
                                                        {{-- {{ dd($v->pegawai->nip) }} --}}
                                                        <option {{ $kuitansi->lokasi_asal == $v->id ? 'selected' : '' }}
                                                            value="{{ $v->id }}">
                                                            {{ $v->name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Lokasi Tujuan</label>
                                                <input required value="{{ $kuitansi->lokasi_tujuan }}"
                                                    name="lokasi_tujuan" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jenis Angkutan</label>
                                                <input required value="{{ $kuitansi->jenis_angkutan }}"
                                                    name="jenis_angkutan" type="text" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Bukti</label>
                                                <input required value="{{ $kuitansi->no_bukti }}" name="no_bukti"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor MAK</label>
                                                <input required value="{{ $kuitansi->no_MAK }}" name="no_MAK"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <hr>
                                        <div class="card-title">
                                            <h5>Tiket</h5>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Biaya Pergi (Rp. )</label>
                                                    <input required name="biaya_pergi"
                                                        value="{{ $kuitansi->biaya_pergi }}" id="biaya_pergi"
                                                        type="number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Biaya Pulang (Rp. )</label>
                                                    <input value="{{ $kuitansi->biaya_pulang }}" required
                                                        name="biaya_pulang" id="biaya_pulang" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jumlah Biaya (Rp. )</label>
                                                    <input value="{{ $kuitansi->total_biaya }}" readonly required
                                                        name="jumlah_biaya" id="jumlah_biaya_tiket" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tax / Pajak Bandara (Rp. ) (Opsional)</label>
                                                    <input value="{{ $kuitansi->pajak_bandara }}" name="pajak_bandara"
                                                        id="pajak_bandara" placeholder="diisi jika ada" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div>
                                        <hr>
                                        <div class="card-title">
                                            <h5>Transport Darat / Laut / Taxi</h5>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Biaya Asal (Rp. )</label>
                                                    <input value="{{ $kuitansi->biaya_asal }}" required name="biaya_asal"
                                                        id="biaya_asal" type="number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Biaya Bea Jarak (Rp. )</label>
                                                    <input value="{{ $kuitansi->bea_jarak }}" required name="bea_jarak"
                                                        id="bea_jarak" type="number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tujuan (Rp. )</label>
                                                    <input value="{{ $kuitansi->biaya_tujuan }}" required name="tujuan"
                                                        id="tujuan" placeholder="" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Jumlah Biaya Transport</label>
                                                    <input value="{{ $kuitansi->total_transport }}" readonly required
                                                        name="total_transport" id="total_transport" placeholder=""
                                                        type="number" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div>
                                        <hr>
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Penginapan (Rp. )</label>
                                                    <input required value="{{ $kuitansi->biaya_penginapan }}"
                                                        name="biaya_penginapan" id="biaya_penginapan" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Uang Harian (Rp. )</label>
                                                    <input required value="{{ $kuitansi->uang_harian }}"
                                                        name="uang_harian" id="uang_harian" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>



                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Potongan</label>
                                                    <input required value="{{ $kuitansi->potongan }}" name="potongan"
                                                        id="potongan" placeholder="diisi jika ada" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Biaya Penginapan (Rp. )</label>
                                                <input value="{{ $kuitansi->total_penginapan }}" readonly required
                                                    name="total_penginapan" id="total_penginapan" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Biaya Harian (Rp. )</label>
                                                <input value="{{ $kuitansi->total_harian }}" readonly required
                                                    name="biaya_harian" id="biaya_harian" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jumlah Hari</label>
                                                <input value="{{ $kuitansi->jumlah_hari }}" required name="jumlah_hari"
                                                    id="jumlah_hari" type="number" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah Uang Diterima</label>
                                                <input value="{{ $kuitansi->total_terima }}" readonly required
                                                    name="jumlah_biaya_diterima" id="jumlah_biaya_diterima"
                                                    placeholder="" type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jumlah Hari</label>
                                                <input required name="jumlah_hari" placeholder="diisi jika ada" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
    

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
                                    </div> --}}


                                    {{-- Inputan Transportasi --}}
                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <h5>Transportasi</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jenis Transportasi</label>
                                                <input required name="transportasis[0][transportasi]" type="text"
                                                    class="form-control"
                                                    placeholder="selain kendaraan, wajb isi keterangan">
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
                                    </div> --}}

                                    <div id="transportasi_fields"></div>

                                    <!-- Tombol untuk menambahkan transportasi -->
                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary add_transportasi_field" type="button">Tambah
                                                Transportasi</button>
                                        </div>
                                    </div> --}}



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
                // var max_fields = 10; // maximum input fields allowed
                // var wrapper = $("#transportasi_fields"); // fields wrapper
                // var add_button = $(".add_transportasi_field"); // Add button ID

                // var x = 1; // initial text box count
                // $(add_button).click(function(e) { // on add input button click
                //     e.preventDefault();
                //     if (x < max_fields) { // max input box allowed
                //         x++; // text box increment
                //         $(wrapper).append(
                //             '<div class="row"><div class="col-md"><div class="form-group"><label>Asal Transportasi</label><input required name="transportasis[' +
                //             x +
                //             '][asal_transport]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Tujuan Transportasi</label><input required name="transportasis[' +
                //             x +
                //             '][tujuan_transport]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Jenis Transportasi</label><input required name="transportasis[' +
                //             x +
                //             '][transportasi]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Keterangan</label><input name="transportasis[' +
                //             x +
                //             '][keterangan]" type="text" class="form-control"></div></div><div class="col-md"><div class="form-group"><label>Biaya Transportasi</label><input required name="transportasis[' +
                //             x +
                //             '][biaya_transport]" type="number" class="form-control"></div></div><div class="col-md-1"><a href="#" class="btn btn-danger remove_field"><i class="fas fa-minus"></i></a></div></div>'
                //         ); // add input box
                //     }
                // });

                // $(wrapper).on("click", ".remove_field", function(e) { // user click on remove text
                //     e.preventDefault();
                //     $(this).parent('div').parent('div').remove();
                //     x--;
                // })



                $('#id_pegawai').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    // console.log(selectedOption);
                    var status_keikutpesertaan = selectedOption.data('status_keikutpesertaan');
                    var jabatan = selectedOption.data('jabatan');
                    var nama = selectedOption.data('nama');
                    var no_ktp = selectedOption.data('no_ktp');
                    var kabupaten = selectedOption.data('kabupaten');
                    var golongan = selectedOption.data('golongan');
                    var gender = selectedOption.data('gender');
                    var instansi = selectedOption.data('instansi');
                    var no_surat_tugas = selectedOption.data('no_surat_tugas');
                    var tgl_surat_tugas = selectedOption.data('tgl_surat_tugas');
                    var no_wa = selectedOption.data('wa');
                    console.log(status_keikutpesertaan);

                    // Isi input form dengan data yang sesuai
                    $('#nip').val(no_ktp);
                    $('#nama').val(`${nama}`);
                    $('#status_keikutpesertaan').val(status_keikutpesertaan);
                    $('#jabatan').val(jabatan);
                    $('#gender').val(gender);
                    $('#golongan').val(golongan);
                    $('#kabupaten').val(kabupaten);
                    $('#instansi').val(instansi);
                    $('#no_surat_tugas').val(no_surat_tugas);
                    $('#tgl_surat_tugas').val(tgl_surat_tugas);


                });


                // Calculation functions
                function calculateTiket() {
                    var biayaPergi = parseFloat($('#biaya_pergi').val()) || 0;
                    var biayaPulang = parseFloat($('#biaya_pulang').val()) || 0;
                    var pajakBandara = parseFloat($('#pajak_bandara').val()) || 0;
                    // $('#jumlah_biaya_tiket').val((biayaPergi + biayaPulang) - pajakBandara);
                    var jumlahBiayaTiket = (biayaPergi + biayaPulang) - pajakBandara;
                    $('#jumlah_biaya_tiket').val(formatRupiah(jumlahBiayaTiket));
                }

                function calculateTransport() {
                    var biayaAsal = parseFloat($('#biaya_asal').val()) || 0;
                    var beaJarak = parseFloat($('#bea_jarak').val()) || 0;
                    var biayaTujuan = parseFloat($('#tujuan').val()) || 0;
                    // $('#total_transport').val(biayaAsal + beaJarak + biayaTujuan);
                    var totalTransport = biayaAsal + beaJarak + biayaTujuan;
                    $('#total_transport').val(formatRupiah(totalTransport));
                }

                function calculatePenginapan() {
                    var biayaPerMalam = parseFloat($('#biaya_penginapan').val()) || 0;
                    var jumlah_hari = parseFloat($('#jumlah_hari').val()) || 0;

                    // $('#total_penginapan').val((biayaPerMalam * 0.3) * jumlah_hari);
                    var totalPenginapan = (biayaPerMalam * 0.3) * jumlahHari;
                    $('#total_penginapan').val(formatRupiah(totalPenginapan));
                }

                function calculateHarian() {
                    var biayaPerHari = parseFloat($('#uang_harian').val()) || 0;
                    var jumlahHari = parseFloat($('#jumlah_hari').val()) || 0;
                    $('#biaya_harian').val(biayaPerHari * jumlahHari);
                    // var biayaHarian = biayaPerHari * jumlahHari;
                    $('#biaya_harian').val(formatRupiah(biayaHarian));
                }

                // function calculateRepresentasi() {
                //     var biayaRepresentasi = parseFloat($('#biaya_representasi').val()) || 0;
                //     var jumlahHariRepresentasi = parseFloat($('#jumlah_hari_representasi').val()) || 0;
                //     $('#jumlah_biaya_representasi').val(biayaRepresentasi * jumlahHariRepresentasi);
                // }

                function calculateTotalBiaya() {
                    var jumlahBiayaTiket = parseFloat($('#jumlah_biaya_tiket').val()) || 0;
                    var jumlahBiayaTransport = parseFloat($('#total_transport').val()) || 0;
                    var jumlahBiayaPenginapan = parseFloat($('#total_penginapan').val()) || 0;
                    var jumlahBiayaHarian = parseFloat($('#biaya_harian').val()) || 0;
                    var potongan = parseFloat($('#potongan').val()) || 0;

                    // $('#jumlah_biaya_diterima').val(
                    //     jumlahBiayaTiket + jumlahBiayaTransport + jumlahBiayaPenginapan +
                    //     jumlahBiayaHarian
                    // );
                    var jumlahBiayaDiterima = jumlahBiayaTiket + jumlahBiayaTransport + jumlahBiayaPenginapan +
                        jumlahBiayaHarian;
                    $('#jumlah_biaya_diterima').val(formatRupiah(jumlahBiayaDiterima));
                }

                // Event listeners for calculation
                $('#biaya_pergi, #biaya_pulang, #pajak_bandara').on('input', calculateTiket);
                $('#biaya_asal, #bea_jarak, #tujuan').on('input', calculateTransport);
                $('#biaya_penginapan, #jumlah_hari').on('input', calculatePenginapan);
                $('#uang_harian, #jumlah_hari').on('input', calculateHarian);

                $('#jumlah_biaya_tiket, #pajak_bandara , #jumlah_hari, #tujuan, #uang_harian, #potongan')
                    .on('input', calculateTotalBiaya);

                $('.rupiah').mask('000.000.000.000.000', {
                    reverse: true
                });

                // Initialize calculations
                calculateTiket();
                calculateTransport();
                calculatePenginapan();
                calculateHarian();
                calculateTotalBiaya();

                function formatRupiah(number) {
                    var reverse = number.toString().split('').reverse().join('');
                    var ribuan = reverse.match(/\d{1,3}/g);
                    return ribuan.join('.').split('').reverse().join('');
                }


            });
        </script>
    @endpush
@endsection

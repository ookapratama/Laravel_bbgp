@extends('layouts.user.app', ['title' => 'Tambah Data Pegawai'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <style>
            .signature-pad {
                border: 1px solid #e0e0e0;
                border-radius: 4px;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Registrasi Kegiatan {{ $status['kegiatanById']->nama_kegiatan }} </h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('user.kegiatan_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- {{ dd($_GET['kegiatan_id']) }} --}}
                            <input type="hidden" name="kegiatan_id" id="kegiatan_id" value="{{ $_GET['kegiatan_id'] }}">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Nama dan NIK</label>
                                                <select required name="id_pegawai" id="id_pegawai"
                                                    class="form-control select2">
                                                    <option value="">-- Pilih pegawai --</option>
                                                    @foreach ($merge as $v)
                                                        <option data-no_ktp="{{ $v->no_ktp }}"
                                                            data-nama="{{ $v->nama_lengkap }}"
                                                            data-golongan="{{ $v->golongan }}"
                                                            data-kabupaten="{{ $v->kabupaten }}"
                                                            data-gender="{{ $v->gender }}"
                                                            data-jabatan="{{ $v->jabatan ?? $v->status_kepegawaian }}"
                                                            data-instansi="{{ $v->instansi }}"
                                                            data-wa="{{ $v->no_wa }}"
                                                            data-hp="{{ $v->no_hp }}"
                                                            data-instansi="{{ $v->instansi }}"
                                                            value="{{ $v->id }}">
                                                            {{ $v->no_ktp }} - {{ $v->nama_lengkap }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input readonly name="no_ktp" id="no_ktp" type="number"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <input readonly name="golongan" id="golongan" type="text"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                       

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input readonly name="nama" id="nama" type="nama" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <input readonly name="kabupaten" id="kabupaten" type="text"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <input readonly name="gender" id="gender" type="text"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input readonly name="jabatan" id="jabatan" type="text"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Instansi</label>
                                                <input readonly name="instansi" id="instansi" type="text"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor WhatsApp</label>
                                                <input readonly name="no_wa" id="no_wa" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input readonly name="no_hp" id="no_hp" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Surat  (CONTOH : 0562/KEU/IV/2024)</label>
                                                <input name="no_surat_tugas" type="text" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tanggal Surat Tugas</label>
                                                <input name="tgl_surat_tugas" type="date" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status Keikutpesertaan</label>
                                                <select required name="status_keikutpesertaan" id="status_keikutpesertaan"
                                                    class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="peserta">Peserta</option>
                                                    <option value="panitia">Panitia</option>
                                                    <option value="narasumber">Narasumber</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="formOpsional">
                                        <div class="row">
                                            <div class="col-md-4" id="transportContainer">
                                                <div class="form-group">
                                                    <label>Kelengkapan Peserta (Transport)</label>
                                                    <select name="kelengkapan_transport" id="kelengkapan_transport"
                                                        class="form-control">
                                                        <option value="">-- Pilih Kelengkapan Transport --</option>
                                                        <option value="Ada">Ada Transport</option>
                                                        <option value="Tidak Ada">Tidak Ada Transport</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="biodataContainer">
                                                <div class="form-group">
                                                    <label>Kelengkapan Peserta (Biodata)</label>
                                                    <select name="kelengkapan_biodata" id="kelengkapan_biodata"
                                                        class="form-control">
                                                        <option value="">-- Pilih Kelengkapan Biodata --</option>
                                                        <option value="Ada">Ada Biodata</option>
                                                        <option value="Tidak Ada">Tidak Ada Biodata</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Signature Section --}}
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{-- Uncomment if using signature --}}
                                            {{-- <div class="form-group">
                                                <label for="signature">Tanda Tangan Digital</label>
                                                <div id="signature-pad" class="signature-pad">
                                                    <canvas width="600" height="200"></canvas>
                                                </div>
                                                <input type="hidden" name="signature" id="signature">
                                                <button id="clear" class="btn btn-secondary mt-2">Clear</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit"
                                        onclick="submitSignature()">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('user.kegiatan') }}" class="btn btn-warning">Kembali</a>
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
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
                $('#formOpsional').hide();
                $('#narasumberTime').hide();

                $('#status_keikutpesertaan').change(function() {
                    let status = $(this).val();
                    if (status === 'peserta') {
                        $('#formOpsional').show();
                    } else if (status === 'panitia') {
                        $('#formOpsional').hide();
                    } else if (status === 'narasumber') {
                        $('#formOpsional').hide();

                    } else {
                        $('#formOpsional').hide();
                    }
                });

                $('#id_pegawai').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    // console.log(selectedOption);
                    var jabatan = selectedOption.data('jabatan');
                    var nama = selectedOption.data('nama');
                    var no_ktp = selectedOption.data('no_ktp');
                    var kabupaten = selectedOption.data('kabupaten');
                    var golongan = selectedOption.data('golongan');
                    var gender = selectedOption.data('gender');
                    var instansi = selectedOption.data('instansi');
                    var no_hp = selectedOption.data('hp');
                    var no_wa = selectedOption.data('wa');
                    // console.log(kabupaten);

                    // Isi input form dengan data yang sesuai
                    $('#no_ktp').val(no_ktp);
                    $('#nama').val(`${nama}`);
                    $('#jabatan').val(jabatan);
                    $('#gender').val(gender);
                    $('#golongan').val(golongan);
                    $('#kabupaten').val(kabupaten);
                    $('#instansi').val(instansi);
                    $('#no_hp').val(no_hp);
                    $('#no_wa').val(no_wa);
                });

            });

            const canvas = document.querySelector("canvas");
            const signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function(event) {
                event.preventDefault();
                signaturePad.clear();
            });

            function submitSignature() {
                if (signaturePad.isEmpty()) {
                    alert("Please provide a signature first.");
                } else {
                    const dataUrl = signaturePad.toDataURL();
                    document.getElementById('signature').value = dataUrl;
                }
            }
        </script>
    @endpush
@endsection

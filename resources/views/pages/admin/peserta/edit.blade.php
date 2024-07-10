@extends('layouts.user.app', ['title' => 'Edit Data Peserta'])

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
                <h1>Edit Peserta </h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('peserta.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $datas->id }}">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kegiatan yang di daftarkan</label>
                                                <select name="id_kegiatan" id="" class="form-control select2">
                                                    <option value="">-- pilih kegiatan --</option>
                                                    @foreach ($kegiatan as $v)
                                                        <option {{ $datas->kegiatan->id == $v->id ? 'selected' : '' }}
                                                            value="{{ $v->id }}">{{ $v->nama_kegiatan }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input  name="golongan" id="golongan" type="text"
                                                    class="form-control" required> --}}
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">

                                        {{-- <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Nama dan NIK</label>
                                                <input  name="no_ktp" id="no_ktp" type="text"
                                                    class="form-control" required>
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
                                        </div> --}}

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input value="{{ $datas->nama }}" name="nama" id="nama"
                                                    type="nama" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input value="{{ $datas->no_ktp }}" name="no_ktp" id="no_ktp"
                                                    type="number" class="form-control" required>
                                            </div>
                                        </div>







                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <select required name="kabupaten" id="" class="form-control select2">
                                                    <option value="">-- piilih kabupaten --</option>
                                                    @foreach ($status['kabupaten'] as $v)
                                                        <option {{ $datas->kabupaten == $v->name ? 'selected' : '' }}
                                                            value=" {{ $v->name }} ">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input  name="kabupaten" id="kabupaten" type="text"
                                                    class="form-control" required> --}}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Instansi</label>
                                                <input value="{{ $datas->instansi }}" name="instansi" id="instansi"
                                                    type="text" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Golongan</label>

                                                <select name="golongan" id="" class="form-control select2">
                                                    <option value="">-- pilih golongan --</option>
                                                    @foreach ($status['golongan'] as $v)
                                                        <option {{ $datas->golongan == $v->name ? 'selected' : '' }}
                                                            value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input  name="golongan" id="golongan" type="text"
                                                    class="form-control" required> --}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select name="gender" id="" class="form-control">
                                                    <option value="">-- pilih jenis kelamin --</option>
                                                    <option {{ $datas->jkl == 'Laki-laki' ? 'selected' : '' }}
                                                        value="Laki-laki">Laki-laki</option>
                                                    <option {{ $datas->jkl == 'Perempuan' ? 'selected' : '' }}
                                                        value="Perempuan">Perempuan</option>
                                                </select>
                                                {{-- <input name="gender" id="gender" type="text" class="form-control"
                                                    required> --}}
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor WhatsApp</label>
                                                <input value="{{ $datas->no_wa }}" name="no_wa" id="no_wa"
                                                    type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input value="{{ $datas->no_hp }}" name="no_hp" id="no_hp"
                                                    type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Surat (CONTOH : 0562/KEU/IV/2024)</label>
                                                <input value="{{ $datas->no_surat_tugas }}" name="no_surat_tugas"
                                                    type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tanggal Surat Tugas</label>
                                                <input value="{{ $datas->tgl_surat_tugas }}" name="tgl_surat_tugas"
                                                    type="date" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status Keikutpesertaan</label>
                                                <select required name="status_keikutpesertaan" id="status_keikutpesertaan"
                                                    class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option
                                                        {{ $datas->status_keikutpesertaan == 'peserta' ? 'selected' : '' }}
                                                        value="peserta">Peserta</option>
                                                    <option
                                                        {{ $datas->status_keikutpesertaan == 'panitia' ? 'selected' : '' }}
                                                        value="panitia">Panitia</option>
                                                    <option
                                                        {{ $datas->status_keikutpesertaan == 'narasumber' ? 'selected' : '' }}
                                                        value="">Narasumber</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="formOpsional">
                                        <div class="row">
                                            <div class="col-md-4" id="transportContainer">
                                                <div class="form-group">
                                                    <label>Kelengkapan Peserta (Transport)</label>
                                                    <select name="kelengkapan_peserta_transport" id="kelengkapan_peserta_transport"
                                                        class="form-control">
                                                        <option value="">-- Pilih Kelengkapan Transport --</option>
                                                        <option
                                                            {{ $datas->kelengkapan_transport == 'Ada' ? 'selected' : '' }}
                                                            value="Ada">Ada Transport</option>
                                                        <option
                                                            {{ $datas->kelengkapan_transport == 'Tidak Ada' ? 'selected' : '' }}
                                                            value="Tidak Ada">Tidak Ada Transport</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="biodataContainer">
                                                <div class="form-group">
                                                    <label>Kelengkapan Peserta (Biodata)</label>
                                                    <select name="kelengkapan_peserta_biodata" id="kelengkapan_peserta_biodata"
                                                        class="form-control">
                                                        <option value="">-- Pilih Kelengkapan Biodata --</option>
                                                        <option
                                                            {{ $datas->kelengkapan_biodata == 'Ada' ? 'selected' : '' }}
                                                            value="Ada">Ada Biodata</option>
                                                        <option
                                                            {{ $datas->kelengkapan_biodata == 'Tidak Ada' ? 'selected' : '' }}
                                                            value="Tidak Ada">Tidak Ada Biodata</option>
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
                                    <a href="{{ route('peserta.index') }}" class="btn btn-warning">Kembali</a>
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

                // Initial check on page load
                let status = $('#status_keikutpesertaan').val()

                if (status == 'peserta') {
                    $('#formOpsional').show();
                    
                }
                else {
                    $('#formOpsional').hide();

                }



                $('.select2').select2();
                // $('#formOpsional').hide();
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

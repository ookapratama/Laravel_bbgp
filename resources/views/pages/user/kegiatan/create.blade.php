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
                            <input type="hidden" name="kegiatan_id" id="kegiatan_id"
                                value="{{ $_GET['kegiatan_id'] }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor KTP</label>
                                                <input name="no_ktp" type="number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input name="nama" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select required name="gender" class="form-control">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status Keikut Pesertaan</label>
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

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Surat</label>
                                                <input  name="no_surat_tugas" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tanggal Surat Tugas</label>
                                                <input name="tgl_surat_tugas" type="date" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="formOpsional">
                                        <div class="row">
                                            <div class="col-md-4" id="instansiContainer">
                                                <div class="form-group">
                                                    <label>Instansi</label>
                                                    <input  type="text" name="instansi" id="instansi"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="golonganContainer">
                                                <div class="form-group">
                                                    <label>Golongan</label>
                                                    <select  name="golongan" id="golongan"
                                                        class="form-control select2">
                                                        <option value="">-- Pilih Golongan --</option>
                                                        @foreach ($status['golongan'] as $v)
                                                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="kabupatenContainer">
                                                <div class="form-group">
                                                    <label>Kabupaten / Kota</label>
                                                    <select  name="kabupaten" id="kabupaten"
                                                        class="form-control select2">
                                                        <option value="">-- Pilih Kabupaten --</option>
                                                        @foreach ($status['kabupaten'] as $v)
                                                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="narasumberTime">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jam Mulai Mengajar</label>
                                                    <input type="time" name="jam_mengajar" id="jam_mulai"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jam Selesai Mengajar</label>
                                                    <input type="time" name="jam_selesai" id="jam_selesai"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4" id="transportContainer">
                                                <div class="form-group">
                                                    <label>Kelengkapan Peserta (Transport)</label>
                                                    <select  name="kelengkapan_transport" id="kelengkapan_transport"
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
                                                    <select  name="kelengkapan_biodata" id="kelengkapan_biodata"
                                                        class="form-control">
                                                        <option value="">-- Pilih Kelengkapan Biodata --</option>
                                                        <option value="Ada">Ada Biodata</option>
                                                        <option value="Tidak Ada">Tidak Ada Biodata</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4" id="noWaContainer">
                                                <div class="form-group">
                                                    <label>Nomor WhatsApp</label>
                                                    <input name="no_wa" id="no_wa" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="noHpContainer">
                                                <div class="form-group">
                                                    <label>Nomor Handphone</label>
                                                    <input name="no_hp" id="no_hp"  type="number" class="form-control" >
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
                        $('#instansiContainer').show();
                        $('#golonganContainer').show();
                        $('#kabupatenContainer').show();
                        $('#narasumberTime').hide();
                    } else if (status === 'panitia') {
                        $('#formOpsional').show();
                        $('#instansiContainer').show();
                        $('#golonganContainer').hide();
                        $('#kabupatenContainer').hide();
                        $('#narasumberTime').hide();
                        $('#transportContainer').hide();
                        $('#biodataContainer').hide();
                        $('#noWaContainer').hide();
                        $('#noHpContainer').hide();
                    } else if (status === 'narasumber') {
                        $('#formOpsional').show();
                        $('#instansiContainer').show();
                        $('#golonganContainer').hide();
                        $('#kabupatenContainer').hide();
                        $('#narasumberTime').show();
                        $('#transportContainer').hide();
                        $('#biodataContainer').hide();
                        $('#noWaContainer').hide();
                        $('#noHpContainer').hide();
                    
                    } else {
                        $('#formOpsional').hide();
                        $('#instansiContainer').hide();
                        $('#golonganContainer').hide();
                        $('#kabupatenContainer').hide();
                        $('#narasumberTime').hide();
                    }
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

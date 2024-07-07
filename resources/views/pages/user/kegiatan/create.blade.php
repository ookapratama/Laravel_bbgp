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
                <h1>Tambah Data Pegawai BBGP</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('user.kegiatan_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor KTP</label>
                                                <input name="no_ktp" type="number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                                <label>Kabupaten / Kota</label>
                                                <select required name="kabupaten" class="form-control">
                                                    <option value="">-- Pilih Kabupaten --</option>
                                                    @foreach ($status['kabupaten'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status Keikut Pesertaan</label>
                                                <select required name="status_keikutpesertaan" class="form-control">
                                                    <option value="peserta">Peserta</option>
                                                    <option value="panitia">Panitia</option>
                                                    <option value="narasumber">Narasumber</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kelengkapan Peserta (Transport)</label>
                                                <select required name="kelengkapan_transport" class="form-control">
                                                    <option value="">-- Pilih Kelengkapan Transport --</option>
                                                    <option value="Ada Transport">Ada Transport</option>
                                                    <option value="Tidak Ada Transport">Tidak Ada Transport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kelengkapan Peserta (Biodata)</label>
                                                <select required name="kelengkapan_biodata" class="form-control">
                                                    <option value="">-- Pilih Kelengkapan Biodata --</option>
                                                    <option value="Ada Biodata">Ada Biodata</option>
                                                    <option value="Tidak Ada Biodata">Tidak Ada Biodata</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor WhatsApp</label>
                                                <input name="no_wa" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input name="no_hp" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Instansi</label>
                                                <input required type="text" name="instansi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <select required name="golongan" class="form-control">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    @foreach ($status['golongan'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="signature">Tanda Tangan Digital</label>
                                                <div id="signature-pad" class="signature-pad">
                                                    <canvas width="600" height="200"></canvas>
                                                </div>
                                                <input type="hidden" name="signature" id="signature">
                                                <button id="clear" class="btn btn-secondary mt-2">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit" onclick="submitSignature()">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('user.pegawai') }}" class="btn btn-warning">Kembali</a>
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
            });

            const canvas = document.querySelector("canvas");
            const signaturePad = new SignaturePad(canvas);

            document.getElementById('clear').addEventListener('click', function (event) {
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

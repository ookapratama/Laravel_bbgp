@extends('layouts.app', ['title' => 'Edit Data Pegawai'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Pegawai</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $pegawai->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input value="{{ $pegawai->nama_lengkap }}" name="nama_lengkap" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input value="{{ $pegawai->email }}" name="email" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor KTP</label>
                                                <input value="{{ $pegawai->no_ktp }}" name="no_ktp" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input value="{{ $pegawai->nip }}" name="nip" type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Status Kepegawaian</label>
                                                <select required name="status_kepegawaian" class="form-control select2">
                                                    <option value="">-- Pilih status kepegawaian --</option>
                                                    @foreach ($datas['s_kepegawaian'] as $v)
                                                        <option value="{{ $v->name }}" {{ $pegawai->status_kepegawaian == $v->name ? 'selected' : '' }}>{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input value="{{ $pegawai->tempat_lahir }}" name="tempat_lahir" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input value="{{ $pegawai->tgl_lahir }}" name="tgl_lahir" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select required name="gender" class="form-control">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="Laki-laki" {{ $pegawai->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ $pegawai->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Alamat Rumah</label>
                                                <input value="{{ $pegawai->alamat_rumah }}" type="text" name="alamat_rumah" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Agama</label>
                                                <select required name="agama" class="form-control">
                                                    <option value="">-- Pilih Agama --</option>
                                                    <option value="Islam" {{ $pegawai->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                    <option value="Kristen" {{ $pegawai->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                    <option value="Katolik" {{ $pegawai->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                    <option value="Hindu" {{ $pegawai->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                    <option value="Buddha" {{ $pegawai->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label>
                                                <select required name="pendidikan" class="form-control">
                                                    <option value="">-- Pilih pendidikan terakhir --</option>
                                                    @foreach ($datas['s_gelar'] as $v)
                                                        <option value="{{ $v->name }}" {{ $pegawai->pendidikan == $v->name ? 'selected' : '' }}>{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Satuan Pendidikan</label>
                                                <select required name="satuan_pendidikan" class="form-control select2">
                                                    <option value="">-- Pilih status Satuan Pendidikan --</option>
                                                    @foreach ($datas['s_kependidikan'] as $v)
                                                        <option value="{{ $v->name }}" {{ $pegawai->satuan_pendidikan == $v->name ? 'selected' : '' }}>{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <select required name="kabupaten" class="form-control select2">
                                                    <option value="">-- Pilih Kabupaten / Kota --</option>
                                                    @foreach ($datas['s_kabupaten'] as $v)
                                                        <option value="{{ $v->name }}" {{ $pegawai->kabupaten == $v->name ? 'selected' : '' }}>{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input value="{{ $pegawai->no_hp }}" name="no_hp" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Whatsapp</label>
                                                <input value="{{ $pegawai->no_wa }}" name="no_wa" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Golongan / Jabatan</label>
                                                <select required name="golongan" class="form-control select2">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    @foreach ($datas['golongan'] as $v)
                                                        <option value="{{ $v->name }}" {{ $pegawai->golongan == $v->name ? 'selected' : '' }}>{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <select name="jenis_bank" class="form-control">
                                                    <option value="">-- Pilih Bank --</option>
                                                    <option value="Bank BCA" {{ $pegawai->jenis_bank == 'Bank BCA' ? 'selected' : '' }}>Bank BCA</option>
                                                    <option value="Bank BRI" {{ $pegawai->jenis_bank == 'Bank BRI' ? 'selected' : '' }}>Bank BRI</option>
                                                    <option value="Bank BNI" {{ $pegawai->jenis_bank == 'Bank BNI' ? 'selected' : '' }}>Bank BNI</option>
                                                    <option value="Bank BTN" {{ $pegawai->jenis_bank == 'Bank BTN' ? 'selected' : '' }}>Bank BTN</option>
                                                    <option value="Bank Mandiri" {{ $pegawai->jenis_bank == 'Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                                                    <option value="Bank Syariah Indonesia" {{ $pegawai->jenis_bank == 'Bank Syariah Indonesia' ? 'selected' : '' }}>Bank Syariah Indonesia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input value="{{ $pegawai->no_rek }}" type="number" name="no_rek" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <input value="{{ $pegawai->jabatan }}" type="text" name="jabatan" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('pegawai.index') }}" class="btn btn-warning">Kembali</a>
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
    @endpush
@endsection

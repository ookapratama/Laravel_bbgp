@extends('layouts.app', ['title' => 'Tambah Data Pegawai'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Pegawai</h1>
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input name="nama_lengkap" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input name="email" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor KTP</label>
                                                <input name="no_ktp" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input name="nip" type="number" class="form-control">
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
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input name="tempat_lahir" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input name="tgl_lahir" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select required names="gender" class="form-control ">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Alamat Rumah</label>
                                                <input type="text" name="alamat_rumah" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Agama</label>
                                                <select required name="agama" class="form-control ">
                                                    <option value="">-- Pilih Agama --</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Katolik">Katolik</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Buddha">Buddha</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label>
                                                <select required name="pendidikan" class="form-control ">
                                                    <option value="">-- Pilih pendidikan terakhir --</option>
                                                    @foreach ($datas['s_gelar'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
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
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
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
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Alamat Satuan Pendidikan</label>
                                                <input type="text" name="alamat_satuan" class="form-control">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select required name="status" class="form-control ">
                                                    <option value="">-- Kawin/Belum Kawin --</option>
                                                    <option value="Kawin">Kawin</option>
                                                    <option value="Belum Kawin">Belum Kawin</option>
                                                </select>
                                            </div>
                                        </div> --}}



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input name="no_hp" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Whatsapp</label>
                                                <input name="no_wa" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <select required name="golongan" class="form-control select2">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    @foreach ($datas['golongan'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <select name="jenis_bank" class="form-control" id="">
                                                    <option value="Bank BCA">-- Pilih Bank --</option>
                                                    <option value="Bank BCA">Bank BCA</option>
                                                    <option value="Bank BRI">Bank BRI</option>
                                                    <option value="Bank BNI">Bank BNI</option>
                                                    <option value="Bank BTN">Bank BTN</option>
                                                    <option value="Bank Mandiri">Bank Mandiri</option>
                                                    <option value="Bank Syariah Indonesia">Bank Syariah Indonesia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input type="number" name="no_rek" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Jabatan</label>
                                                <select required name="golongan" class="form-control select2">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    @foreach ($datas['jabatan'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Pas Foto</label>
                                                <input required type="file" name="pas_foto" class="form-control">
                                            </div>
                                        </div> --}}


                                    </div>


                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('pegawai.index') }}" class="btn btn-warning">Kembali</a>
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
    @endpush
@endsection

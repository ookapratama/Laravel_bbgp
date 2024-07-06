@extends('layouts.app', ['title' => 'Edit Data Pegawai BBGP'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Pegawai BBGP</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Form</div>
                </div> --}}
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('pegawai.update') }}" method="POST" enctype="multipart/form-data">
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
                                                <label>Jabatan</label>
                                                <select required name="jabatan" class="form-control select2">
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    @foreach ($datas['s_jabatan'] as $v)
                                                        <option  {{ $pegawai->jabatan == $v->name ? 'selected' : '' }}  value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Golongan</label>
                                                <select required name="golongan" class="form-control select2">
                                                    <option value="">-- Pilih Golongan --</option>
                                                    @foreach  ($datas['golongan'] as $v)
                                                        <option {{ $pegawai->golongan == $v->name ? 'selected' : '' }}  value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>



                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{  session('role') == 'pegawai' ? route('pegawai.show', session('no_ktp')) : route('internal.index') }}" class="btn btn-warning">Kembali</a>
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

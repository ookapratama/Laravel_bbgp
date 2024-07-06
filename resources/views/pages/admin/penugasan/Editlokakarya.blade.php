@extends('layouts.app', ['title' => 'Internal'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Lokakarya</h1>
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('internal.update.lokakarya') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $loka->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Petugas</label>
                                                <input value="{{ $loka->nama }}" required name="nama" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input value="{{ $loka->nip }}" required name="nip" type="text"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat</label>
                                                <input required name="tempat" type="text" class="form-control">
                                            </div>

                                        </div> --}}

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kegiatan</label>
                                                <input value="{{ $loka->kegiatan }}" required name="kegiatan" type="text"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Kegiatan</label>
                                                <input value="{{ $loka->tgl_kegiatan }}" required name="tgl_kegiatan"
                                                    type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis Penugasan</label>
                                            <input value="{{ $loka->jenis }}" required readonly name="jenis"
                                                type="text" value="Penugasan Lokakarya" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kabupaten / Kota</label>
                                            <select required name="kota" class="form-control select2">
                                                <option value="">-- Pilih kabupaten/kota --</option>
                                                @foreach ($datas['kota'] as $v)
                                                    <option {{ $loka->kota == $v->name ? 'selected' : '' }}
                                                        value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Transport Pulang</label>
                                                <input value="{{ $loka->transport_pulang }}" required
                                                    name="transport_pulang" type="number" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Transport Pergi</label>
                                                <input value="{{ $loka->transport_pergi }}" required name="transport_pergi"
                                                    type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hotel</label>
                                                <input value="{{ $loka->hotel }}" required name="hotel" type="text"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 1</label>
                                                <input value="{{ $loka->hari_1 }}" required name="hari_1" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 2</label>
                                                <input value="{{ $loka->hari_2 }}" required name="hari_2" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 3</label>
                                                <input value="{{ $loka->hari_3 }}" required name="hari_3" type="number"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>




                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('pegawai.show', session('no_ktp')) }}"
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
    @endpush
@endsection

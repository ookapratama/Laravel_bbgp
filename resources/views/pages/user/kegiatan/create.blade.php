@extends('layouts.user.app', ['title' => 'Tambah Data Pegawai'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
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
                                                <input name="no_ktp" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select required name="gender" class="form-control ">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <select required name="kabupaten" class="form-control ">
                                                    <option value="Peserta">-- Pilih Kabupaten --</option>
                                                    @foreach ($status['kabupaten'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kelengkapan Peserta</label>
                                                <select required name="kelengkapan_peserta" class="form-control ">
                                                    <option value="Ada_Trasnport">Ada Trasnport</option>
                                                    <option value="Tidak_ada_Trasnport">Tidak ada Trasnport</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label>Kelengkapan Peserta</label>
                                            <select required name="kelengkapan_peserta" class="form-control ">
                                                    <option value=""> Ada Biodata</option>
                                                    <option value="tidak_ada_Biodata">Tidak ada Biodata</option>
                                                </select>
                                                </div>
                                            </div>
                                        

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status keikut Pesertaan</label>
                                                <select required name="status_keikutpesertaan" class="form-control ">
                                                    <option value="peserta">Peserta</option>
                                                    <option value="panitia">Panitia</option>
                                                    <option value="narasumber">Narasumber</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input name="no_hp" type="text" class="form-control">
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <div class="row">
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Whatsapp</label>
                                                <input name="no_wa" type="text" class="form-control">
                                            </div>
                                        </div>
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
                                    </div>


                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('user.pegawai') }}" class="btn btn-warning" >Kembali</a>
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

@extends('layouts.app', ['title' => 'Edit Data Tenaga Pendidik'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Tenaga Pendidik</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Form</div>
                </div> --}}
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('guru.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $datas->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input required name="nama_lengkap" type="text"
                                                    value="{{ $datas->nama_lengkap }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input required name="email" type="text" class="form-control"
                                                    value="{{ $datas->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor KTP</label>
                                                <input required name="no_ktp" type="number" class="form-control"
                                                    value="{{ $datas->no_ktp }}">
                                            </div>
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input required name="nip" type="number" class="form-control"
                                                    value="{{ $datas->nip }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Status Kepegawaian</label>
                                                <input required value="{{ $datas->status_kepegawaian }}"
                                                    name="status_kepegawaian" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input required value="{{ $datas->tempat_lahir }}" name="tempat_lahir"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input required value="{{ $datas->tgl_lahir }}" name="tgl_lahir"
                                                    type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select required name="gender" class="form-control ">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option {{ $datas->gender == 'Laki-laki' ? 'selected' : '' }}
                                                        value="Laki-laki">Laki-laki</option>
                                                    <option {{ $datas->gender == 'Perempuan' ? 'selected' : '' }}
                                                        value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Alamat Rumah</label>
                                                <input required type="text" name="alamat_rumah" class="form-control"
                                                    value="{{ $datas->alamat_rumah }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Agama</label>
                                                <select required name="agama" class="form-control ">
                                                    <option value="">-- Pilih Agama --</option>
                                                    <option {{ $datas->agama == 'Islam' ? 'selected' : '' }}
                                                        value="Islam">Islam</option>
                                                    <option {{ $datas->agama == 'Kristen' ? 'selected' : '' }}
                                                        value="Kristen">Kristen</option>
                                                    <option {{ $datas->agama == 'Katolik' ? 'selected' : '' }}
                                                        value="Katolik">Katolik</option>
                                                    <option {{ $datas->agama == 'Hindu' ? 'selected' : '' }}
                                                        value="Hindu">Hindu</option>
                                                    <option {{ $datas->agama == 'Buddha' ? 'selected' : '' }}
                                                        value="Buddha">Buddha</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label>
                                                <select required name="pendidikan" class="form-control ">
                                                    <option value="">-- Pilih pendidikan terakhir --</option>
                                                    @foreach ($status['s_gelar'] as $v)
                                                        <option {{ $datas->pendidikan == $v->name ? 'selected' : '' }}
                                                            value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Satuan Pendidikan</label>
                                                <select required name="satuan_pendidikan" class="form-control select2">
                                                    <option value="">-- Pilih status Satuan Pendidikan --</option>
                                                    @foreach ($status['s_kependidikan'] as $v)
                                                        <option
                                                            {{ $datas->satuan_pendidikan == $v->name ? 'selected' : '' }}
                                                            value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kabupaten / Kota</label>
                                                <select required name="kabupaten" class="form-control select2">
                                                    <option value="">-- Pilih Kabupaten / Kota --</option>
                                                    @foreach ($status['s_kabupaten'] as $v)
                                                        <option {{ $datas->kabupaten == $v->name ? 'selected' : '' }}
                                                            value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select required name="status" class="form-control ">
                                                    <option value="">-- Kawin/Belum Kawin --</option>
                                                    <option {{ $datas->status == 'Kawin' ? 'selected' : '' }}
                                                        value="Kawin">Kawin</option>
                                                    <option {{ $datas->status == 'Belum Kawin' ? 'selected' : '' }}
                                                        value="Belum Kawin">Belum Kawin</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input name="no_hp" type="text" class="form-control"
                                                    value="{{ $datas->no_hp }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Whatsapp</label>
                                                <input name="no_wa" type="text" class="form-control"
                                                    value="{{ $datas->no_wa }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Alamat Satuan Pendidikan</label>
                                                <input type="text" name="alamat_satuan" class="form-control"
                                                    value="{{ $datas->alamat_satuan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jabatan Sekolah</label>
                                                <select required name="jabatan" class="form-control select2">
                                                    <option value="">-- Pilih Jabatan Sekolah --</option>
                                                    @foreach ($status['s_jabatan'] as $v)
                                                        <option {{ $datas->jabatan == $v->name ? 'selected' : '' }}
                                                            value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input type="number" name="no_rek" class="form-control"
                                                    value="{{ $datas->no_rek }}">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>NPSN Sekolah dan Nama Sekolah</label>
                                            <select required name="npsn_sekolah" class="form-control select2"
                                                id="data_sekolah" onchange="updateLocation()">
                                                <option value="">-- Pilih Data Sekolah --</option>
                                                @foreach ($status['s_sekolah'] as $v)
                                                    <option
                                                        {{ $datas->npsn_sekolah == $v->npsn_sekolah ? 'selected' : '' }}
                                                        value="{{ $v->npsn_sekolah }}"
                                                        data-kecamatan="{{ $v->kecamatan }}"
                                                        data-kabupaten="{{ $v->kabupaten }}">
                                                        {{ $v->npsn_sekolah }} - {{ $v->nama_sekolah }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kabupaten Sekolah</label>
                                                <input id="kabupaten_sekolah" type="text" name="alamat_satuan"
                                                    class="form-control"
                                                    placeholder="Otomatis terisi berdasarkan NPSN Sekolah" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kecamatan Sekolah</label>
                                                <input id="kecamatan_sekolah" type="text" name="alamat_satuan"
                                                    class="form-control"
                                                    placeholder="Otomatis terisi berdasarkan NPSN Sekolah" readonly>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pas Foto</label>
                                                <input type="file" name="pas_foto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Pas Foto sebelumnya</label>
                                            <input type="hidden" name="pas_fotoLama" value="{{ $datas->pas_foto }}">
                                            <img wid src="{{ asset('/upload/guru/' . $datas->pas_foto) }}"
                                                class="img-fluid" alt="">
                                        </div>

                                    </div>


                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ route('guru.index') }}" class="btn btn-warning">Kembali</a>
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
        <script>
            function updateLocation() {
                const selectElement = document.getElementById('data_sekolah');
                const kecamatanInput = document.getElementById('kecamatan_sekolah');
                const kabupatenInput = document.getElementById('kabupaten_sekolah');

                // Ambil opsi yang dipilih
                const selectedOption = selectElement.options[selectElement.selectedIndex];

                // Ambil data kecamatan dan kabupaten dari atribut data
                const kecamatan = selectedOption.getAttribute('data-kecamatan');
                const kabupaten = selectedOption.getAttribute('data-kabupaten');

                // Perbarui nilai input kecamatan dan kabupaten
                kecamatanInput.value = kecamatan;
                kabupatenInput.value = kabupaten;
            }

            document.addEventListener('DOMContentLoaded', function() {
                updateLocation();
            });
        </script>
    @endpush
@endsection

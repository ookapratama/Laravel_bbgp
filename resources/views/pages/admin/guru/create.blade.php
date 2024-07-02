@extends('layouts.app', ['title' => 'Tambah Data Guru'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Guru</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Form</div>
                </div> --}}
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input required name="nama_lengkap" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input required name="email" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nomor KTP</label>
                                                <input required name="no_ktp" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input required name="nip" type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NPWP</label>
                                                <input required name="npwp" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NUPTK</label>
                                                <input required name="nuptk" type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Status Kepegawaian</label>
                                                <select required name="status_kepegawaian" class="form-control select2">
                                                    <option value="">-- Pilih status kepegawaian --</option>
                                                    @foreach ($status['s_kepegawaian'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input required name="tempat_lahir" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input required name="tgl_lahir" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
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
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Alamat Rumah</label>
                                                <input required type="text" name="alamat_rumah" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label>
                                                <select required name="pendidikan" class="form-control ">
                                                    <option value="">-- Pilih pendidikan terakhir --</option>
                                                    @foreach ($status['s_gelar'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
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
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
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
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select required name="status" class="form-control ">
                                                    <option value="">-- Kawin/Belum Kawin --</option>
                                                    <option value="Kawin">Kawin</option>
                                                    <option value="Belum Kawin">Belum Kawin</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input required name="no_hp" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Whatsapp</label>
                                                <input required name="no_wa" type="number" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-4">
                                            <label>Jabatan Sekolah</label>
                                            <select required name="jabatan" class="form-control select2">
                                                <option value="">-- Pilih Jabatan Sekolah --</option>
                                                @foreach ($status['s_jabatan'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input required type="number" name="no_rek" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Pas Foto</label>
                                                <input required type="file" name="pas_foto" class="form-control">
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <label>NPSN Sekolah dan Nama Sekolah</label>
                                            <select required name="npsn_sekolah" class="form-control select2"
                                                id="data_sekolah" onchange="updateLocation()">
                                                <option value="">-- Pilih Data Sekolah --</option>
                                                @foreach ($status['s_sekolah'] as $v)
                                                    <option value="{{ $v->npsn_sekolah }}"
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
                                        <div class="col-md-3 mb-4">
                                            <label>Jenis Jabatan Eksternal</label>
                                            <select required name="jenisJabatan" class="form-control select2"
                                                id="jabEksternal">
                                                <option value="">-- Pilih Jabatan Eksternal --</option>
                                                <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                                <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                                <option value="Stakeholder">Stakeholder</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jabatan (Pilih Eksternal dulu)</label>
                                                <select required name="jabJenis" class="form-control select2"
                                                    id="jabJenis">
                                                    <option value="">-- Pilih Jenis Jabatan --</option>
                                                    {{-- <option id="valJabJenis" value="">-- Pilih Jabatan</option> --}}

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label>Kategori Jabatan (Pilih Eksternal dulu) </label>
                                            <select required name="jabKategori" class="form-control select2"
                                                id="jabKategori">
                                                <option value="">-- Pilih Kategori --</option>
                                                {{-- <option value="GP (Guru Penggerak)">GP (Guru Penggerak)</option>
                                                <option value="NoN GP (Guru Penggerak)">NoN GP (Guru Penggerak)</option> --}}

                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenis Tugas</label>
                                                <select required name="jabTugas" class="form-control select2"
                                                    id="jabTugas">
                                                    <option value="">-- Pilih Tugas Jabatan --</option>

                                                </select>
                                            </div>
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
                console.log('object');
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
        </script>
        <script>
            function fillterJabatan() {
                var jabEksternal = $('#jabEksternal').val();
                var jabJenis = $('#jabJenis');
                var option = '';
                const dataJab = {!! json_encode($status) !!};

                jabJenis.empty();

                jabJenis.append($('<option>', {
                    value: '',
                    text: '-- Pilih Jabatan --',
                    disabled: true,
                    selected: true
                }));

                if (jabEksternal == 'Tenaga Pendidik') {

                    let dataJabValue = dataJab['s_jabPendidik'].map(item => {
                        option = $("<option>")
                            .text(item.name)
                            .attr('value', item.id)
                            .removeAttr('disabled');
                        jabJenis.append(option);
                    });
                }
                if (jabEksternal == 'Tenaga Kependidikan') {
                    let dataJabValue = dataJab['s_jabKependidikan'].map(item => {
                        option = $("<option>")
                            .text(item.name)
                            .attr('value', item.id)
                            .removeAttr('disabled');
                        jabJenis.append(option);
                    });
                }
                if (jabEksternal == 'Stakeholder') {
                    let dataJabValue = dataJab['s_jabStakeholder'].map(item => {
                        option = $("<option>")
                            .text(item.name)
                            .attr('value', item.id)
                            .removeAttr('disabled');
                        jabJenis.append(option);
                    });
                }
            }

            function fillterKategori() {
                var jabKategori = $('#jabKategori').val();
                var jabTugas = $('#jabTugas');
                var option = '';
                const dataJab = {!! json_encode($status) !!};

                jabTugas.empty();

                jabTugas.append($('<option>', {
                    value: '',
                    text: '-- Pilih Jabatan --',
                    disabled: true,
                    selected: true
                }));
                if (jabKategori == 'GP (Guru Penggerak)') {

                    let dataJabValue = dataJab['s_jabTugas'].map(item => {
                        option = $("<option>")
                            .text(item)
                            .attr('value', item.id)
                            .removeAttr('disabled');
                        jabTugas.append(option);
                    });
                }
                if (jabKategori == 'NoN GP (Guru Penggerak)') {

                    let dataJabValue = dataJab['s_jabTugas'].map((item, i) => {
                        option = $("<option>")
                            .text(item)
                            .attr('value', i)
                            .removeAttr('disabled');
                        jabTugas.append(option);
                    });
                }

            }

            $('#jabEksternal').on('change', function() {
                fillterJabatan();
                fillterKategori();
            });

            $('#jabKategori').on('change', function() {
                // fillterKategori();
                var jabTugas = $('#jabTugas');
                // var jabJenis = $(this);
                var option = '';
                const dataJab = {!! json_encode($status) !!};

                // jabJenis.empty();

                // jabJenis.append($('<option>', {
                //     value: '',
                //     text: '-- Pilih Jabatan --',
                //     disabled: true,
                //     selected: true
                // }));

                var selectedOption = $(this).find('option:selected');

                if (selectedOption.text() == 'GP (Guru Penggerak)') {
                    let dataJabValue = dataJab['s_jabTugas'].map((item, i) => {
                        option = $("<option>")
                            .text(item)
                            .attr('value', item)
                            .removeAttr('disabled');
                        jabTugas.append(option);
                    });
                } else {
                    jabTugas.empty();
                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas --',
                        disabled: true,
                        selected: true
                    }));
                }

                console.log('Selected Value (jabTugas):', selectedOption.val());
                console.log('Selected Text (jabTugas):', selectedOption.text());
            });

            $('#jabJenis').on('change', function() {
                // fillterKategori();
                var jabKategori = $('#jabKategori');
                var jabJenis = $(this);
                var option = '';
                const dataJab = {!! json_encode($status) !!};

                // jabJenis.empty();

                // jabJenis.append($('<option>', {
                //     value: '',
                //     text: '-- Pilih Jabatan --',
                //     disabled: true,
                //     selected: true
                // }));

                jabKategori.empty();
                jabKategori.append($('<option>', {
                    value: '',
                    text: '-- Pilih Kategori --',
                    disabled: true,
                    selected: true
                }));
                var selectedOption = $(this).find('option:selected');

                if (selectedOption.text() == 'Guru' || selectedOption.text() == 'Konselor') {
                    let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
                        option = $("<option>")
                            .text(item)
                            .attr('value', i)
                            .removeAttr('disabled');
                        jabKategori.append(option);
                    });
                } else if (selectedOption.text() == 'Pengawas' || selectedOption.text() == 'Kepala Sekolah') {
                    let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
                        option = $("<option>")
                            .text(item)
                            .attr('value', i)
                            .removeAttr('disabled');
                        jabKategori.append(option);
                    });
                } else {
                    jabKategori.empty();
                    jabKategori.append($('<option>', {
                        value: '',
                        text: '-- Pilih Kategori --',
                        disabled: true,
                        selected: true
                    }));
                }

                console.log('Selected Value (jabKategori):', selectedOption.val());
                console.log('Selected Text (jabKategori):', selectedOption.text());
            });
        </script>
    @endpush
@endsection

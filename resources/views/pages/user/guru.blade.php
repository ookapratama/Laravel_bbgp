@extends('layouts.user.app', ['title' => 'Data Eksternal'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    @endpush

    <div class="main-content ">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1 class="text-primary"><u> Data Eksternal BBGP Sulawesi Selatan</u> </h1>
                <div class=" mt-3">
                    {{-- <a href="{{ route('user.form_guru') }}" target="_blank" class="btn btn-primary"><i class="fas fa-users mr-2"></i> Daftar
                        Eksternal BBGP</a> --}}

                </div>

            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">This is Example Page</h2>
                <p class="section-lead">This page is just an example for you to create your own page.</p> --}}
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col">

                                <h5>Registrasi Data Eksternal</h5>
                                <div class="d-flex  mb-5">

                                    <div class="">
                                        <a href="{{ route('user.form_guru', 'Tenaga Pendidik') }}"
                                            class="btn btn-primary btn-lg p-2">
                                            <i class="fas fa-chalkboard-teacher mr-1"></i>Tenaga Pendidik
                                        </a>
                                    </div>
                                    <div class="mx-3">
                                        <a href="{{ route('user.form_guru', 'Tenaga Kependidikan') }}"
                                            class="btn btn-info btn-lg p-2">
                                            <i class="fas fa-school mr-1"></i>Tenaga Kependidikan
                                        </a>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('user.form_guru', 'Stakeholder') }}"
                                            class="btn btn-warning btn-lg p-2">
                                            <i class="fas fa-layer-group mr-1"></i>Stakeholder
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <form action="{{ route('user.cek_pegawai') }}" method="POST">
                            @csrf --}}
                        {{-- Filter Data --}}
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <h5>Pencarian Data Eksternal BBGP </h5>
                                    <input name="nama" id="namaFilter" type="text" value=""
                                        placeholder="Masukkan nama anda" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-md-4 mb-3">
                                <h5>Filter Data Eksternal</h5>
                               
                                <select class="form-control selectric">
                                    <option value="">-- Filter By Jabatan Ketenagaan --</option>
                                    <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                    <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                    <option value="Stakeholder">Stakeholder</option>
                                </select>
                            </div> --}}
                        </div>
                        <h5>Filter Data Eksternal</h5>

                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label>Jabatan Ketenagaan</label>
                                <select required name="jenisJabatan" class="form-control selectric" id="jabEksternal">
                                    <option value="">-- Filter By Jabatan Ketenagaan --</option>
                                    <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                    <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                    <option value="Stakeholder">Stakeholder</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select name="jabJenis" class="form-control" id="jabJenis">
                                        <option value="">-- Pilih Jenis Jabatan --</option>
                                        {{-- <option id="valJabJenis" value="">-- Pilih Jabatan</option> --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <label>Kategori Jabatan </label>
                                <select name="jabKategori" class="form-control" id="jabKategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    {{-- <option value="GP (Guru Penggerak)">GP (Guru Penggerak)</option>
                                    <option value="NoN GP (Guru Penggerak)">NoN GP (Guru Penggerak)</option> --}}

                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Tugas</label>
                                    <select name="jabTugas" class="form-control" id="jabTugas">
                                        <option value="">-- Pilih Tugas Jabatan --</option>

                                    </select>
                                </div>
                            </div>


                        </div>
                        {{-- </form> --}}

                        <div class="data-not-found alert alert-info">Silahkan cari data eksternal anda, jika tidak ada.
                            Silahkan hubungi admin / registrasi pada button diatas</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-guru" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        {{-- <th>Pas Foto</th> --}}
                                        <th>NPSN Sekolah</th>
                                        <th>Nama Lengkap</th>
                                        <th>NPWP</th>
                                        <th>NUPTK</th>
                                        <th>Email</th>
                                        <th>Nomor KTP</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Alamat Rumah</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status Kepegawaian</th>
                                        <th>Agama</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th>Jabatan </th>
                                        <th>Tugas Jabatan </th>
                                        <th>Asal Kabupaten/Kota</th>
                                        <th>Satuan Pendidikan</th>
                                        <th>Jabatan Sekolah</th>
                                        <th>Kecamatan Sekolah</th>
                                        <th>Kabupaten Sekolah</th>
                                        <th>Nomor Aktif</th>
                                        <th>No Rekening</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $i => $data)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            {{-- <td><img src="{{ asset('/upload/guru/' . $data->pas_foto) }}"
                                                        alt="" class="img-fluid"></td> --}}
                                            <td>{{ $data->npsn_sekolah }} -
                                                {{ $data->sekolah->nama_sekolah ?? '' }}</td>
                                            <td>{{ $data->nama_lengkap }}</td>
                                            <td>{{ $data->npwp }}</td>
                                            <td>{{ $data->nuptk }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->no_ktp }}</td>
                                            <td>{{ $data->tempat_lahir . ', ' . $data->tgl_lahir }}</td>
                                            <td>{{ $data->alamat_rumah }}</td>
                                            <td>{{ $data->gender }}</td>
                                            <td>{{ $data->status_kepegawaian }}</td>
                                            <td>{{ $data->agama }}</td>
                                            <td>{{ $data->pendidikan }}</td>
                                            <td>{{ $data->eksternal_jabatan }} ( {{ $data->jenis_jabatan }} ) -
                                                {{ $data->kategori_jabatan }}</td>
                                            <td>{{ $data->tugas_jabatan ?? '-' }}</td>
                                            <td>{{ $data->kabupaten }}</td>
                                            <td>{{ $data->satuan_pendidikan }}</td>
                                            <td>{{ $data->jabatan }}</td>
                                            <td>{{ $data->sekolah->kecamatan ?? '' }}</td>
                                            <td>{{ $data->sekolah->kabupaten ?? '' }}</td>
                                            <td>No. Hp : {{ $data->no_hp }} <br>
                                                No. Whatsapp : {{ $data->no_wa }}</td>
                                            <td>{{ $data->no_rek }}</td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card-footer bg-whitesmoke">
                        This is card footer
                    </div> --}}
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/gmaps/gmaps.min.js') }}"></script>
        <script src="{{ asset('js/page/gmaps-simple.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                // Inisialisasi DataTable
                var tableGuru = $('#table-guru').DataTable();

                // Pilih elemen input dan div pesan
                const namaInput = document.querySelector('#namaFilter');
                const noDataMessage = document.querySelector('.data-not-found');

                // Tambahkan event listener untuk input keyup
                namaInput.addEventListener('keyup', function() {
                    // const searchText = namaInput.value;
                    const searchText = namaInput.value.trim(); // Trim whitespace dari input
                    console.log('Search Text:', searchText); // Debug log untuk pencarian

                    // Update the search dan redraw tableGuru
                    tableGuru.column(3).search(searchText).draw();

                    // Periksa jumlah hasil pencarian
                    const info = tableGuru.page.info();
                    console.log(tableGuru.search(searchText).draw()); // Debug log untuk hasil

                    if (info.recordsDisplay === 0) {
                        noDataMessage.style.display = 'block';
                    } else {
                        noDataMessage.style.display = 'none';
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {

                // const jenisEksternal = ;
                // console.log(jenisEksternal);

                // jabatan ketenagaan
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
                                .attr('value', item.name)
                                .removeAttr('disabled');
                            jabJenis.append(option);
                        });
                    }
                    if (jabEksternal == 'Tenaga Kependidikan') {
                        let dataJabValue = dataJab['s_jabKependidikan'].map(item => {
                            option = $("<option>")
                                .text(item.name)
                                .attr('value', item.name)
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

                // kategori jabatan
                function fillterKategori() {
                    var jabKategori = $('#jabKategori').val();
                    var jabTugas = $('#jabTugas');
                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    jabTugas.empty();

                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas --',
                        disabled: true,
                        selected: true
                    }));
                    if (jabKategori == 'GP (Guru Penggerak)') {

                        let dataJabValue = dataJab['s_jabTugas'].map(item => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabTugas.append(option);
                        });
                    }
                    if (jabKategori == 'NoN GP (Guru Penggerak)') {

                        let dataJabValue = dataJab['s_jabTugas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabTugas.append(option);
                        });
                    }

                }

                $('#jabEksternal').on('change', function() {
                    fillterJabatan();
                    fillterKategori();
                });

                // fix
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

                    if (selectedOption.text() == 'GP (Guru Penggerak)' ||
                        selectedOption.text() == 'Diklat Cakep' ||
                        selectedOption.text() == 'Diklat Cawas' ||
                        selectedOption.text() == 'Lainnya' ||
                        selectedOption.text() == 'Sertifikat GP (Guru Penggerak)') {
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
                    // var jabEksternal = $('#jabEksternal').val();
                    var jabKategori = $('#jabKategori');
                    var jabTugas = $('#jabTugas');
                    var jabJenis = $(this);
                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    jabKategori.empty();
                    jabKategori.append($('<option>', {
                        value: '',
                        text: '-- Pilih Kategori --',
                        disabled: true,
                        selected: true
                    }));

                    jabTugas.empty();
                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas --',
                        disabled: true,
                        selected: true
                    }));

                    var selectedOption = $(this).find('option:selected');

                    if (selectedOption.text() == 'Guru' || selectedOption.text() == 'Konselor') {
                        let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabKategori.append(option);
                        });
                    } else if (selectedOption.text() == 'Pengawas') {
                        let dataJabValue = dataJab['s_jabKategoriPengawas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabKategori.append(option);
                        });
                    } else if (selectedOption.text() == 'Kepala Sekolah') {
                        let dataJabValue = dataJab['s_jabKategoriKepsek'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
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

                        jabTugas.empty();
                        jabTugas.append($('<option>', {
                            value: '',
                            text: '-- Pilih Tugas --',
                            disabled: true,
                            selected: true
                        }));
                    }

                    console.log('Selected Value (jabKategori):', selectedOption.val());
                    console.log('Selected Text (jabKategori):', selectedOption.text());
                });
            });
        </script>
    @endpush
@endsection

@extends('layouts.app', ['title' => 'Data Tenaga Pendidik'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Tenaga Pendidik</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <a href="{{ route('guru.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah Data Tenaga Pendidik
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a target="_blank" href="{{ route('guru.export') }}" class="btn btn-info">
                                            <i class="fas fa-file-pdf"></i> Export PDF
                                        </a>
                                    </div>
                                </div>

                                <h6>Filter By</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <select id="jabEksternal" class="form-control ">
                                            <option value="">-- Pilih Jabatan Ketenagaan --</option>
                                            <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                            <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                            <option value="Stakeholder">Stakeholder</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3 mb-2">
                                        <select id="jabJenis" class="form-control ">
                                            <option value="">-- Pilih Jenis Jabatan --</option>
                                            {{-- @foreach ($status['s_jabTugas'] as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <select id="kategori_jabatan" class="form-control ">
                                            <option value="">-- Pilih Kategori Jabatan --</option>
                                            @foreach ($status['s_jabKategori'] as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="tugas_jabatan" class="form-control ">
                                            <option value="">-- Pilih Tugas Jabatan --</option>
                                            @foreach ($status['s_jabTugas'] as $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <select id="kabupaten" class="form-control ">
                                            <option value="">-- Pilih Kabupaten / Kota --</option>
                                            @foreach ($status['s_kabupaten'] as $v)
                                                <option value="{{ $v->name }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

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
                                                <th>Status Verifikasi</th>
                                                <th>Action</th>
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
                                                    <td>
                                                        @if ($data->is_verif == 'sudah')
                                                            <span class="badge badge-success">Sudah Verifikasi</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Verifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            onclick="verifikasi({{ $data->id }}, 'eksternal', '{{ $data->is_verif }}')"
                                                            class="btn btn-primary mb-2">Verifikasi</a>
                                                        <a href="{{ route('guru.edit', $data->id) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteData({{ $data->id }}, 'eksternal')"
                                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                var table = $("#table-guru").DataTable();

                // Function to filter table
                function filterTable() {
                    var statusKepegawaian = $('#status_kepegawaian').val();
                    var satuanPendidikan = $('#satuan_pendidikan').val();
                    var kabupaten = $('#kabupaten').val();
                    var jabatan = $('#jabatan').val();

                    table.column(13).search(statusKepegawaian).draw(); // Column index 10 for Status Kepegawaian
                    table.column(13).search(satuanPendidikan).draw(); // Column index 14 for Satuan Pendidikan
                    table.column(14).search(kabupaten).draw(); // Column index 13 for Kabupaten/Kota
                    table.column(5).search(jabatan).draw(); // Column index 9 for Jabatan
                }

                // Event listeners for select elements
                $('#eksternal_jabatan ,#jenis_jabatan, #kategori_jabatan, #kabupaten, #tugas_jabatan').on('change',
                    function() {
                        filterTable();
                    });


            });
        </script>

        <script>
            $(document).ready(function() {


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
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabKategori.append(option);
                        });
                    } else if (selectedOption.text() == 'Pengawas' || selectedOption.text() ==
                        'Kepala Sekolah') {
                        let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
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
                    }

                    console.log('Selected Value (jabKategori):', selectedOption.val());
                    console.log('Selected Text (jabKategori):', selectedOption.text());
                });
            })
        </script>
    @endpush
@endsection

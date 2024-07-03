@extends('layouts.app', ['title' => 'Data Internal'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Internal BBGP</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Navigation Buttons -->
                                <div class="row">
                                    <div class="col">
                                        <h4>Registrasi Data Internal</h4>
                                        <div class="d-flex mt-3 mb-5">
                                            <div class="">
                                                <a href="{{ route('internal.create', 'penugasan pegawai') }}"
                                                    class="btn btn-primary btn-lg p-2">
                                                    <i class="fas fa-chalkboard-teacher mr-1"></i>Penugasan Pegawai
                                                </a>
                                            </div>
                                            <div class="mx-3">
                                                <a href="{{ route('internal.create', 'penugasan ppnpn') }}"
                                                    class="btn btn-info btn-lg p-2">
                                                    <i class="fas fa-school mr-1"></i>Penugasan PPNPN
                                                </a>
                                            </div>
                                            <div class="">
                                                <a href="{{ route('internal.create', 'pendamping') }}"
                                                    class="btn btn-warning btn-lg p-2">
                                                    <i class="fas fa-layer-group mr-1"></i>Pendamping Lokakarya
                                                </a>
                                            </div>
                                            <div class="">
                                                <a href="{{ route('pegawai.create', 'pendamping') }}"
                                                    class="btn btn-success btn-lg mx-3 p-2">
                                                    <i class="fas fa-layer-group mr-1"></i>Pegawai
                                                </a>
                                            </div>
                                            <div class="">
                                                <button id="resetBtn" class="btn btn-success btn-lg ">
                                                    <i class="fas fa-redo-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Section -->
                                <h5>Pencarian Data Internal BBGP</h5>
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input name="nama" id="namaFilter" type="text"
                                                placeholder="Masukkan nama anda" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Data Internal -->
                                <h5>Filter Data Internal</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label>Rekapan Data</label>
                                        <select required name="rekapan" class="form-control select2" id="rekapan">
                                            <option value="">-- Filter By Rekapan Data --</option>
                                            <option value="Penugasan Pegawai">Penugasan Pegawai</option>
                                            <option value="Penugasan PPNPN">Penugasan PPNPN</option>
                                            <option value="Pendamping Lokakarya">Pendamping Lokakarya</option>
                                            <option value="Pegawai">Pegawai</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pencarian Penugasan</label>
                                            <input placeholder="ketikkan pencarian penugasan" id="penugasanFilter"
                                                type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label>Pencarian Pendamping</label>
                                        <input placeholder="ketikkan pencarian nama pendamping" id="pendampingFilter"
                                            type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- Tables Section -->
                                <div class="table-responsive">

                                    
                                    <table class="table table-striped table-internal" id="table-internal-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jenis Penugasan</th>
                                                <th>Jabatan</th>
                                                <th>Kegiatan</th>
                                                <th>Tempat</th>
                                                <th>Tanggal Kegiatan</th>
                                                <th>Verifkasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['dataPenugasanPegawai'] as $i => $data)
                                                <tr data-type="penugasan-pegawai">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->nip ?? ' - ' }}</td>
                                                    <td>{{ $data->nama ?? '' }}</td>
                                                    <td>{{ $data->jenis ?? '' }}</td>
                                                    <td>{{ $data->jabatan . ' - (Golongan : ' . $data->golongan . ')' ?? '' }}
                                                    </td>
                                                    <td>{{ $data->kegiatan ?? '' }}</td>
                                                    <td>{{ $data->tempat ?? '' }}</td>
                                                    <td>{{ $data->tgl_kegiatan ?? '' }}</td>
                                                    <td>
                                                        @if ($data->is_verif == 'sudah')
                                                            <span class="badge badge-success">Sudah Verifikasi</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Verifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (session('role') == 'admin' || session('role') == 'superadmin' || session('role') == 'kepala')
                                                            <a href="#"
                                                                onclick="verifikasi({{ $data->id }}, 'internal', '{{ $data->is_verif }}')"
                                                                class="btn btn-primary mb-2">Verifikasi</a>
                                                        @endif
                                                        <a href="{{ route('internal.edit', $data->id) }} "
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteData({{ $data->id }}, 'internal')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <table class="table table-striped table-internal" id="table-internal-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Jenis Penugasan</th>
                                                <th>Jabatan</th>
                                                <th>Kegiatan</th>
                                                <th>Tempat</th>
                                                <th>Tanggal Kegiatan</th>
                                                <th>Verifkasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['dataPenugasanPpnpn'] as $i => $data)
                                                <tr data-type="penugasan-ppnpn">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->nip ?? ' - ' }}</td>
                                                    <td>{{ $data->nama ?? '' }}</td>
                                                    <td>{{ $data->jenis ?? '' }}</td>
                                                    <td>{{ $data->jabatan . ' - (Golongan : ' . $data->golongan . ')' ?? '' }}
                                                    </td>
                                                    <td>{{ $data->kegiatan ?? '' }}</td>
                                                    <td>{{ $data->tempat ?? '' }}</td>
                                                    <td>{{ $data->tgl_kegiatan ?? '' }}</td>
                                                    <td>
                                                        @if ($data->is_verif == 'sudah')
                                                            <span class="badge badge-success">Sudah Verifikasi</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Verifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (session('role') == 'admin' || session('role') == 'superadmin' || session('role') == 'kepala')
                                                            <a href="#"
                                                                onclick="verifikasi({{ $data->id }}, 'internal', '{{ $data->is_verif }}')"
                                                                class="btn btn-primary mb-2">Verifikasi</a>
                                                        @endif
                                                        <a href="{{ route('internal.edit', $data->id) }} "
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteData({{ $data->id }}, 'internal')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <table class="table table-striped table-internal" id="table-internal-3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama</th>
                                                <th>Kabupaten/Kota</th>
                                                <th>Hotel</th>
                                                <th>Transport Pulang</th>
                                                <th>Transport Pergi</th>
                                                <th>Hari 1</th>
                                                <th>Hari 2</th>
                                                <th>Hari 3</th>
                                                <th>Verifkasi</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataPendamping as $i => $data)
                                                <tr data-type="pendamping">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->nama ?? '' }}</td>
                                                    <td>{{ $data->kota ?? '' }}</td>
                                                    <td>{{ $data->hotel ?? '' }}</td>
                                                    <td>{{ $data->transport_pulang ?? '' }}</td>
                                                    <td>{{ $data->transport_pergi ?? '' }}</td>
                                                    <td>{{ $data->hari_1 ?? '' }}</td>
                                                    <td>{{ $data->hari_2 ?? '' }}</td>
                                                    <td>{{ $data->hari_3 ?? '' }}</td>
                                                    <td>
                                                        @if ($data->is_verif == 'sudah')
                                                            <span class="badge badge-success">Sudah Verifikasi</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Verifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (session('role') == 'admin' || session('role') == 'superadmin' || session('role') == 'kepala')
                                                            <a href="#"
                                                                onclick="verifikasi({{ $data->id }}, 'pendamping', '{{ $data->is_verif }}')"
                                                                class="btn btn-primary mb-2">Verifikasi</a>
                                                        @endif
                                                        <a href="{{ route('internal.edit', $data->id) }} "
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteData({{ $data->id }}, 'pendamping')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <table class="table table-striped table-internal" id="table-internal-4">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                {{-- <th>Pas Foto</th> --}}
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>Nomor KTP</th>
                                                <th>Tempat, Tanggal Lahir</th>
                                                <th>Alamat Rumah</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jabatan</th>
                                                <th>Stauts</th>
                                                <th>Agama</th>
                                                <th>Pendidikan Terakhir</th>
                                                <th>Kabupaten/Kota</th>
                                                <th>Satuan Pendidikan</th>
                                                <th>Alamat Satuan Pendidikan</th>
                                                <th>Nomor Aktif</th>
                                                <th>No Rekening</th>
                                                <th>Status Verifikasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['dataPegawai'] as $i => $data)
                                                <tr data-type="pegawai">
                                                    <td>
                                                        {{ ++$i }}
                                                    </td>
                                                    {{-- <td>
                                                        <img src="{{ asset('/upload/pegawai/' . $data->pas_foto) }}"
                                                            alt="" class="img-fluid">

                                                    </td> --}}
                                                    <td>{{ $data->nama_lengkap }}</td>
                                                    <td>{{ $data->email }} </td>
                                                    <td>{{ $data->no_ktp }}</td>
                                                    <td>{{ $data->tempat_lahir . ', ' . $data->tgl_lahir }}</td>
                                                    <td>{{ $data->alamat_rumah }}</td>
                                                    <td>{{ $data->gender }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>{{ $data->status }}</td>
                                                    <td>{{ $data->agama }}</td>
                                                    <td>{{ $data->pendidikan }}</td>
                                                    <td>{{ $data->kabupaten }}</td>
                                                    <td>
                                                        {{ $data->satuan_pendidikan }}>
                                                    </td>
                                                    <td>
                                                        {{ $data->alamat_satuan }}
                                                    </td>
                                                    <td>No. Hp : {{ $data->no_hp }} <br>
                                                        No. Whatsapp : {{ $data->no_wa }}
                                                    </td>
                                                    <td>
                                                        {{ $data->no_rek }}
                                                    </td>
                                                    <td>
                                                        @if ($data->is_verif == 'sudah')
                                                            <span class="badge badge-success">Sudah Verifikasi</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Verifikasi</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary mb-2"
                                                            onclick="verifikasi({{ $data->id }}, 'pegawai', '{{ $data->is_verif }}')">Verifikasi</a>

                                                        <a href="#" class="btn btn-info"><i
                                                                class="fas fa-print"></i></a>

                                                        <a href="{{ route('pegawai.edit', $data->id) }} "
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>

                                                        <button onclick="deleteData({{ $data->id }}, 'pegawai')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
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
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // Initialize DataTables
                // const table1 = $('#table-internal-1').DataTable({
                //     "columnDefs": [{
                //         "sortable": false,
                //         "targets": [2, 3],
                //         "width": "30%"
                //     }],
                // });
                // const table2 = $('#table-internal-2').DataTable({
                //     "columnDefs": [{
                //         "sortable": false,
                //         "targets": [2, 3],
                //         "width": "30%"
                //     }],
                // });
                // const table3 = $('#table-internal-3').DataTable({
                //     "columnDefs": [{
                //         "sortable": false,
                //         "targets": [2, 3],
                //         "width": "30%"
                //     }],
                // });

                // Initially hide both tables
                $('.table-internal').hide();

                // Filter tables based on dropdown selection
                $('#rekapan').on('change', function() {
                    let jenis = $(this).val().toLowerCase().replace(/ /g, '-');

                    // Hide all tables initially
                    $('.table-internal').hide();

                    // Show the appropriate table based on the selection
                    if (jenis === 'penugasan-pegawai') {
                        $('#table-internal-1').show();
                    } else if (jenis === 'penugasan-ppnpn') {
                        $('#table-internal-2').show();
                    } 
                    else if (jenis === 'pendamping-lokakarya') {
                        $('#table-internal-3').show();
                    } 
                    else if (jenis === 'pegawai') {
                        $('#table-internal-4').show();
                    } 
                    else {
                        $('.table-internal').hide();
                    }
                });

                // Filter by Nama
                $('#namaFilter').on('keyup', function() {
                    table1.column(2).search(this.value).draw();
                    table2.column(2).search(this.value).draw();
                    table3.column(1).search(this.value).draw();
                });

                // Filter by Penugasan
                $('#penugasanFilter').on('keyup', function() {
                    table1.column(5).search(this.value).draw();
                    table2.column(5).search(this.value).draw();
                });

                // Filter by Pendamping
                $('#pendampingFilter').on('keyup', function() {
                    table3.column(1).search(this.value).draw();
                });

                // Reset button functionality
                $('#resetBtn').on('click', function() {
                    $('#rekapan').val('');
                    $('#namaFilter').val('');
                    $('#penugasanFilter').val('');
                    $('#pendampingFilter').val('');
                    $('.table-internal').hide();
                    table1.search('').columns().search('').draw();
                    table2.search('').columns().search('').draw();
                    table3.search('').columns().search('').draw();
                });
            });
        </script>
    @endpush
@endsection

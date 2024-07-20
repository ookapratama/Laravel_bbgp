@extends('layouts.landing.app')
@section('content')
    @push('styles')
    @endpush

    <div id="banner-area" class="banner-area"
        style="background-image:url({{ asset('landing/images/banner/bannerKegiatan.png') }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">Internal BBGP </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Internal</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Navigation Buttons -->
                        <div class="row">
                            <div class="col">

                            </div>
                        </div>

                        <!-- Filter Section -->
                        <h5>Pencarian Data Internal BBGP</h5>
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input name="nama" id="namaFilter" type="text" placeholder="Masukkan nama anda"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Filter Data Internal -->
                        <h5>Filter Data Internal</h5>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label>Rekapan Data</label>
                                <select required name="rekapan" class="form-control" id="rekapan">
                                    <option value="">-- Filter By Rekapan Data --</option>
                                    <option value="Penugasan Pegawai">Penugasan Pegawai</option>
                                    <option value="Penugasan PPNPN">Penugasan PPNPN</option>
                                    <option value="Pendamping Lokakarya">Pendamping Lokakarya</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="penugasanForm">
                                <div class="form-group">
                                    <label>Pencarian Penugasan Kegiatan</label>
                                    <input placeholder="ketikkan pencarian kegiatan penugasan" id="penugasanFilter"
                                        type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 mb-4" id="pendampingForm">
                                <label>Pencarian Nama Pendamping</label>
                                <input placeholder="ketikkan pencarian nama pendamping" id="pendampingFilter" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- Tables Section -->
                        <div class="table-responsive">

                        </div>

                        <div class="table-responsive  table-internal" id="table-internal-penugasan">
                            <table class="table table-striped " id="table-penugasan">
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
                                        {{-- <th>Verifkasi</th>
                                    <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas['dataPenugasanPegawai'] as $i => $data)
                                        <tr data-type="penugasan-pegawai">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $data->nip ?? ' - ' }}</td>
                                            <td>{{ $data->nama ?? '' }}</td>
                                            <td>{{ $data->jenis ?? '' }}</td>
                                            <td>{{ $data->jabatan . ' - (Golongan : ' . $data->golongan . ')' ?? '' }}</td>
                                            <td>{{ $data->kegiatan ?? '' }}</td>
                                            <td>{{ $data->tempat ?? '' }}</td>
                                            <td>{{ $data->tgl_kegiatan ?? '' }}</td>
                                            {{-- <td>
                                            @if ($data->is_verif == 'sudah')
                                                <span class="badge badge-success">Sudah Verifikasi</span>
                                            @else
                                                <span class="badge badge-danger">Belum Verifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#"
                                                    onclick="verifikasi({{ $data->id }}, 'internal', '{{ $data->is_verif }}')"
                                                    class="btn btn-primary mb-2">Verifikasi</a>
                                            <a href="{{ route('internal.edit', $data->id) }} " class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                            <button onclick="deleteData({{ $data->id }}, 'internal')" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive  table-internal" id="table-internal-ppnpn">
                            <table class="table table-striped" id="table-ppnpn">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Jenis Penugasan</th>
                                        <th>Jabatan</th>
                                        {{-- <th>Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Tanggal Kegiatan</th> --}}
                                        {{-- <th>Verifkasi</th>
                                    <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas['dataPenugasanPpnpn'] as $i => $data)
                                        <tr data-type="penugasan-ppnpn">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $data->nip ?? ' - ' }}</td>
                                            <td>{{ $data->nama ?? '' }}</td>
                                            <td>{{ $data->jenis ?? '' }}</td>
                                            <td>{{ $data->jabatan . ' - (Golongan : ' . $data->golongan . ')' ?? '' }}</td>
                                            {{-- <td>{{ $data->kegiatan ?? '' }}</td>
                                        <td>{{ $data->tempat ?? '' }}</td>
                                        <td>{{ $data->tgl_kegiatan ?? '' }}</td> --}}
                                            {{-- <td>
                                            @if ($data->is_verif == 'sudah')
                                                <span class="badge badge-success">Sudah Verifikasi</span>
                                            @else
                                                <span class="badge badge-danger">Belum Verifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#"
                                                    onclick="verifikasi({{ $data->id }}, 'internal', '{{ $data->is_verif }}')"
                                                    class="btn btn-primary mb-2">Verifikasi</a>
                                            <a href="{{ route('internal.edit', $data->id) }} " class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                            <button onclick="deleteData({{ $data->id }}, 'internal')" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive  table-internal" id="table-internal-lokakarya">
                            <table class="table table-striped" id="table-lokakarya">
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
                                        {{-- <th>Verifkasi</th>

                                    <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPendamping as $i => $data)
                                        <tr data-type="pendamping">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $data->nama ?? '' }}</td>
                                            <td>{{ $data->kota ?? '' }}</td>
                                            <td>{{ $data->hotel ?? '' }}</td>
                                            <td>Rp. {{ $data->transport_pulang ?? '' }}</td>
                                            <td>Rp. {{ $data->transport_pergi ?? '' }}</td>
                                            <td>Rp. {{ $data->hari_1 ?? '' }}</td>
                                            <td>Rp. {{ $data->hari_2 ?? '' }}</td>
                                            <td>Rp. {{ $data->hari_3 ?? '' }}</td>
                                            {{-- <td>
                                            @if ($data->is_verif == 'sudah')
                                                <span class="badge badge-success">Sudah Verifikasi</span>
                                            @else
                                                <span class="badge badge-danger">Belum Verifikasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#"
                                                    onclick="verifikasi({{ $data->id }}, 'pendamping', '{{ $data->is_verif }}')"
                                                    class="btn btn-primary mb-2">Verifikasi</a>
                                            <a href="{{ route('internal.edit', $data->id) }} " class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                            <button onclick="deleteData({{ $data->id }}, 'pendamping')" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td> --}}
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

    @push('scripts')
        <script src="{{ asset('library/gmaps/gmaps.min.js') }}"></script>
        <script src="{{ asset('js/page/gmaps-simple.js') }}"></script>

        <script>
            $(document).ready(function() {
                // Initialize DataTables
                var tablePenugasan = $('#table-penugasan').DataTable({
                    paging: true,
                    searching: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                    // Add more DataTable options as needed
                });

                var tablePpnpn = $('#table-ppnpn').DataTable({
                    paging: true,
                    searching: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                    // Add more DataTable options as needed
                });

                var tableLokakarya = $('#table-lokakarya').DataTable({
                    paging: true,
                    searching: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                    columnDefs: [{ width: '50%', targets: [4,5,6,7,8] }]
                    // Add more DataTable options as needed
                });

                // Initially hide all tables
                $('.table-internal').hide();

                // Handle change event on #rekapan dropdown
                $('#rekapan').on('change', function() {
                    var selectedValue = $(this).val();

                    // Hide all tables initially
                    $('.table-internal').hide();

                    // Show the selected table based on dropdown value
                    if (selectedValue === 'Penugasan Pegawai') {
                        $('#table-internal-penugasan').show();
                        $('#pendampingForm').hide();
                        $('#penugasanForm').show();
                      } else if (selectedValue === 'Penugasan PPNPN') {
                        $('#table-internal-ppnpn').show();
                        $('#pendampingForm').hide();
                        $('#penugasanForm').show();
                      } else if (selectedValue === 'Pendamping Lokakarya') {
                        $('#table-internal-lokakarya').show();
                        $('#pendampingForm').show();
                        $('#penugasanForm').hide();
                    }
                });

                // Filter by Nama
                $('#namaFilter').on('keyup', function() {
                    tablePenugasan.column(2).search(this.value).draw();
                    tablePpnpn.column(2).search(this.value).draw();
                    tableLokakarya.column(1).search(this.value).draw();
                });

                // Filter by Penugasan
                $('#penugasanFilter').on('keyup', function() {
                    tablePenugasan.column(5).search(this.value).draw();
                    tablePpnpn.column(2).search(this.value).draw();
                });

                // Filter by Pendamping
                $('#pendampingFilter').on('keyup', function() {
                    tableLokakarya.column(1).search(this.value).draw();
                });

                // Reset button functionality
                $('#resetBtn').on('click', function() {
                    $('#rekapan').val('');
                    $('#namaFilter').val('');
                    $('#penugasanFilter').val('');
                    $('#pendampingFilter').val('');
                    $('.table-internal').hide();
                    tablePenugasan.search('').columns().search('').draw();
                    tablePpnpn.search('').columns().search('').draw();
                    tableLokakarya.search('').columns().search('').draw();
                });
            });
        </script>
    @endpush
@endsection

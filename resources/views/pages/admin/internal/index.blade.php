@extends('layouts.app', ['title' => 'Data Internal'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <style>
            .table-internal {
                display: none;
            }
        </style>
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
                                        <h4 id="title-text">Data Internal</h4>
                                        <div class="d-flex mt-3 mb-5">
                                            <div class="row mx-2">
                                                <div class="">
                                                    <a href="#" id="pegawaiBBGP" class="btn btn-warning btn-lg p-2">
                                                        <i class="fas fa-layer-group mr-1"></i>Penugasan Pegawai BBGP
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="#" id="pegawaiPpnp"
                                                        class="btn btn-success btn-lg mx-3 p-2">
                                                        <i class="fas fa-layer-group mr-1"></i>Penugasan Pegawai PPNPN
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Section -->
                                {{-- <h5>Pencarian Data Internal BBGP</h5>
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input name="nama" id="namaFilter" type="text"
                                                placeholder="Masukkan nama anda" class="form-control">
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Filter Data Internal -->
                                {{-- <h5>Filter Data Internal</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label>Rekapan Data</label>
                                        <select required name="rekapan" class="form-control select2" id="rekapan">
                                            <option value="">-- Filter By Rekapan Data --</option>
                                            <option value="Penugasan Pegawai">Penugasan Pegawai</option>
                                            <option value="Penugasan PPNPN">Penugasan PPNPN</option>
                                            <option value="Pendamping Lokakarya">Pendamping Lokakarya</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <!-- Tables Section -->
                                <div class="table-responsive table-internal" id="table-internal-ppnpn">
                                    <!-- Table PPNPN -->
                                    <table class="table table-striped" id="table-ppnpn">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Penugasan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataPpnpn as $i => $data)
                                                <tr data-type="ppnpn">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->nama ?? '' }}</td>
                                                    <td>{{ $data->jabatan ?? '' }}</td>
                                                    <td>
                                                        <a href="{{ route('internal.create.ppnp', $data->id) }}"
                                                            class="btn btn-primary my-2">Penugasan PPNPN</a>
                                                        <a href="{{ route('internal.create.lokakarya', $data->id) }}"
                                                            class="btn btn-info my-2">Penugasan Lokakarya</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('internal.edit', $data->id) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteData({{ $data->id }}, 'ppnpn')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive table-internal" id="table-internal-bbgp">
                                    <!-- Table BBGP -->
                                    <table class="table table-striped" id="table-bbgp">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama Lengkap</th>
                                                <th>Golongan</th>
                                                <th>Jabatan</th>
                                                <th>NIK</th>
                                                <th>NIP</th>
                                                <th>Penugasan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['dataPegawai'] as $i => $data)
                                                <tr data-type="bbgp">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->nama_lengkap }}</td>
                                                    <td>{{ $data->golongan }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>{{ $data->no_ktp }}</td>
                                                    <td>{{ $data->nip }}</td>
                                                    <td>
                                                        {{-- <a href="{{ route('internal.index.pegawai', $data->no_ktp) }}"
                                                            class="btn btn-primary mb-2">Lihat Penugasan</a> --}}
                                                        <button class="btn btn-primary my-2"
                                                            data-nama="{{ $data->nama_lengkap }}"
                                                            data-id="{{ $data->id }}" data-nik="{{ $data->no_ktp }}"
                                                            data-toggle="modal" data-target="#modalPenugasan">
                                                            Menu Penugasan
                                                        </button>

                                                        <button class="btn btn-info my-2"
                                                            data-nama="{{ $data->nama_lengkap }}"
                                                            data-id="{{ $data->id }}" data-nik="{{ $data->no_ktp }}"
                                                            data-toggle="modal" data-target="#modalLokakarya">
                                                            Menu Pendamping Lokakarya
                                                        </button>

                                                        {{-- <a href="{{ route('internal.create.pegawai', $data->id) }}"
                                                            class="btn btn-primary mb-2">Penugasan Pegawai</a> --}}

                                                        {{-- <a href="{{ route('internal.create.lokakarya', $data->id) }}"
                                                            class="btn btn-info mb-2">Pendamping Lokakarya</a> --}}
                                                    </td>
                                                    <td>
                                                        {{-- <a href="#"
                                                            class="btn btn-info my-2"><i class="fas fa-info"></i></a> --}}

                                                        <a href="{{ route('pegawai.edit', $data->id) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>

                                                        <button onclick="deleteData({{ $data->id }}, 'bbgp')"
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

    {{-- Modal Penugasan Pegawai --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalPenugasan">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title-pegawai">Menu Penugasan Pegawai BBGP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    {{-- Link dengan id, yang nantinya akan diubah oleh script --}}
                    <a id="lihatPenugasanLink" class="btn text-white btn-info">Lihat Penugasan</a>
                    <a id="tambahPenugasanLink" class="btn text-white btn-success">Tambah Penugasan</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Pendamping Lokakarya --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalLokakarya">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title-lokakarya">Menu Pendamping Lokakarya BBGP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    {{-- Link dengan id, yang nantinya akan diubah oleh script --}}
                    <a id="lihatPenugasanLink" class="btn text-white btn-info">Lihat Penugasan</a>
                    <a id="tambahPenugasanLink" class="btn text-white btn-success">Tambah Penugasan</a>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

        <script>
            // Event yang dijalankan saat modal muncul
            $('#modalPenugasan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang membuka modal
                var nik = button.data('nik'); // Ambil data-nik dari tombol
                var nama = button.data('nama'); // Ambil data-nama dari tombol
                var lihatLink = "{{ route('internal.index.pegawai', ':nik') }}".replace(':nik', nik);
                var tambahLink = "{{ route('internal.create.pegawai', ':id') }}".replace(':id', button.data('id'));

                // Update href dari link di dalam modal
                $('.modal-title-pegawai').text(`Pegawai ${nama}`);
                $('#lihatPenugasanLink').attr('href', lihatLink);
                $('#tambahPenugasanLink').attr('href', tambahLink);
            });

            // Event yang dijalankan saat modal muncul
            $('#modalLokakarya').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang membuka modal
                var nik = button.data('nik'); // Ambil data-nik dari tombol
                var nama = button.data('nama'); // Ambil data-nama dari tombol
                var lihatLink = "{{ route('internal.index.pegawai', ':nik') }}".replace(':nik', nik);
                var tambahLink = "{{ route('internal.create.pegawai', ':id') }}".replace(':id', button.data('id'));

                // Update href dari link di dalam modal
                $('.modal-title-pegawai').text(`Pegawai ${nama}`);
                $('#lihatPenugasanLink').attr('href', lihatLink);
                $('#tambahPenugasanLink').attr('href', tambahLink);
            });
        </script>



        <script type="text/javascript">
            $(document).ready(function() {

                var language = {
                    "sSearch": "Pencarian Data Internal BBGP : ",
                };
                // Initialize DataTables for both tables
                var tablePpnpn = $('#table-ppnpn').DataTable({
                    paging: true,
                    searching: true,
                    language: language,
                    // Add more DataTable options as needed
                });

                var tableBbgp = $('#table-bbgp').DataTable({
                    paging: true,
                    searching: true,
                    language: language,

                    // Add more DataTable options as needed
                });

                // Initially hide both tables
                $('.table-internal').hide();

                // Show appropriate table based on button click
                $('#pegawaiBBGP').on('click', function(event) {
                    event.preventDefault();
                    $('.table-internal').hide();
                    $('#table-internal-bbgp').show();
                    tableBbgp.columns.adjust().draw(); // Adjust column widths on table show
                    $('#title-text').text('Data Penugasan Pegawai')

                });

                $('#pegawaiPpnp').on('click', function(event) {
                    event.preventDefault();
                    $('.table-internal').hide();
                    $('#table-internal-ppnpn').show();
                    tablePpnpn.columns.adjust().draw(); // Adjust column widths on table show
                    $('#title-text').text('Data Penugasan PPNPN')

                });

                // Filter tables based on dropdown selection
                $('#rekapan').on('change', function() {
                    let jenis = $(this).val().toLowerCase().replace(/ /g, '-');
                    console.log(jenis);
                    // Hide all tables initially
                    $('.table-internal').hide();

                    // Show the appropriate table based on the selection
                    if (jenis === 'penugasan-pegawai') {
                        $('#table-internal-bbgp').show();
                        tableBbgp.columns.adjust().draw(); // Adjust column widths on table show
                    } else if (jenis === 'penugasan-ppnpn') {
                        $('#table-internal-ppnpn').show();
                        tablePpnpn.columns.adjust().draw(); // Adjust column widths on table show
                    }
                });

                // Filter by Nama
                $('#namaFilter').on('keyup', function() {
                    tablePpnpn.column(1).search(this.value).draw();
                    tablePpnpn.column(2).search(this.value).draw();
                    tableBbgp.column(1).search(this.value).draw();
                    tableBbgp.column(2).search(this.value).draw();
                    tableBbgp.column(3).search(this.value).draw();
                });

                // Reset button functionality
                $('#resetBtn').on('click', function() {
                    $('#rekapan').val('');
                    $('#namaFilter').val('');
                    $('.table-internal').hide();
                    tablePpnpn.search('').columns().search('').draw();
                    tableBbgp.search('').columns().search('').draw();
                });
            });
        </script>
    @endpush
@endsection

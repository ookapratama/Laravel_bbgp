@extends('layouts.app', ['title' => 'Data Internal'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <style>
            .table-internal {
                display: none;
            }

            .table-responsive {
                overflow-y: auto;
                max-height: 600px;
                /* Adjust based on your requirements */
            }

            .fixed-header-table thead th,
            .fixed-header-table thead .sticky-col,
            .fixed-header-table thead .sticky-header {
                position: sticky;
                top: 0;
                z-index: 10;
                background-color: white;
                /* Ensure the header has a background */
                border: 2px solid #000;
                /* Ensure consistent border styling */
            }

            .fixed-header-table .sticky-col {
                position: sticky;
                left: 0;
                z-index: 10;
                background-color: white;
                /* Ensure the sticky column has a background */
                border-right: 2px solid #000;
                /* Optional: Add border to differentiate sticky columns */
            }

            .fixed-header-table .sticky-col+.sticky-col {
                left: 60px;
                /* Adjust based on the width of the first sticky column */
            }

            .fixed-header-table .sticky-col.sticky-header {
                z-index: 20;
                /* Ensure the sticky header columns stay above the other columns */
            }

            .fixed-header-table th.sticky-header {
                z-index: 5;
                /* Ensure the sticky header columns stay above the other columns */
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
                                                <div class="">
                                                    <a href="#" id="statusPegawai" class="btn btn-info btn-lg  p-2">
                                                        <i class="fas fa-search mr-1"></i>Lihat Status Pegawai BBGP
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
                                {{-- Area PEgawai --}}
                                <div id="filter-pegawai">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <label>Penugasan Pegawai</label>
                                            <select required name="rekapan" class="form-control selectric" id="rekapan">
                                                <option value="">-- Silahkan Pilih --</option>
                                                <option value="Status Pegawai">Table Status Pegawai</option>
                                                <option value="Penugasan Pegawai">Table Penugasan Pegawai</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div id="status-pegawai">
                                    <h4>Lihat status pegawai di Bulan <span id="getBulanTahun"></span></h4>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <h6>Cari Nama</h6>
                                                <input type="text" class="form-control" placeholder="masukkan nama"
                                                    name="namaStatus" id="namaStatus">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h6>Filter Status</h6>
                                                <select name="filterStatus" class="form-control selectric"
                                                    id="filterStatus">
                                                    <option value="">-- Pilih StatusPegawai --</option>
                                                    <option value="BBGP">Pegawai BBGP</option>
                                                    <option value="PPNPN">Pegawai PPNPN</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!-- Status Pegawai -->
                                                    <!-- Navigation Buttons -->
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <button id="prevMonth" class="btn btn-primary">Previous
                                                            Month</button>
                                                        <button id="nextMonth" class="btn btn-primary">Next Month</button>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-md table-bordered fixed-header-table"
                                                            style="border: 2px solid #000;">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2"
                                                                        class="text-center align-middle sticky-header"
                                                                        style="border: 2px solid #000; background-color: white;">
                                                                        #</th>
                                                                    <th rowspan="2"
                                                                        class="text-center align-middle sticky-col sticky-header"
                                                                        style="border: 2px solid #000; background-color: white;">
                                                                        Nama Lengkap</th>
                                                                    <th rowspan="2"
                                                                        class="text-center align-middle sticky-header"
                                                                        style="border: 2px solid #000; background-color: white;">
                                                                        Status Pegawai</th>
                                                                    <th id="monthHeader" colspan="31"
                                                                        class="text-center sticky-header"
                                                                        style="border: 2px solid #000; background-color: white;">
                                                                        <span id="getBulanTahunCol"></span>
                                                                    </th>
                                                                </tr>
                                                                <tr id="dateHeader" class="sticky-header"
                                                                    style="background-color: white;">
                                                                    <!-- Dates will be injected here -->
                                                                </tr>
                                                            </thead>
                                                            <tbody id="employeeData">
                                                                <!-- Employee data will be injected here -->
                                                            </tbody>
                                                        </table>
                                                    </div>




                                                    {{-- <div id="pagination" class="mt-3">
                                                        <!-- Pagination links will be injected here -->
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>







                                <!-- Tables Section -->
                                <!-- PPNPN -->
                                <div class="table-responsive table-internal" id="table-internal-ppnpn">
                                    <!-- Table PPNPN -->
                                    <table class="table table-striped" id="table-ppnpn">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th style="width: 200px">Nama</th>
                                                <th style="width: 150px">NIK</th>
                                                <th style="width: 150px">NIP</th>
                                                <th>Jabatan</th>
                                                <th>Penugasan</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['dataPenugasanPpnpn'] as $i => $data)
                                                <tr data-type="ppnpn">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->nama_lengkap ?? '' }}</td>
                                                    <td>{{ $data->no_ktp ?? '' }}</td>
                                                    <td>{{ $data->nip ?? '' }}</td>
                                                    <td>{{ $data->jabatan ?? '' }}</td>
                                                    <td>
                                                        <button class="btn btn-success my-2"
                                                            data-nama="{{ $data->nama_lengkap }}"
                                                            data-id="{{ $data->id }}" data-nik="{{ $data->no_ktp }}"
                                                            data-toggle="modal" data-target="#modalPpnpn">
                                                            Menu Penugasan PPNPN
                                                        </button>

                                                        <button class="btn btn-info my-2"
                                                            data-nama="{{ $data->nama_lengkap }}"
                                                            data-id="{{ $data->id }}" data-nik="{{ $data->no_ktp }}"
                                                            data-toggle="modal" data-target="#modalLokakarya">
                                                            Menu Lokakarya
                                                        </button>

                                                        {{-- <a href="{{ route('internal.create.ppnp', $data->id) }}"
                                                            class="btn btn-primary my-2">Penugasan PPNPN</a> --}}
                                                        {{-- <a href="{{ route('internal.create.lokakarya', $data->id) }}"
                                                            class="btn btn-info my-2">Penugasan Lokakarya</a> --}}
                                                    </td>
                                                    {{-- <td>

                                                        <a href="{{ route('internal.edit.ppnpn', $data->id) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteData({{ $data->id }}, 'ppnpn')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        
                                                    </td> --}}

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- BBGP --}}
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
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['dataPenugasanPegawai'] as $i => $data)
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
                                                            Menu Lokakarya
                                                        </button>

                                                        {{-- <a href="{{ route('internal.create.pegawai', $data->id) }}"
                                                            class="btn btn-primary mb-2">Penugasan Pegawai</a> --}}

                                                        {{-- <a href="{{ route('internal.create.lokakarya', $data->id) }}"
                                                            class="btn btn-info mb-2">Pendamping Lokakarya</a> --}}
                                                    </td>
                                                    {{-- <td>
                                                        <a href="#"
                                                            class="btn btn-info my-2"><i class="fas fa-info"></i></a>

                                                        <a href="{{ route('pegawai.edit', $data->id) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>

                                                        <button onclick="deleteData({{ $data->id }}, 'bbgp')"
                                                            class="btn btn-danger">
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
                    <a id="lihatLokakaryaLink" class="btn text-white btn-info">Lihat Lokakarya</a>
                    <a id="tambahLokakaryaLink" class="btn text-white btn-success">Tambah Lokakarya</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Penugasan PPNPN --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalPpnpn">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title-ppnpn">Menu Penugasan Pegawai PPNPN BBGP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    {{-- Link dengan id, yang nantinya akan diubah oleh script --}}
                    <a id="lihatPPNPNLink" class="btn text-white btn-info">Lihat Penugasan PPNPN</a>
                    <a id="tambahPPNPNLink" class="btn text-white btn-success">Tambah Penugasan PPNPN</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog" aria-labelledby="assignmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignmentModalLabel">Detail Penugasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <p><strong>Penugasan:</strong> <span id="modalAssignmentTitle"></span></p>
                    <p><strong>Tipe Penugasan:</strong> <span id="modalAssignmentType"></span></p>
                    <p><strong>Atas nama:</strong> <span id="modalAssignmentName"></span></p>
                    <p><strong>Tanggal Kegiatan:</strong> <span id="modalAssignmentDate"></span></p>
                    <p><strong>Deskripsi:</strong></p>
                    <p id="modalAssignmentDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog" aria-labelledby="assignmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="assignmentModalLabel">Detail Penugasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <!-- Detail penugasan akan dimuat di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>






    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>


        <script>
            // Event yang dijalankan saat modal muncul
            $('#modalPenugasan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang membuka modal
                var nik = button.data('id'); // Ambil data-nik dari tombol
                var nama = button.data('nama'); // Ambil data-nama dari tombol
                var lihatLink = "{{ route('internal.index.pegawai', ':id') }}".replace(':id', nik);
                var tambahLink = "{{ route('internal.create.pegawai', ':id') }}".replace(':id', button.data('id'));

                // Update href dari link di dalam modal
                $('.modal-title-pegawai').text(`Pegawai ${nama}`);
                $('#lihatPenugasanLink').attr('href', lihatLink);
                $('#tambahPenugasanLink').attr('href', tambahLink);
            });

            // Event Lokakarya yang dijalankan saat modal muncul
            $('#modalLokakarya').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang membuka modal
                var nik = button.data('nik'); // Ambil data-nik dari tombol
                var nama = button.data('nama'); // Ambil data-nama dari tombol

                var lihatLink = "{{ route('internal.index.lokakarya', ':nik') }}".replace(':nik', nik);
                var tambahLink = "{{ route('internal.create.lokakarya', ':id') }}".replace(':id', button.data('id'));
                console.log(nik);
                // Update href dari link di dalam modal
                $('.modal-title-lokakarya').text(`Pegawai ${nama}`);
                $('#lihatLokakaryaLink').attr('href', lihatLink);
                $('#tambahLokakaryaLink').attr('href', tambahLink);
            });


            // Event yang dijalankan saat modal muncul
            $('#modalPpnpn').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang membuka modal
                var nik = button.data('id'); // Ambil data-nik dari tombol
                var nama = button.data('nama'); // Ambil data-nama dari tombol
                var id = button.data('id'); // Ambil data-id dari tombol

                var lihatLink = "{{ route('internal.index.ppnpn', ':id') }}".replace(':id', nik);
                var tambahLink = "{{ route('internal.create.ppnpn', ':id') }}".replace(':id', id);

                // Update href dari link di dalam modal
                $('.modal-title-ppnpn').text(`Pegawai ${nama}`);
                $('#lihatPPNPNLink').attr('href', lihatLink);
                $('#tambahPPNPNLink').attr('href', tambahLink);
            });
        </script>


        <script type="text/javascript">
            $(document).ready(function() {

                var language = {
                    "sSearch": "Pencarian Data Internal BBGP : ",
                };
                var tableStatusPegawai = $('#table-status-pegawai').DataTable({
                    paging: true,
                    searching: true,
                    language: language,
                    // Add more DataTable options as needed
                });


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
                $('#status-pegawai').hide();


                $('#filter-pegawai').hide();



                // Show appropriate table based on button click
                $('#statusPegawai').on('click', function(event) {
                    event.preventDefault();
                    $('.table-internal').hide();
                    // $('#filter-pegawai').show();
                    $('#status-pegawai').show();
                    $('#title-text').text('Data Status Pegawai')

                });

                // Show appropriate table based on button click
                $('#pegawaiBBGP').on('click', function(event) {
                    event.preventDefault();
                    $('.table-internal').hide();
                    // $('#filter-pegawai').show();
                    $('#table-internal-bbgp').show();
                    $('#title-text').text('Data Penugasan Pegawai')

                    $('#status-pegawai').hide();


                });



                $('#pegawaiPpnp').on('click', function(event) {
                    event.preventDefault();
                    $('.table-internal').hide();
                    $('#table-internal-ppnpn').show();
                    tablePpnpn.columns.adjust().draw(); // Adjust column widths on table show
                    $('#title-text').text('Data Penugasan PPNPN')

                    // $('#status-pegawai').hide();
                    $('#table-internal-bbgp').show();
                    // $('#filter-pegawai').hide();

                    $('#status-pegawai').hide();



                });

                // Filter tables based on dropdown selection
                $('#rekapan').on('change', function() {
                    let jenis = $(this).val().toLowerCase().replace(/ /g, '-');
                    console.log(jenis);
                    // Hide all tables initially
                    $('.table-internal').hide();

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


                let year = {{ \Carbon\Carbon::now()->year }};
                let month = {{ \Carbon\Carbon::now()->month }};

                function loadCalendarData(year, month, page = 1, name = '', status = '') {
                    $.ajax({
                        url: "{{ route('internal.getCalendarData') }}",
                        type: 'GET',
                        data: {
                            year: year,
                            month: month,
                            page: page,
                            name: name,
                            status: status
                        },
                        success: function(response) {
                            console.log(response)
                            moment.locale('id'); // Set locale to Indonesian
                            let monthName = moment().year(response.year).month(response.month - 1).format(
                                'MMMM YYYY');

                            $('#calendarTitle').text('Calendar for ' + monthName);
                            $('#getBulanTahun').text(monthName);
                            $('#getBulanTahunCol').text(monthName);
                            $('#monthHeader').attr('colspan', response.dates.length);
                            $('#dateHeader').empty();
                            $.each(response.dates, function(index, date) {
                                // console.log(index)
                                $('#dateHeader').append(
                                    '<th class="text-center" style="border: 2px solid #000;">' +
                                    (index + 1) + '</th>');
                            });

                            $('#employeeData').empty();

                            $.each(response.employees, function(index, employee) {
                                // console.log(employee)
                                let row = '<tr>';
                                row +=
                                    '<td class="text-center" style="border: 2px solid #000; background-color: white;">' +
                                    (index + 1) + '</td>';
                                row +=
                                    '<td class="text-nowrap sticky-col" style="border: 2px solid #000; background-color: white;">' +
                                    employee.name + '</td>';
                                row +=
                                    '<td class="text-nowrap" style="border: 2px solid #000; background-color: white;">' +
                                    employee.status + '</td>';

                                let assignmentDates = [];

                                // Memasukkan semua tanggal penugasan ke dalam array
                                $.each(employee.assignments, function(aIndex, assignment) {
                                    let startDate = moment(assignment.start);
                                    let endDate = moment(assignment.end);

                                    for (let m = moment(startDate); m.isSameOrBefore(
                                            endDate); m.add(1, 'days')) {
                                        assignmentDates.push(m.format('YYYY-MM-DD'));
                                    }
                                });

                                // Memeriksa setiap tanggal dalam response.dates
                                $.each(response.dates, function(index, date) {
                                    let currentDate = moment(date.date).format(
                                        'YYYY-MM-DD');
                                    let cellColor = 'white';
                                    let cellText = '';

                                    // Memeriksa apakah ada dua penugasan yang tumpang tindih pada tanggal yang sama
                                    let overlappingAssignments = employee.assignments
                                        .filter(assignment => {
                                            let startDate = moment(assignment.start)
                                                .format('YYYY-MM-DD');
                                            let endDate = moment(assignment.end).format(
                                                'YYYY-MM-DD');
                                            return currentDate >= startDate &&
                                                currentDate <= endDate;
                                        });

                                    if (overlappingAssignments.length > 1) {
                                        cellColor = 'red';
                                    } else if (overlappingAssignments.length === 1) {
                                        cellColor = 'green';
                                    }


                                    if (cellColor !== 'white') {
                                        row +=
                                            '<td class="text-center assignment-cell" style="border: 2px solid #000; background-color: ' +
                                            cellColor + ';" data-assignments="' +
                                            encodeURIComponent(JSON.stringify(
                                                overlappingAssignments)) + '" data-name="' +
                                            employee.name + '" data-cell-color="' +
                                            cellColor + '">' + cellText + '</td>';
                                    } else {
                                        row +=
                                            '<td class="text-center" style="border: 2px solid #000; background-color: ' +
                                            cellColor + ';">' + cellText + '</td>';
                                    }
                                });

                                row += '</tr>';
                                $('#employeeData').append(row);
                            });



                            // Update pagination
                            $('#pagination').html(response.pagination);
                        }
                    });
                }

                $('#prevMonth').click(function() {
                    if (month == 1) {
                        month = 12;
                        year--;
                    } else {
                        month--;
                    }
                    loadCalendarData(year, month);
                });

                $('#nextMonth').click(function() {
                    if (month == 12) {
                        month = 1;
                        year++;
                    } else {
                        month++;
                    }
                    loadCalendarData(year, month);
                });

                // Handle pagination click
                // $(document).on('click', '#pagination a', function(e) {
                //     e.preventDefault();
                //     let page = $(this).attr('href').split('page=')[1];
                //     loadCalendarData(year, month, page, $('#namaStatus').val(), $('#filterStatus').val());
                // });

                // Handle name search
                $('#namaStatus').on('keyup', function() {
                    loadCalendarData(year, month, 1, $(this).val(), $('#filterStatus').val());
                });

                // Handle status filter
                $('#filterStatus').on('change', function() {
                    var selectedOption = $(this).find('option:selected');
                    console.log(selectedOption.val())
                    loadCalendarData(year, month, 1, $('#namaStatus').val(), selectedOption.val());
                });

                // Load the initial calendar data
                loadCalendarData(year, month);


            });

            // Event listener untuk klik pada cell penugasan berwarna
            $(document).on('click', '.assignment-cell', function() {
                let assignments = JSON.parse(decodeURIComponent($(this).data('assignments')));
                let nama = $(this).data('name');
                console.log('tes', nama)
                let cellColor = $(this).data('cell-color');
                let modalBodyContent = '';

                if (cellColor === 'red') {
                    modalBodyContent += '<div class="row">';
                    assignments.forEach(function(assignment) {
                        modalBodyContent += `
                    <div class="col-md-6">
                        <p><strong>Penugasan:</strong> ${assignment.title}</p>
                        <p><strong>Tipe Penugasan:</strong> ${assignment.type}</p>
                        <p><strong>Atas nama:</strong> ${nama}</p>
                        <p><strong>Tanggal Kegiatan:</strong> ${moment(assignment.start).format('dddd, D MMMM YYYY')} s/d ${moment(assignment.end).format('dddd, D MMMM YYYY')}</p>
                        <p><strong>Deskripsi:</strong> ${assignment.description}</p>
                    </div>`;
                    });
                    modalBodyContent += '</div>';
                } else if (assignments.length === 1) {
                    let assignment = assignments[0];
                    // console.log(assignment)
                    modalBodyContent += `
                <p><strong>Penugasan:</strong> ${assignment.title}</p>
                <p><strong>Tipe Penugasan:</strong> ${assignment.type}</p>
                <p><strong>Atas nama:</strong> ${nama}</p>`;
                    if (assignment.start === assignment.end) {
                        modalBodyContent +=
                            `<p><strong>Tanggal Kegiatan:</strong> ${moment(assignment.start).format('dddd, D MMMM YYYY')}</p>`;
                    } else {
                        modalBodyContent +=
                            `<p><strong>Tanggal Kegiatan:</strong> ${moment(assignment.start).format('dddd, D MMMM YYYY')} s/d ${moment(assignment.end).format('dddd, D MMMM YYYY')}</p>`;
                    }
                    modalBodyContent += `<p><strong>Deskripsi:</strong> ${assignment.description}</p>`;
                } else {
                    modalBodyContent = '<p>Tidak ada penugasan pada tanggal ini.</p>';
                }

                $('#modalBodyContent').html(modalBodyContent);
                $('#assignmentModal').modal('show');
            });

            function stripHtml(html) {
                var temporalDivElement = document.createElement("div");
                temporalDivElement.innerHTML = html;
                return temporalDivElement.textContent || temporalDivElement.innerText || "";
            }
        </script>
    @endpush
@endsection

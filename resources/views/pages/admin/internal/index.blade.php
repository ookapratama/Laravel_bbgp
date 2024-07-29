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
                                                        <table class="table table-md table-bordered"
                                                            style="border: 2px solid #000;">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="text-center align-middle"
                                                                        style="border: 2px solid #000;">#</th>
                                                                    <th rowspan="2" class="text-center align-middle"
                                                                        style="border: 2px solid #000;">Nama Lengkap</th>
                                                                    <th rowspan="2" class="text-center align-middle"
                                                                        style="border: 2px solid #000;">Status Pegawai</th>
                                                                    <th id="monthHeader" colspan="31" class="text-center"
                                                                        style="border: 2px solid #000;">
                                                                        <span id="getBulanTahunCol"></span>
                                                                    </th>
                                                                </tr>
                                                                <tr id="dateHeader">
                                                                    <!-- Dates will be injected here -->
                                                                </tr>
                                                            </thead>
                                                            <tbody id="employeeData">
                                                                <!-- Employee data will be injected here -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div id="pagination" class="mt-3">
                                                        <!-- Pagination links will be injected here -->
                                                    </div>
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
                            moment.locale('id'); // Set locale to Indonesian
                            let monthName = moment().year(response.year).month(response.month - 1).format(
                                'MMMM YYYY');

                            $('#calendarTitle').text('Calendar for ' + monthName);
                            $('#getBulanTahun').text(monthName);
                            $('#getBulanTahunCol').text(monthName);
                            $('#monthHeader').attr('colspan', response.dates.length);
                            $('#dateHeader').empty();
                            $.each(response.dates, function(index, date) {
                                $('#dateHeader').append(
                                    '<th class="text-center" style="border: 2px solid #000;">' +
                                    date.day + '</th>');
                            });

                            $('#employeeData').empty();
                            $.each(response.employees, function(index, employee) {
                                let row = '<tr>';
                                row += '<td class="text-center" style="border: 2px solid #000;">' +
                                    (index + 1) + '</td>';
                                row += '<td class="text-nowrap" style="border: 2px solid #000;">' +
                                    employee.name +
                                    '</td>';
                                row += '<td style="border: 2px solid #000;">' + employee.status +
                                    '</td>';
                                $.each(response.dates, function(index, date) {
                                    let cellColor = 'white';
                                    let cellText = '';

                                    $.each(employee.assignments, function(aIndex,
                                        assignment) {
                                        let startDate = moment(assignment.start);
                                        let endDate = moment(assignment.end);
                                        let currentDate = moment(date.date);

                                        if (currentDate.isBetween(startDate,
                                                endDate, undefined, '[]')) {
                                            if (cellColor === 'white') {
                                                cellColor = 'green';
                                                cellText = '';
                                            } else if (cellColor === 'green') {
                                                cellColor = 'red';
                                                cellText = '';
                                            }
                                        }
                                    });

                                    row +=
                                        '<td class="text-center" style="border: 2px solid #000; background-color: ' +
                                        cellColor + ';">' + cellText + '</td>';
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
                $(document).on('click', '#pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    loadCalendarData(year, month, page, $('#namaStatus').val(), $('#filterStatus').val());
                });

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
        </script>
    @endpush
@endsection

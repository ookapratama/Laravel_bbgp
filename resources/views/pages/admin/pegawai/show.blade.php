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
                                        {{-- <h4>Registrasi Data Internal</h4>
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
                                        </div> --}}
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
                                <h5>Data Internal {{ $datas['dataPegawai']->nama_lengkap }}</h5>
                                <div class="row mt-3">
                                    <div class="col-md-4 mb-4">
                                        <label>Rekapan Data</label>
                                        <button id="rekapan" class="btn btn-info">Data Pendamping Lokakarya</button>
                                        {{-- <select required name="rekapan" class="form-control select2" id="rekapan">
                                            <option value="">-- Filter By Rekapan Data --</option>
                                            <option value="Penugasan Pegawai">Penugasan Lokakarya</option>
                                            <option value="Penugasan PPNPN">Penugasan PPNPN</option>
                                            <option value="Pendamping Lokakarya">Pendamping Lokakarya</option>
                                            <option value="Pegawai">Pegawai</option>
                                        </select> --}}
                                    </div>
                                    <div class="col-md-4">
                                        {{-- <div class="form-group">
                                            <label>Pencarian Penugasan</label>
                                            <input placeholder="ketikkan pencarian penugasan" id="penugasanFilter"
                                                type="text" class="form-control">
                                        </div> --}}
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label>Pencarian Pendamping Lokakarya</label>
                                        <input placeholder="ketikkan pencarian nama pendamping" id="pendampingFilter"
                                            type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- Tables Section -->
                                <div class="table-responsive">


                                    <!-- Table BBGP -->
                                    <table class="table table-striped mb-5" id="">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>NIP</th>
                                                <th style="width: 25%">Nama Lengkap</th>
                                                <th>Golongan</th>
                                                <th>Jabatan</th>
                                                {{-- <th>Nomor KTP</th> --}}
                                                <th>Penugasan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-type="bbgp">
                                                <td>{{ 1 }}</td>
                                                <td>{{ $datas['dataPegawai']->nip }}</td>
                                                <td>{{ $datas['dataPegawai']->nama_lengkap }}</td>
                                                <td>{{ $datas['dataPegawai']->golongan }}</td>
                                                <td>{{ $datas['dataPegawai']->jabatan }}</td>
                                                {{-- <td>{{ $datas['dataPegawai']->no_ktp }}</td> --}}
                                                <td>
                                                    <a href="{{ route('internal.create.lokakarya', $datas['dataPegawai']->id) }}"
                                                        class="btn btn-primary mb-2" onclick="">Tambah Peserta</a>
                                                </td>
                                                <td>

                                                    {{-- <a href="{{  route('internal.create.pegawai', $datas['dataPegawai']->id) }}" class="btn btn-primary mb-2"
                                                            onclick="">Penugasan Pegawai</a> --}}
                                                    <a href="{{ route('pegawai.edit', $datas['dataPegawai']->id) }} "
                                                        class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                    {{-- <button onclick="deleteData({{ $datas['dataPegawai']->id }}, 'bbgp')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>







                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-internal " id="table-lokakarya">
                                        <h5 class="mt-5">Data Pendamping Lokakarya</h5>
                                        <thead>
                                            <tr style="width: 2000px; font-size: 14px;">
                                                <th class="text-center">#</th>
                                                {{-- <th>NIP</th> --}}
                                                <th style="width:20%">NIP - Nama</th>
                                                {{-- <th>Jenis Penugasan</th> --}}
                                                <th>Kegiatan</th>
                                                <th>Kota</th>
                                                <th>Hotel</th>
                                                <th>Tanggal Kegiatan</th>
                                                {{-- <th>Transport Pergi dan Pulang</th>
                                                <th>Hari 1</th>
                                                <th>Hari 2</th>
                                                <th>Hari 3</th> --}}
                                                {{-- <th>Verifkasi</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['dataPendamping'] as $i => $data)
                                                <tr style="font-size: 14px;" data-type="penugasan-pegawai">
                                                    <td>{{ ++$i }}</td>
                                                    {{-- <td>{{ $data->nip ?? ' - ' }}</td> --}}
                                                    <td>
                                                        {{ $data->nip ?? ' - ' }}
                                                        <br>
                                                        {{ $data->nama ?? '' }}
                                                    </td>
                                                    {{-- <td>{{ $data->jenis ?? '' }}</td> --}}
                                                    <td>{{ $data->kegiatan ?? '' }}</td>
                                                    <td>{{ $data->kota ?? '' }}</td>
                                                    <td>{{ $data->hotel ?? '' }}</td>
                                                    <td>{{ $data->tgl_kegiatan ?? '' }}</td>
                                                    {{-- <td>Pergi : Rp. {{ $data->transport_pergi ?? '' }} <br> Pulang : Rp.
                                                        {{ $data->transport_pulang ?? '' }}</td>
                                                    <td>Rp. {{ $data->hari_1 ?? '' }}</td>
                                                    <td>Rp. {{ $data->hari_2 ?? '' }}</td>
                                                    <td>Rp. {{ $data->hari_3 ?? '' }}</td> --}}

                                                    {{-- <td>
                                                        @if ($data->is_verif == 'sudah')
                                                            <span class="badge badge-success">Sudah Verifikasi</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Verifikasi</span>
                                                        @endif
                                                    </td> --}}
                                                    <td>
                                                        {{-- @if (session('role') == 'admin' || session('role') == 'superadmin' || session('role') == 'kepala')
                                                            <a href="#"
                                                                onclick="verifikasi({{ $data->id }}, 'internal', '{{ $data->is_verif }}')"
                                                                class="btn btn-primary mb-2">Verifikasi</a>
                                                        @endif --}}


                                                        <button
                                                            onclick="showDetail({{ $data->id }})"
                                                            class="btn btn-info mt-1"><i class="fas fa-info"></i>
                                                        </button>

                                                        <a href="{{ route('internal.edit.lokakarya', $data->id) }} "
                                                            class="btn btn-warning my-1"><i class="fas fa-edit"></i>
                                                        </a>


                                                        {{-- <button onclick="deleteData({{ $data->id }}, 'editPenugasan')"
                                                            class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button> --}}
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

    <!-- Modal for Peserta Detail -->
    <div style="z-index: 999999;" class="modal fade" id="pesertaDetailModal" tabindex="-1" role="dialog"
        aria-labelledby="pesertaDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pesertaDetailModalLabel">Detail Loka Karya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="pesertaDetailContent">
                    <!-- Detail content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
                //         "targets": [2, 3, 8],
                //         "width": "2000%"
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

                var tableLokakarya = $('#table-lokakarya').DataTable();

                // Filter by Lokakarya
                //  $('#pendampingFilter').on('keyup', function() {
                //     tableLokakarya.column(2).search(this.value).draw();
                //     tableLokakarya.column(4).search(this.value).draw();
                //     tableLokakarya.column(5).search(this.value).draw();
                //     tableLokakarya.column(6).search(this.value).draw();

                //     // Check search result count
                //     const info = tableGuru.page.info();
                //     if (info.recordsDisplay === 0) {
                //         noDataMessage.style.display = 'block';
                //     } else {
                //         noDataMessage.style.display = 'none';
                //     }

                // });

                // Initially hide both tables
                $('.table-internal').hide();

                // Filter tables based on dropdown selection
                $('#rekapan').on('click', function(event) {
                    event.preventDefault();
                    // $('.table-internal').hide();
                    $('#table-lokakarya').show();
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

            function showDetail(id) {
                $.ajax({
                    url: '{{ route('pegawai.detail.user') }}',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {

                        let kelengkapanPesertaTransport = '';
                        let kelengkapanPesertaBiodata = ''

                        kelengkapanPesertaTransport = response.statusKeikutpesertaan == 'peserta' ? `
                        <p>
                            <strong>Kelengkapan Peserta Transport:</strong> ${response.kelengkapan_peserta_transport ?? ''}
                        </p>` : '';

                        kelengkapanPesertaBiodata = response.statusKeikutpesertaan == 'peserta' ? `
                        <p>
                            <strong>Kelengkapan Peserta Biodata:</strong> ${response.kelengkapan_peserta_biodata ?? ''}
                        </p>` : '';

                        let formattedDate = '';
                        const date = new Date(response.tgl_surat_tugas);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // getMonth() returns 0-11
                        const year = date.getFullYear();
                        formattedDate = `${day}-${month}-${year}`;

                        $('#pesertaDetailContent').html(`
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama:</strong> ${response.nama ?? ''}</p>
                                <p><strong>NIK:</strong> ${response.no_ktp ?? ''}</p>
                                <p>
                                    <strong>Status Keikutpesertaan:</strong> ${response.status_keikutpesertaan ?? ''}
                                </p>
                                <p>
                                    <strong>Nomor Surat:</strong> ${response.no_surat_tugas ?? ''} 
                                </p>
                                <p>
                                    <strong>Tanggal Surat:</strong> ${formattedDate}
                                </p>
                                <p><strong>Kabupaten:</strong> ${response.kabupaten ?? ''}</p>
        
                                
                            </div>    
                            <div class="col-md-6">
                                <p><strong>Jenis Kelamin:</strong> ${response.jkl ?? ''}</p>
                                ${kelengkapanPesertaBiodata}
                                ${kelengkapanPesertaTransport}
                                <p><strong>Nomor Handphone:</strong> ${response.no_hp ?? ''}</p>
                                <p><strong>Nomor WhatsApp:</strong> ${response.no_wa ?? ''}</p>
                                <p><strong>Instansi:</strong> ${response.instansi ?? ''}</p>
                                <p><strong>Jenis Golongan:</strong> ${response.jenis_gol ?? ''}</p>
                                <p><strong>Golongan:</strong> ${response.golongan ?? ''}</p>
                            </div>    
                        </div>
                    `);
                        $('#pesertaDetailModal').modal('show');
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error fetching detail.');
                    }
                });
            }
        </script>
    @endpush
@endsection

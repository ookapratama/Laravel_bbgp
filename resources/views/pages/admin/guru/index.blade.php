@extends('layouts.app', ['title' => 'Data Eksternal BBGP'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Eksternal BBGP</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    {{-- <h5></h5> --}}
                                    {{-- <div class="col-md-6">
                                        <a href="{{ route('guru.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah Data Eksternal
                                        </a>
                                    </div> --}}
                                    {{-- <div class="text-right">
                                        <a target="_blank" href="{{ route('guru.export') }}" class="btn btn-info">
                                            <i class="fas fa-file-pdf"></i> Export PDF
                                        </a>
                                    </div> --}}
                                </div>

                                <div class="row">


                                </div>
                                <h5>Pencarian Data Eksternal BBGP </h5>
                                <form action="{{ route('guru.export') }}" method="GET">

                                    <div class="row mb-2">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input name="nama" id="namaFilter" type="text" value=""
                                                    placeholder="Masukkan nama anda" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <div class="text-right">
                                                    <button target="_blank" 
                                                        class="btn btn-info btn-lg">
                                                        <i class="fas fa-file-pdf"></i> Export PDF
                                                    </button>
                                                </div>
                                                <div class="">
                                                    <button id="resetBtn" class="btn btn-success btn-lg  mx-2">
                                                        <i class="fas fa-redo-alt"></i>
                                                    </button>
                                                </div>
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
                                            <select  name="jenisJabatan" class="form-control " id="jabEksternal">
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
                                            <div class="form-group" id="latarJabatanContainer">
                                                <label>Latar Jabatan</label>
                                                <select name="jabLatar" class="form-control" id="jabLatar">
                                                    <option value="">-- Pilih Latar Jabatan --</option>
                                                    <!-- Options will be populated dynamically -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenis Tugas</label>
                                                <select name="jabTugas" class="form-control" id="jabTugas">
                                                    <option value="">-- Pilih Tugas Jabatan --</option>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kota/Kabupaten</label>
                                                <select name="kabupatenFilter" class="form-control select2"
                                                    id="kabupatenFilter">
                                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                                    @foreach ($status['s_kabupaten'] as $v)
                                                        <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </form>


                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-guru" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                {{-- <th>Pas Foto</th> --}}
                                                <th style="width: 200px">Nama Lengkap</th>
                                                {{-- <th>NPWP</th> --}}
                                                {{-- <th>NUPTK</th> --}}
                                                {{-- <th>Email</th> --}}
                                                {{-- <th>Nomor KTP</th> --}}
                                                {{-- <th>Tempat, Tanggal Lahir</th> --}}
                                                {{-- <th>Alamat Rumah</th> --}}
                                                {{-- <th>Jenis Kelamin</th> --}}
                                                <th>Status Kepegawaian</th>
                                                {{-- <th>Agama</th> --}}
                                                {{-- <th>Pendidikan Terakhir</th> --}}
                                                <th>Ketenagaan</th>
                                                <th>Jabatan </th>
                                                <th>Kategori Jabatan </th>
                                                <th>Tugas Jabatan </th>
                                                <th>Latar Jabatan </th>
                                                <th>Kota/Kabupaten</th>
                                                {{-- <th style="width: 200px">NPSN Sekolah</th> --}}
                                                {{-- <th>Asal Kabupaten/Kota</th> --}}
                                                {{-- <th>Satuan Pendidikan</th>
                                                    <th>Kecamatan Sekolah</th>
                                                    <th>Kabupaten Sekolah</th> --}}
                                                {{-- <th>Nomor Aktif</th>
                                                    <th>No Rekening</th> --}}
                                                <th>Status Verifikasi</th>
                                                <th style="width: 20%">Action</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    {{-- <td><img src="{{ asset('/upload/guru/' . $data->pas_foto) }}"
                                                                    alt="" class="img-fluid"></td> --}}
                                                    <td>{{ $data->nama_lengkap }}</td>
                                                    {{-- <td>{{ $data->npwp }}</td> --}}
                                                    {{-- <td>{{ $data->nuptk }}</td> --}}
                                                    {{-- <td>{{ $data->email }}</td> --}}
                                                    {{-- <td>{{ $data->no_ktp }}</td> --}}
                                                    {{-- <td>{{ $data->tempat_lahir . ', ' . $data->tgl_lahir }}</td> --}}
                                                    {{-- <td>{{ $data->alamat_rumah }}</td> --}}
                                                    {{-- <td>{{ $data->gender }}</td> --}}
                                                    <td>{{ $data->status_kepegawaian }} </td>
                                                    {{-- <td>{{ $data->agama }}</td> --}}
                                                    {{-- <td>{{ $data->pendidikan }}</td> --}}
                                                    <td>{{ $data->eksternal_jabatan }}</td>
                                                    <td>{{ $data->jenis_jabatan }}</td>
                                                    <td>{{ $data->kategori_jabatan }}</td>
                                                    <td>{{ $data->tugas_jabatan ?? '-' }}</td>
                                                    <td>{{ $data->latar_jabatan ?? 'tidak ada' }}</td>
                                                    <td>{{ $data->kabupaten ?? 'tidak ada' }}</td>
                                                    {{-- <td>{{ $data->npsn_sekolah }} <br>
                                                        {{ $data->sekolah->nama_sekolah ?? '' }}</td> --}}
                                                    {{-- <td>{{ $data->kabupaten }}</td> --}}
                                                    {{-- <td>{{ $data->satuan_pendidikan }}</td> --}}
                                                    {{-- <td>{{ $data->sekolah->kecamatan ?? '' }}</td> --}}
                                                    {{-- <td>{{ $data->sekolah->kabupaten ?? '' }}</td> --}}
                                                    {{-- <td>No. Hp : {{ $data->no_hp }} <br>
                                                            No. Whatsapp : {{ $data->no_wa }}</td> --}}
                                                    {{-- <td>{{ $data->no_rek }} - {{ $data->jenis_bank }}</td> --}}

                                                    <td>
                                                        @if ($data->is_verif == 'sudah')
                                                            <span class="badge badge-sm  badge-success">Sudah
                                                                Verifikasi</span>
                                                        @else
                                                            <span class="badge badge-sm  badge-danger">Belum
                                                                Verifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (in_array(session('role'), ['admin', 'superadmin']) && $data->is_verif !== 'sudah')
                                                            <a href="#" class="btn btn-primary "
                                                                onclick="verifikasi({{ $data->id }}, 'eksternal', '{{ $data->is_verif }}')">Verifikasi</a>
                                                        @endif

                                                        <a href="{{ route('guru.edit', $data->id) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>

                                                        <button onclick="showDetail( {{ $data->id }} )"
                                                            class="btn btn-info">
                                                            <i class="fas fa-info"></i>
                                                        </button>

                                                        <button onclick="deleteData({{ $data->id }}, 'eksternal')"
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

    <!-- Modal for Pegawai Detail -->
    <div style="z-index: 999999;" class="modal fade" id="detailModal" tabindex="-1" role="dialog"
        aria-labelledby="pegawaiDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pegawaiDetailLabel">Detail Data Eksternal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="pegawaiDetailContent">
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

        <script>
            function showDetail(pegawaiId) {
                $.ajax({
                    url: '{{ route('user.pegawai.detail.eksternal') }}', // Sesuaikan dengan route yang benar
                    type: 'GET',
                    data: {
                        id: pegawaiId
                    },
                    success: function(response) {
                        console.log(response)
                        const dateLahir = new Date(response.data.tgl_lahir);
                        const dayLahir = String(dateLahir.getDate()).padStart(2, '0');
                        const monthLahir = String(dateLahir.getMonth() + 1).padStart(2,
                            '0'); // getMonth() returns 0-11
                        const yearLahir = dateLahir.getFullYear();
                        tgl_Lahir = `${dayLahir}-${monthLahir}-${yearLahir}`;

                        $('#pegawaiDetailContent').html(`
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>NPSN Sekolah:</strong>${response.sekolah.nama_sekolah} ( ${response.sekolah.npsn_sekolah ?? ''} ) </p>
                                    <p><strong>Nama Lengkap:</strong> ${response.data.nama_lengkap ?? ''}</p>
                                    <p><strong>NIK:</strong> ${response.data.no_ktp ?? ''}</p>
                                    <p><strong>NIP:</strong> ${response.data.nip ?? ''}</p>
                                    <p><strong>NPWP:</strong> ${response.data.npwp ?? ''}</p>
                                    <p><strong>NUPTK:</strong> ${response.data.nuptk ?? ''}</p>
                                    <p><strong>Email:</strong> ${response.data.email ?? ''}</p>
                                    <p><strong>Asal Kabupaten:</strong> ${response.data.kabupaten ?? ''}</p>
                                    <p><strong>Tempat, Tanggal Lahir:</strong> ${response.data.tempat_lahir ?? ''},  ${tgl_Lahir}</p>
                                    <p><strong>Jenis Kelamin:</strong> ${response.data.gender ?? ''}</p>
                                    <p><strong>Alamat Rumah:</strong> ${response.data.alamat_rumah ?? ''}</p>
                                    
                                    </div>
                                <div class="col-md-6">    
                                    <p><strong>Satuan Pendidikan:</strong> ${response.data.satuan_pendidikan ?? ''}</p>
                                    <p><strong>Ketenagaan:</strong> ${response.data.eksternal_jabatan ?? ''}</p>
                                    <p><strong>Kategori Jabatan:</strong> ${response.data.kategori_jabatan ?? ''}</p>
                                    <p><strong>Jenis Jabatan:</strong> ${response.data.jenis_jabatan ?? ''}</p>
                                    <p><strong>Tugas Jabatan:</strong> ${response.data.tugas_jabatan ?? ''}</p>
                                    <p><strong>Latar Jabatan:</strong> ${response.data.latar_jabatan ?? 'tidak ada'}</p>
                                    <p><strong>Bank:</strong> ( ${response.data.jenis_bank ?? ''} ) - ${response.data.no_rek}</p>
                                    <p><strong>No HP:</strong> ${response.data.no_hp ?? ''}</p>
                                    <p><strong>No WA:</strong> ${response.data.no_wa ?? ''}</p>
                                    <p><strong>Pendidikan Terakhir:</strong> ${response.data.pendidikan ?? ''}</p>
                                    <p><strong>Status Kepegawaian:</strong> ${response.data.status_kepegawaian ?? ''}</p>
                                </div>
                            </div>
                        `);
                        $('#detailModal').modal('show');
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error fetching detail.');
                    }
                });
            }
            $(document).ready(function() {
                // Initialize DataTable
                var tableGuru = $('#table-guru').DataTable({
                    autoWidth: false,
                    columnDefs: [{
                        width: '500px',
                        targets: 8
                    }]
                });
                const resetBtn = document.querySelector('#resetBtn');

                // Select input elements
                const namaInput = document.querySelector('#namaFilter');
                const jabEksternal = document.querySelector('#jabEksternal');
                const jabJenis = document.querySelector('#jabJenis');
                const jabKategori = document.querySelector('#jabKategori');
                const jabTugas = document.querySelector('#jabTugas');
                const jabLatar = document.querySelector('#jabLatar');
                const kabupatenFilter = document.querySelector('#kabupatenFilter');
                const noDataMessage = document.querySelector('.data-not-found');
                console.log(kabupatenFilter);
                // Function to apply search filters
                function applySearch() {
                    // Get trimmed input value
                    const searchText = namaInput.value.trim();

                    // Get select values
                    const jabEksternalValue = jabEksternal.value;
                    const jabJenisValue = jabJenis.value;
                    const jabKategoriValue = jabKategori.value;
                    const jabTugasValue = jabTugas.value;
                    const jabLatarValue = jabLatar.value;
                    const KabupatenValue = kabupatenFilter.value;

                    console.log('Search Text:', KabupatenValue);
                    console.log('Search Text:', KabupatenValue);
                    console.log('Select Value 13:', jabEksternalValue);
                    console.log('Select Value 14:', jabTugasValue);

                    // Update search and redraw tableGuru
                    tableGuru.column(1).search(searchText).draw();
                    tableGuru.column(3).search(jabEksternalValue).draw();
                    tableGuru.column(4).search(jabJenisValue).draw();
                    tableGuru.column(5).search(jabKategoriValue).draw();
                    tableGuru.column(6).search(jabTugasValue).draw();
                    tableGuru.column(7).search(jabLatarValue).draw();
                    tableGuru.column(8).search(KabupatenValue).draw();

                    // Check search result count
                    const info = tableGuru.page.info();
                    // if (info.recordsDisplay === 0) {
                    //     noDataMessage.style.display = 'block';
                    // } else {
                    //     noDataMessage.style.display = 'none';
                    // }
                }

                // Event listener for name input keyup
                namaInput.addEventListener('keyup', applySearch);

                // Event listeners for select change
                jabEksternal.addEventListener('change', applySearch);
                jabJenis.addEventListener('change', applySearch);
                jabKategori.addEventListener('change', applySearch);
                jabTugas.addEventListener('change', applySearch);
                kabupatenFilter.addEventListener('change', applySearch);

                $('#kabupatenFilter').on('change', function() {
                    tableGuru.column(8).search($(this).val()).draw();

                });

                resetBtn.addEventListener('click', function() {
                    location.reload();
                })
            });
        </script>

        <script>
            $(document).ready(function() {
                // Hide latar jabatan container by default
                $('#latarJabatanContainer').hide();

                // Function to filter and show/hide latar jabatan
                function filterLatarJabatan() {
                    var jabEksternal = $('#jabEksternal').val();
                    if (jabEksternal === 'Tenaga Kependidikan') {
                        $('#latarJabatanContainer').show();
                    } else {
                        $('#latarJabatanContainer').hide();
                    }
                }

                // Event listener for changes in jenis jabatan eksternal
                $('#jabEksternal').on('change', function() {
                    filterLatarJabatan();
                    fillterJabatan();
                    fillterKategori();
                });

                // Call the function once on document ready in case the value is already set
                filterLatarJabatan();

                function fillterJabatan() {
                    var jabEksternal = $('#jabEksternal').val();
                    var jabJenis = $('#jabJenis');
                    var jabTugas = $('#jabTugas');
                    var jabKategori = $('#jabKategori');
                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    jabJenis.empty();

                    jabJenis.append($('<option>', {
                        value: '',
                        text: '-- Pilih Jabatan --',
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

                    jabKategori.empty();
                    jabKategori.append($('<option>', {
                        value: '',
                        text: '-- Pilih Kategori --',
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
                                .attr('value', item.name)
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

                $('#jabKategori').on('change', function() {
                    var jabLatar = $('#jabLatar');
                    var jabJenis = $('#jabJenis');
                    var jabTugas = $('#jabTugas');

                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    var selectedOption = $(this).find('option:selected');
                    var seletJenis = jabJenis.find('option:selected');
                    console.log(selectedOption);
                    console.log(seletJenis);
                    if (selectedOption.text() == 'GP (Guru Penggerak)' && seletJenis.text() ==
                        'Kepala Sekolah') {
                        let dataJabValue = dataJab['s_jabKategoriKepsek'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabLatar.append(option);
                        });

                    } else if (selectedOption.text() == 'GP (Guru Penggerak)' && seletJenis.text() ==
                        'Pengawas') {
                        let dataJabValue = dataJab['s_jabKategoriPengawas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabLatar.append(option);
                        });

                    } else if (selectedOption.text() == 'GP (Guru Penggerak)' && (seletJenis.text() == 'Guru' ||
                            seletJenis.text() == 'Konselor')) {
                        let dataJabValue = dataJab['s_jabTugas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabTugas.append(option);
                        });

                    } else {
                        jabLatar.empty();
                        jabLatar.append($('<option>', {
                            value: '',
                            text: '-- Pilih Latar Jabatan --',
                            disabled: true,
                            selected: true
                        }));

                        jabTugas.empty();
                        jabTugas.append($('<option>', {
                            value: '',
                            text: '-- Pilih Tugas Jabatan --',
                            disabled: true,
                            selected: true
                        }));
                    }

                    console.log('Selected Value (jabTugas):', selectedOption.val());
                    console.log('Selected Text (jabTugas):', selectedOption.text());
                });

                $('#jabJenis').on('change', function() {
                    var jabKategori = $('#jabKategori');
                    var jabTugas = $('#jabTugas');
                    var jabLatar = $('#jabLatar');
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

                    jabLatar.empty();
                    jabLatar.append($('<option>', {
                        value: '',
                        text: '-- Pilih Latar Jabatan --',
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
                        let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabKategori.append(option);
                        });

                    } else if (selectedOption.text() == 'Kepala Sekolah') {
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

                        jabTugas.empty();
                        jabTugas.append($('<option>', {
                            value: '',
                            text: '-- Pilih Tugas --',
                            disabled: true,
                            selected: true
                        }));

                        jabLatar.empty();
                        jabLatar.append($('<option>', {
                            value: '',
                            text: '-- Pilih Latar Jabatan --',
                            disabled: true,
                            selected: true
                        }));
                    }

                    console.log('Selected Value (jabKategori):', selectedOption.val());
                    console.log('Selected Text (jabKategori):', selectedOption.text());
                });

                $('#jabLatar').on('change', function() {
                    var jabLatar = $(this);
                    var jabTugas = $('#jabTugas');

                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    var selectedOption = $(this).find('option:selected');
                    var seletTugas = jabTugas.find('option:selected');
                    console.log(selectedOption);
                    console.log(seletTugas);

                    jabTugas.empty();
                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas Jabatan --',
                        disabled: true,
                        selected: true
                    }));

                    if (selectedOption.text() != '') {
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
                            text: '-- Pilih Tugas Jabatan --',
                            disabled: true,
                            selected: true
                        }));
                    }
                });

                // Initial call to fill the dropdowns
                fillterJabatan();
            });
        </script>
    @endpush
@endsection

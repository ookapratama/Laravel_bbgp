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
                                <div class="row">
                                    <div class="col-md">

                                        <a href="{{ route('guru.create') }}" class="btn btn-primary my-4">
                                            <i class="fas fa-plus"></i>
                                            Tambah Data Tenaga Pendidik
                                        </a>
                                    </div>
                                </div>
                                <h6>Filter By </h6>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select  id="status_kepegawaian" class="form-control select2">
                                                <option value="">-- Pilih status kepegawaian --</option>
                                                @foreach ($status['s_kepegawaian'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select id="satuan_pendidikan" class="form-control select2">
                                                <option value="">-- Pilih status Satuan Pendidikan --</option>
                                                @foreach ($status['s_kependidikan'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select  id="kabupaten" class="form-control select2">
                                                <option value="">-- Pilih Kabupaten / Kota --</option>
                                                @foreach ($status['s_kabupaten'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select id="jabatan" class="form-control select2">
                                                <option value="">-- Pilih Jabatan Sekolah --</option>
                                                @foreach ($status['s_jabatan'] as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-guru" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Pas Foto</th>
                                                <th>NPSN Sekolah</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>Nomor KTP</th>
                                                <th>Tempat, Tanggal Lahir</th>
                                                <th>Alamat Rumah</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jabatan</th>
                                                <th>Status Kepegawaian</th>
                                                <th>Agama</th>
                                                <th>Pendidikan Terakhir</th>
                                                <th>Kabupaten/Kota</th>
                                                <th>Satuan Pendidikan</th>
                                                <th>Kecamatan</th>
                                                <th>Nomor Aktif</th>
                                                <th>No Rekening</th>
                                                <th>Status Verifikasi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                                <tr>
                                                    <td>
                                                        {{ ++$i }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('/upload/guru/' . $data->pas_foto) }}"
                                                            alt="" class="img-fluid">

                                                    </td>
                                                    <td>{{ $data->npsn_sekolah }} - {{ $data->sekolah->nama_sekolah ?? '' }}
                                                    </td>
                                                    <td>{{ $data->nama_lengkap }}</td>
                                                    <td>{{ $data->email }} </td>
                                                    <td>{{ $data->no_ktp }}</td>
                                                    <td>{{ $data->tempat_lahir . ', ' . $data->tgl_lahir }}</td>
                                                    <td>{{ $data->alamat_rumah }}</td>
                                                    <td>{{ $data->gender }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>{{ $data->status_kepegawaian }}</td>
                                                    <td>{{ $data->agama }}</td>
                                                    <td>{{ $data->pendidikan }}</td>
                                                    <td>{{ $data->kabupaten }}</td>
                                                    <td>
                                                        {{ $data->satuan_pendidikan }}
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
                                                            onclick="verifikasi({{ $data->id }}, 'guru', '{{ $data->is_verif }}')">Verifikasi</a>

                                                        <a href="#" class="btn btn-info"><i
                                                                class="fas fa-print"></i></a>
                                                        <a href="{{ route('guru.edit', $data->id) }} "
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        {{-- <a href="{{ route('guru.hapus' , $data->id) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> --}}
                                                        <button onclick="deleteData({{ $data->id }}, 'guru')"
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
        <!-- Page Specific JS File -->
          <script>
        $(document).ready(function() {
            var table = $("#table-guru").DataTable();

            // Function to filter table
            function filterTable() {
                var statusKepegawaian = $('#status_kepegawaian').val();
                var satuanPendidikan = $('#satuan_pendidikan').val();
                var kabupaten = $('#kabupaten').val();
                var jabatan = $('#jabatan').val();

                table.column(10).search(statusKepegawaian).draw();  // Column index 10 for Status Kepegawaian
                table.column(14).search(satuanPendidikan).draw();  // Column index 14 for Satuan Pendidikan
                table.column(13).search(kabupaten).draw();         // Column index 13 for Kabupaten/Kota
                table.column(9).search(jabatan).draw();            // Column index 9 for Jabatan
            }

            // Event listeners for select elements
            $('#status_kepegawaian, #satuan_pendidikan, #kabupaten, #jabatan').on('change', function() {
                filterTable();
            });
        });
    </script>
    @endpush
@endsection

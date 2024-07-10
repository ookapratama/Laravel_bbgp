@extends('layouts.app', ['title' => 'Data Pegawai BBGP'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pegawai BBGP</h1>
            </div>


            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('pegawai.create') }}" class="btn btn-primary my-4">
                                    <i class="fas fa-plus"></i>
                                    Tambah Data Pegawai BBGP
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Pas Foto</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>Nomor KTP</th>
                                                <th>Tempat, Tanggal Lahir</th>
                                                <th>Alamat Rumah</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jabatan</th>
                                                <th>Status</th>
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
                                            @foreach ($datas as $i => $data)
                                                <tr>
                                                    <td>
                                                        {{ ++$i }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('/upload/pegawai/' . $data->pas_foto) }}"
                                                            alt="" class="img-fluid">

                                                    </td>
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
        <!-- Page Specific JS File -->
    @endpush
@endsection

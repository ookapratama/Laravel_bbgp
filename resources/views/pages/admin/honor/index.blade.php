@extends('layouts.app', ['title' => 'Data Honor Kegiatan'])

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
                <h1>Data Honor Kegiatan BBGP</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Navigation Buttons -->
                                <div class="text-white">

                                    <a href="{{ route('honor.create') }}" class="btn btn-primary text-white my-3">+ Tambah
                                        Honor</a>
    
                                    <a target="_blank" href="{{ route('honor.cetak', 'panitia') }}" class="btn btn-info mx-3"><i class="fas fa-print mr-2"></i>Print Honor
                                        Panitia</a>
    
                                    <a target="_blank" href="{{ route('honor.cetak', 'narasumber') }}" class="btn btn-info "><i class="fas fa-print mr-2"></i>Print Honor
                                        Narasumber</a>

                                </div>


                                <!-- Filter Section -->
                                {{-- <h5>Pencarian Data Honor Kegiatan BBGP</h5>
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input name="nama" id="namaFilter" type="text"
                                                placeholder="Masukkan nama anda" class="form-control">
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Filter Data Honor Kegiatan -->
                                {{-- <h5>Filter Data Honor Kegiatan</h5>
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
                                <!-- PPNPN -->
                                <div class="table-responsive ">
                                    <!-- Table PPNPN -->
                                    <table class="table table-striped " id="table-kegiatan">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama Penerima</th>
                                                <th>Jabatan dalam kegiatan</th>
                                                <th>Jenis Golongan</th>
                                                <th>Golongan</th>
                                                <th>Instansi</th>
                                                <th>JP Realisasi</th>
                                                <th>Jumlah</th>
                                                <th>Jumlah Honor</th>
                                                <th>Jumlah Diterima</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                               

                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data['nama'] ?? '' }}</td>
                                                    <td>{{ $data['jabatan'] ?? '' }}</td>
                                                    <td>{{ $data['jenis_gol'] ?? '' }}</td>
                                                    <td>{{ $data['golongan'] ?? '' }}</td>
                                                    <td>{{ $data['instansi'] ?? '' }}</td>
                                                    <td>{{ $data['jp_realisasi'] }}.0</td>
                                                    <td>{{ $data['jumlah'] ?? 0 }} </td>
                                                    <td>{{ $data['jumlah_honor'] ?? 0 }}</td>
                                                    <td>{{ $data['total'] ?? 0 }}</td>
                                                    {{-- <td>
                                                        @if ($data->status == 'true')
                                                            <span class="badge badge-success">Aktif</span>
                                                        @else
                                                            <span class="badge badge-danger">Non-Aktif</span>
                                                        @endif

                                                    </td> --}}
                                                    <td>
                                                        <a href="{{ route('honor.edit', $data['id']) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteData({{ $data['id'] }}, 'honor')"
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

        <script type="text/javascript"></script>
    @endpush
@endsection

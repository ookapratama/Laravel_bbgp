@extends('layouts.user.app', ['title' => 'Data Eksternal'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    @endpush

    <div class="main-content ">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1 class="text-primary"><u> Data Eksternal BBGP Sulawesi Selatan</u> </h1>
                <div class=" mt-3">
                    {{-- <a href="{{ route('user.form_guru') }}" target="_blank" class="btn btn-primary"><i class="fas fa-users mr-2"></i> Daftar
                        Eksternal BBGP</a> --}}

                </div>

            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">This is Example Page</h2>
                <p class="section-lead">This page is just an example for you to create your own page.</p> --}}
                <div class="card">

                    <div class="card-body">

                        {{-- <form action="{{ route('user.cek_pegawai') }}" method="POST">
                            @csrf --}}
                        {{-- Filter Data --}}
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <h5>Pencarian Data Eksternal BBGP </h5>
                                    <input name="nama" id="namaFilter" type="text" value=""
                                        placeholder="Masukkan nama anda" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h5>Filter Data Eksternal</h5>
                                {{-- <button class="btn btn-lg btn-primary px-5 ">
                                        <i class="fas fa-search"></i>
                                        Cari Data</button> --}}
                                <select class="form-control selectric">
                                    <option>-- Filter By Jabatan Eksternal BBGP --</option>
                                    <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                    <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                    <option value="Stakeholder">Stakeholder</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <select id="status_kepegawaian" class="form-control select2">
                                    <option value="">-- Pilih status kepegawaian --</option>
                                    {{-- @foreach ($status['s_kepegawaian'] as $v)
                                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                                        @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-3 mb-4">
                                <select id="satuan_pendidikan" class="form-control select2">
                                    <option value="">-- Pilih status Satuan Pendidikan --</option>
                                    {{-- @foreach ($status['s_kependidikan'] as $v)
                                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                                        @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-3 mb-4">
                                <select id="kabupaten" class="form-control select2">
                                    <option value="">-- Pilih Kabupaten / Kota --</option>
                                    {{-- @foreach ($status['s_kabupaten'] as $v)
                                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                                        @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-3 mb-4">
                                <select id="jabatan" class="form-control select2">
                                    <option value="">-- Pilih Jabatan Sekolah --</option>
                                    {{-- @foreach ($status['s_jabatan'] as $v)
                                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                                        @endforeach --}}
                                </select>
                            </div>
                        </div>
                        {{-- </form> --}}

                        <div class="data-not-found alert alert-info">Silahkan cari data eksternal anda, jika tidak ada.
                            Silahkan hubungi admin</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-guru">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        {{-- <th>Pas Foto</th> --}}
                                        <th>Nomor KTP</th>
                                        <th>NPSN Sekolah</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan Sekolah</th>
                                        <th>Status Kepagawaian</th>
                                        <th>Satuan Pendidikan</th>
                                        <th>Kecamatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $i => $data)
                                        <tr>
                                            <td>
                                                {{ ++$i }}
                                            </td>
                                            {{-- <td>
                                                <img src="{{ asset('storage/upload/pegawai/' . $data->pas_foto) }}"
                                                    alt="" class="img-fluid" />

                                            </td> --}}
                                            <td>{{ $data->no_ktp }}</td>
                                            <td>{{ $data->npsn_sekolah }} - {{ $data->sekolah->nama_sekolah ?? '' }}</td>
                                            <td>{{ $data->nama_lengkap }}</td>
                                            <td>{{ $data->gender }}</td>
                                            <td>{{ $data->jabatan }}</td>
                                            <td>{{ $data->status_kepegawaian }}</td>
                                            <td>
                                                {{ $data->satuan_pendidikan }}
                                            </td>
                                            <td>
                                                {{ $data->alamat_satuan }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                    {{-- <div class="card-footer bg-whitesmoke">
                        This is card footer
                    </div> --}}
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/gmaps/gmaps.min.js') }}"></script>
        <script src="{{ asset('js/page/gmaps-simple.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                // Inisialisasi DataTable
                var tableGuru = $('#table-guru').DataTable();

                // Pilih elemen input dan div pesan
                const namaInput = document.querySelector('#namaFilter');
                const noDataMessage = document.querySelector('.data-not-found');

                // Tambahkan event listener untuk input keyup
                namaInput.addEventListener('keyup', function() {
                    // const searchText = namaInput.value;
                    const searchText = namaInput.value.trim(); // Trim whitespace dari input
                    console.log('Search Text:', searchText); // Debug log untuk pencarian

                    // Update the search dan redraw tableGuru
                    tableGuru.column(3).search(searchText).draw();

                    // Periksa jumlah hasil pencarian
                    const info = tableGuru.page.info();
                    console.log(tableGuru.search(searchText).draw()); // Debug log untuk hasil

                    if (info.recordsDisplay === 0) {
                        noDataMessage.style.display = 'block';
                    } else {
                        noDataMessage.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
@endsection

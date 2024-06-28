@extends('layouts.user.app', ['title' => 'Data Guru'])

@section('content')
    @push('styles')
    @endpush

    <div class="main-content ">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1 class="text-primary"><u> Data Guru BBGP Sulawesi Selatan</u> </h1>
                <div class=" mt-3">
                    <a href="{{ route('user.form_pegawai') }}" target="_blank" class="btn btn-primary"><i class="fas fa-users mr-2"></i> Daftar
                        Guru</a>
                </div>

            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">This is Example Page</h2>
                <p class="section-lead">This page is just an example for you to create your own page.</p> --}}
                <div class="card">

                    <div class="card-body">
                        {{-- <form action="{{ route('user.cek_pegawai') }}" method="POST">
                            @csrf --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <h5>Pencarian Data Guru </h5>
                                    <input name="no_ktp" id="no_ktp" type="number" value="a"
                                        placeholder="Masukkan nomor KTP anda" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{-- <button class="btn btn-lg btn-primary px-5 ">
                                        <i class="fas fa-search"></i>
                                        Cari Data</button> --}}
                            </div>
                        </div>
                        {{-- </form> --}}
                        <div class="data-not-found alert alert-info">Silahkan cari data anda, jika tidak ada, Silahkan Daftar Guru</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-guru">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Pas Foto</th>
                                        <th>Nomor KTP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Golongan/Jabatan</th>
                                        <th>Status Kepagawaian</th>
                                        <th>Satuan Pendidikan</th>
                                        <th>Alamat Satuan Pendidikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $i => $data)
                                        <tr>
                                            <td>
                                                {{ ++$i }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/upload/pegawai/' . $data->pas_foto) }}"
                                                    alt="" class="img-fluid" />

                                            </td>
                                            <td>{{ $data->no_ktp }}</td>
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
    @endpush
@endsection

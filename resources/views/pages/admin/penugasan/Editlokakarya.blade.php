@extends('layouts.app', ['title' => 'Internal'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Lokakarya</h1>
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form
                            action="{{ route('internal.update.lokakarya') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pendamping->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nama Pendamping</label>
                                                <input readonly value="{{ $pendamping->nama }}" required name="nama"
                                                    type="text" class="form-control">
                                                {{-- <select name="nama" class="form-control select2" id="selectNama">
                                                    <option value="">-- Pilih Pegawai --</option>

                                                    @foreach ($datas['dataPegawai'] as $v)
                                                        <option data-nip="{{ $v->nip }}"
                                                            value="{{ $v->nama_lengkap }}">{{ $v->nama_lengkap }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input readonly value="{{ $pendamping->nik }}" required name="nik" type="text"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input readonly value="{{ $pendamping->nip }}" required name="nip" type="text"
                                                    class="form-control">
                                            </div>

                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat</label>
                                                <input required name="tempat" type="text" class="form-control">
                                            </div>

                                        </div> --}}

                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kegiatan</label>
                                                <input required name="kegiatan" type="text" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Kegiatan</label>
                                                <input required name="tgl_kegiatan" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>-</label>
                                            <input required readonly name="jenis" type="text"
                                                value="Pendamping Lokakarya" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kabupaten / Kota</label>
                                            <select required name="kota" class="form-control select2">
                                                <option value="">-- Pilih kabupaten/kota --</option>
                                                @foreach ($datas['kota'] as $v)
                                                    <option {{ $pendamping->kota == $v->name ? 'selected' : '' }} value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Mulai Kegiatan</label>
                                                <input type="text" name="mulai_kegiatan"
                                                    class="form-control datetimepicker"
                                                    value="{{ $datas['mulai_kegiatan'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Selesai Kegiatan</label>
                                                <input type="text" name="selesai_kegiatan"
                                                    class="form-control datetimepicker"
                                                    value="{{ $datas['selesai_kegiatan'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Transport Pulang</label>
                                                <input value="{{ $pendamping->transport_pulang }}" required name="transport_pulang" type="number" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Transport Pergi</label>
                                                <input value="{{ $pendamping->transport_pergi }}" required name="transport_pergi" type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hotel</label>
                                                <input value="{{ $pendamping->hotel }}" required name="hotel" type="text" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 1</label>
                                                <input value="{{ $pendamping->hari_1 }}" required name="hari_1" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 2</label>
                                                <input value="{{ $pendamping->hari_2 }}" required name="hari_2" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hari 3</label>
                                                <input value="{{ $pendamping->hari_3 }}" required name="hari_3" type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>




                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary " type="submit">Submit</button>
                                    <button class="btn btn-secondary mx-1" type="reset">Reset</button>
                                    <a href="{{ session('role') == 'pegawai' ? route('pegawai.show', session('no_ktp')) : route('internal.index') }}"
                                        class="btn btn-warning">Kembali</a>
                                </div>
                        </form>
                    </div>

                </div>



            </div>
    </div>
    </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Initialize Select2
                $('#selectNama').select2();

                // Handle change event on select element
                $('#selectNama').on('change', function() {
                    // Get selected option
                    var selectedOption = $(this).find(':selected');

                    // Get NIP from data-nip attribute
                    var nip = selectedOption.data('nip');

                    // Set NIP value to input field
                    $('input[name="nip"]').val(nip);
                });
            });
        </script>
    @endpush
@endsection

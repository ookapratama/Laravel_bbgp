@extends('layouts.app', ['title' => 'Data Kuitansi'])

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
                <h1>Data Kuitansi BBGP</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('kuitansi.create') }}" class="btn btn-primary text-white my-3">+ Tambah
                                    Kuitansi</a>
                                <h6>Print Absensi</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="" class="form-control" id="kegiatanSelect">
                                                <option value="">-- pilih kegiatan --</option>
                                                @foreach ($datas as $v)
                                                    <?php
                                                    setlocale(LC_TIME, 'id_ID.UTF-8');
                                                    $tgl_kegiatan = strftime('%d %B', strtotime($v->tgl_kegiatan));
                                                    $tgl_selesai = strftime('%d %B %Y', strtotime($v->tgl_selesai));
                                                    ?>
                                                    <option value="{{ $v->id }}">{{ $v->nama_kegiatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md mb-4">
                                        <div id="btnGroup">
                                            <button id="btnPrintPeserta" class="btn btn-primary"><i
                                                    class="fas fa-print mr-2"></i>Absensi Peserta</button>
                                            <button id="btnPrintRegisPeserta" class="btn btn-primary"><i
                                                    class="fas fa-print mr-2"></i>Registrasi Peserta</button>
                                            <button id="btnPrintPanitia" class="btn btn-info"><i
                                                    class="fas fa-print mr-2"></i>Absensi Panitia</button>
                                            <button id="btnPrintNarsum" class="btn btn-warning"><i
                                                    class="fas fa-print mr-2"></i>Absensi Narasumber</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-temp">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nomor Bukti</th>
                                                <th>Tahun Anggaran</th>
                                                <th>Nomor MAK</th>
                                                <th>Biaya Penginapan</th>
                                                <th>Biaya Uang Harian</th>
                                                <th>Durasi Penginapan</th>
                                                <th>Durasi Uang Harian</th>
                                                <th>Total Biaya Penginapan</th>
                                                <th>Total Biaya Harian</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $data->no_bukti ?? '' }}</td>
                                                <td>{{ $data->tahun_anggaran ?? '' }}</td>
                                                <td>{{ $data->no_MAK ?? '' }}</td>
                                                <td>Rp {{ number_format($data->biaya_penginapan ?? 0, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data->biaya_uang_harian ?? 0, 0, ',', '.') }}</td>
                                                <td>{{ $data->durasi_penginapan ?? '' }}</td>
                                                <td>{{ $data->durasi_uang_harian ?? '' }}</td>
                                                <td>Rp {{ number_format($data->total_biaya_penginapan ?? 0, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data->total_biaya_harian ?? 0, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('kuitansi.edit', $data->id) }}" class="btn btn-warning btn-sm"><i
                                                            class="fas fa-edit"></i> Edit</a>
                                                    <button onclick="deleteData({{ $data->id }}, 'kuitansi')" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash-alt"></i> Hapus</button>
                                                </td>
                                            </tr>
                                            @if($data->transportasis->isNotEmpty())
                                            <tr>
                                                <td colspan="11">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Transportasi</th>
                                                                    <th>Asal</th>
                                                                    <th>Tujuan</th>
                                                                    <th>Biaya</th>
                                                                    <th>Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data->transportasis as $transportasi)
                                                                    <tr>
                                                                        <td>{{ $transportasi->transportasi ?? '' }}</td>
                                                                        <td>{{ $transportasi->asal_transport ?? '' }}</td>
                                                                        <td>{{ $transportasi->tujuan_transport ?? '' }}</td>
                                                                        <td>Rp {{ number_format($transportasi->biaya_transport ?? 0, 0, ',', '.') }}</td>
                                                                        <td>{{ $transportasi->keterangan ?? '' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
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

        <script type="text/javascript">
            $(document).ready(function() {
                var language = {
                    "sSearch": "Pencarian Data Kuitansi BBGP : ",
                };
                var tableKuitansi = $('#table-temp').DataTable({
                    paging: true,
                    searching: true,
                    language: language,
                });

                $('#btnPrintPeserta').on('click', function() {
                    handlePrint('peserta');
                });

                $('#btnPrintRegisPeserta').on('click', function() {
                    handlePrint('regis_peserta');
                });

                $('#btnPrintPanitia').on('click', function() {
                    handlePrint('panitia');
                });

                $('#btnPrintNarsum').on('click', function() {
                    handlePrint('narsum');
                });

                function handlePrint(type) {
                    var kegiatanId = $('#kegiatanSelect').val();
                    if (kegiatanId === '') {
                        swal('Warning','Silakan pilih kegiatan terlebih dahulu!', 'warning');
                        return;
                    }

                    var printUrl = '';

                    switch (type) {
                        case 'peserta':
                            printUrl = '{{ route('print.absensi.peserta') }}' + '?kegiatan_id=' + kegiatanId;
                            break;
                        case 'regis_peserta':
                            printUrl = '{{ route('print.registrasi.peserta') }}' + '?kegiatan_id=' + kegiatanId ;
                            break;
                        case 'panitia':
                            printUrl = '{{ route('print.absensi.panitia') }}' + '?kegiatan_id=' + kegiatanId;
                            break;
                        case 'narsum':
                            printUrl = '{{ route('print.absensi.narasumber') }}' + '?kegiatan_id=' + kegiatanId;
                            break;
                    }

                    window.open(printUrl, '_blank');
                }
            });
        </script>
    @endpush
@endsection

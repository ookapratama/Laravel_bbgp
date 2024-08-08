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
                                <div class="row mb-3">
                                    <div class="col-10">
                                        <h4 id="title-text">Data Pendamping Lokakarya
                                            {{ $datas['getNama']->nama ?? $datas['getNamaPpnpn']->nama }}</h4>
                                    </div>
                                    <div class="col text-right">
                                        <a href="{{ route('internal.index') }}" class="btn btn-warning">Kembali </a>
                                    </div>
                                </div>

                                <div class="table-responsive" id="table-internal-bbgp">
                                    <!-- Table BBGP -->
                                    <table class="table table-striped" id="table-bbgp">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama</th>
                                                <th>Kegiatan</th>
                                                <th>Kabupaten/Kota</th>
                                                <th>Hotel</th>
                                                <th>Biaya Pergi</th>
                                                <th>Biaya Pulang</th>
                                                <th>Bill Penginapan</th>
                                                <th>Hari 1</th>
                                                <th>Hari 2</th>
                                                <th>Hari 3</th>
                                                <th>Hari 4</th>
                                                <th>Hari 5</th>
                                                <th>Hari 6</th>
                                                <th>Hari 7</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas['penugasanLokakarya'] ?? $datas['penugasanLokakaryaPpnpn'] as $i => $data)
                                                @php
                                                    $total = $data->transport_pulang + $data->transport_pergi + $data->bill_penginapan + $data->hari_1 + $data->hari_2 + $data->hari_3;
                                                 @endphp
                                                <tr data-type="bbgp">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $data->nama }} </td>
                                                    <td>{{ $data->kegiatan }} </td>
                                                    <td>{{ $data->kota }}</td>
                                                    <td>{{ $data->hotel }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->transport_pulang, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->transport_pergi, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->bill_penginapan, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->hari_1, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->hari_2, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->hari_3, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->hari_4, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->hari_5, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->hari_6, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap">Rp. {{ number_format($data->hari_7, 0, ',', '.') }}</td>
                                                    <td class="text-nowrap"><b> Rp. {{ number_format($total, 0, ',', '.') }} </b></td>
                                                    <td>
                                                        <a href="{{ route('internal.edit.lokakarya', $data->id) }}"
                                                            class="btn btn-warning my-2"><i class="fas fa-edit"></i></a>
                                                        <button onclick="deleteDataLoka({{ $data->id }}, 'internal')"
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
        <script type="text/javascript">
            $(document).ready(function() {
                var language = {
                    "sSearch": "Pencarian Data Internal BBGP : ",
                };
                // Initialize DataTables for both tables
                var tableBbgp = $('#table-bbgp').DataTable({
                    paging: true,
                    searching: true,
                    language: language,
                    columnDefs: [{
                        targets: [4, 5, 6, 7, 8],
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    }]
                });

                // Initially hide both tables
                $('.table-internal').hide();

                // Show appropriate table based on button click
                $('#pegawaiBBGP').on('click', function(event) {
                    event.preventDefault();
                    $('.table-internal').hide();
                    $('#table-internal-bbgp').show();
                    tableBbgp.columns.adjust().draw(); // Adjust column widths on table show
                    $('#title-text').text('Data Penugasan Pegawai')
                });

                // Filter by Nama
                $('#namaFilter').on('keyup', function() {
                    tableBbgp.column(1).search(this.value).draw();
                    tableBbgp.column(2).search(this.value).draw();
                    tableBbgp.column(3).search(this.value).draw();
                });

                // Reset button functionality
                $('#resetBtn').on('click', function() {
                    $('#rekapan').val('');
                    $('#namaFilter').val('');
                    $('.table-internal').hide();
                    tableBbgp.search('').columns().search('').draw();
                });
            });
        </script>

        <script>
            // swal btn hps data
            const deleteDataLoka = (id, tabel) => {
                console.log(id, tabel);
                let token = $("meta[name='csrf-token']").attr("content");

                swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    console.log(willDelete);

                    if (willDelete) {
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": token,
                            },
                            type: "POST",
                            url: `{{ route('internal.hapus.loka', ['id' => 'PLACEHOLDER_ID']) }}`
                                .replace('PLACEHOLDER_ID', id),
                            success: function(response) {
                                console.log(response);
                                if (response) {
                                    swal("Terhapus", "Data telah dihapus", "success").then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swal("Error", "Gagal menghapus data.", "error");
                                }
                            },
                            error: function(error) {
                                console.error("AJAX Error:", error);
                                swal("Error", "Terjadi kesalahan saat menghapus data.", "error");
                            },
                        });
                    }
                });
            };
        </script>
    @endpush
@endsection

@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons-wind.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/fullcalendar/dist/fullcalendar.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            @if (session('role') == 'admin' || session('role') == 'superadmin' || session('role') == 'kepala')
                <div class="card">
                    <div class="card-header">
                        <h4>Data Statistik</h4>
                    </div>
                    <div class="card-body">
                        <h4>Filter Ketenagaan <span id="title-chart"></span></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="" class="form-control selectric" id="filterKetenagaan">
                                        <option value="">-- pilih ketenagaan --</option>
                                        <option value="tenagaPendidik">Tenaga Pendidik</option>
                                        <option value="tenagaKependidikan">Tenaga Kependidikan</option>
                                        <option value="stakeholder">Stakeholder</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- tenaga pendidik --}}
                        <div id="tenagaPendidik">

                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Guru</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="guruChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Konselor</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="konselorChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Lainnya</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="lainChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        {{-- tenaga kependidik --}}
                        <div id="tenagaKependidikan">

                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Pengawas</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="pengawasChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Kepala Sekolah</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="kepalaSekolahChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Lainnya (Tenaga Kependidikan)</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="lainTenagaKependidikanChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- stakeholder --}}
                        <div id="stakeholder">

                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Data Stakeholder</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas width="500" height="500" id="stakeholderChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Calendar Penugasan Dan Pendamping Lokakarya</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="fc-overflow">
                                <div id="jadwal"></div>
                            </div>

                        </div>

                    </div>
                </div>
            @endif

            @if (session('role') == 'pegawai')
                <div class="card">
                    <div class="card-header">
                        <h4>Calendar Penugasan Dan Pendamping Lokakarya</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="fc-overflow">
                                <div id="jadwal-pegawai"></div>
                            </div>

                        </div>

                    </div>
                </div>
            @endif


        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Detail Penugasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Penugasan:</strong> <span id="eventTitle"></span></p>
                    <p><strong>Tipe Penugasan:</strong> <span id="eventType"></span></p>
                    <p><strong>Atas nama:</strong> <span id="eventNama"></span></p>
                    <p><strong>Tanggal Kegiatan:</strong> <span id="eventStart"></span></p>
                    {{-- <p><strong>Jam Kegiatan:</strong> <span id="eventTime"></span></p> --}}
                    <p><strong>Deskripsi:</strong> <span id="eventDescription"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/id.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
        <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>


        <script>
            $(document).ready(function() {

                // $('.has-dropdown').click(function(e) {
                //     e.preventDefault();
                //     $(this).next('.dropdown-menu').slideToggle();
                // });
                moment.locale('id');
                let token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    type: "GET",
                    url: `dashboard/jadwalKegiatan`,
                    success: function(response) {
                        var data = [];

                        response.jadwal.forEach(element => {
                            var mulai = element.tgl_kegiatan + ' ' + (element.jam_mulai ??
                                '00:00:00');
                            var selesai = element.tgl_selesai_kegiatan + ' ' + (element
                                .jam_selesai ?? '23:59:59');

                            // Generate random color
                            var randomColor = getRandomColor();
                            data.push({
                                title: `${element.kegiatan == '' || element.kegiatan == undefined ? element.jenis : element.kegiatan}`,
                                start: moment(mulai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                end: moment(selesai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                backgroundColor: randomColor,
                                textColor: '#fff',
                                nama: element.nama,
                                jenis: element.jenis ?? '',
                                description: element.deskripsi,
                                tgl: `${moment(element.tgl_kegiatan).format('dddd, D MMMM')} s/d ${moment(element.tgl_selesai_kegiatan).format('dddd, D MMMM YYYY')}`,
                                jam: `${element.jam_mulai ?? ''} - ${element.jam_selesai ?? ''} WITA`,
                            });
                        });

                        $("#jadwal").fullCalendar({
                            locale: 'id',
                            height: 'auto',
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay,listWeek'
                            },
                            editable: true,
                            events: data,
                            eventClick: function(event, jsEvent, view) {
                                console.log(event.title == '' ? event.jenis : event.title);

                                // Set the information in the modal
                                $("#eventTitle").text(event.title);
                                $("#eventType").text(event.jenis);
                                $("#eventNama").text(event.nama);
                                $("#eventStart").text(event.tgl); // Format in Indonesian
                                // $("#eventTime").text(event.jam ? event.jam :
                                //     "N/A"); // Format in Indonesian
                                $("#eventDescription").text(event.description ? stripHtml(event
                                    .description) : "Tidak ada deskripsi");

                                // Show the modal
                                $("#eventModal").modal('show');
                            }
                        });
                    },
                    error: function(error) {
                        console.error("AJAX Error:", error);
                        swal("Error", "Ajax Error.", "error");
                    },
                });

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    type: "GET",
                    url: `dashboard/jadwalKegiatan/{{ session('no_ktp') }}`,
                    success: function(response) {
                        var data = [];
                        console.log(response);

                        response.jadwal.forEach(element => {
                            var mulai = element.tgl_kegiatan + ' ' + (element.jam_mulai ??
                                '00:00:00');
                            var selesai = element.tgl_selesai_kegiatan + ' ' + (element
                                .jam_selesai ?? '23:59:59');
                            // Generate random color
                            var randomColor = getRandomColor();

                            data.push({
                                title: `${element.kegiatan == '' || element.kegiatan == undefined ? element.jenis : element.kegiatan}`,
                                start: moment(mulai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                end: moment(selesai).format(
                                    'YYYY-MM-DDTHH:mm:ss'), // Format in ISO 8601
                                backgroundColor: randomColor,
                                textColor: '#fff',
                                nama: element.nama,
                                jenis: element.jenis ?? '',
                                description: element.deskripsi,
                                tgl: `${moment(element.tgl_kegiatan).format('dddd, D MMMM')} s/d ${moment(element.tgl_selesai_kegiatan).format(' D MMMM YYYY')}`,
                                jam: `${element.jam_mulai ?? ''} - ${element.jam_selesai ?? ''} WITA`,

                            });
                        });

                        $("#jadwal-pegawai").fullCalendar({
                            locale: 'id',
                            height: 'auto',
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay,listWeek'
                            },
                            editable: true,
                            events: data,
                            eventClick: function(event, jsEvent, view) {
                                console.log(event);

                                // Set the information in the modal
                                $("#eventTitle").text(event.title == '' || event.title ==
                                    undefined ? event.jenis : event
                                    .title);
                                $("#eventType").text(event.jenis);
                                $("#eventNama").text(event.nama);
                                $("#eventStart").text(event.tgl); // Format in Indonesian
                                $("#eventTime").text(event.jam ? event.jam :
                                    "N/A"); // Format in Indonesian
                                $("#eventDescription").text(event.description ? stripHtml(event
                                    .description) : "Tidak ada deskripsi");

                                // Show the modal
                                $("#eventModal").modal('show');
                            }

                        });
                    },
                    error: function(error) {
                        console.error("AJAX Error:", error);
                        swal("Error", "Ajax Error.", "error");
                    },
                });

                function stripHtml(html) {
                    var temporalDivElement = document.createElement("div");
                    temporalDivElement.innerHTML = html;
                    return temporalDivElement.textContent || temporalDivElement.innerText || "";
                }

                let tp = $('#tenagaPendidik').hide();
                let tk = $('#tenagaKependidikan').hide();
                let stk = $('#stakeholder').hide();
                let titleChart = $('#title-chart');

                $('#filterKetenagaan').on('change', function() {
                    let val = $(this).find('option:selected').val();

                    if (val == '') {
                        titleChart.text('')
                        tp.hide();
                        tk.hide();
                        stk.hide();
                    } else if (val == 'tenagaPendidik') {
                        titleChart.text('Tenaga Pendidik')

                        tp.show();
                        tk.hide();
                        stk.hide();
                    } else if (val == 'tenagaKependidikan') {
                        tp.hide();
                        titleChart.text('Tenaga Kependidikan')

                        tk.show();
                        stk.hide();
                    } else if (val == 'stakeholder') {
                        titleChart.text('Stakeholder')

                        tp.hide();
                        tk.hide();
                        stk.show();
                    }


                });




                // Function to generate random color
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            });
        </script>

        <script>
            const tenagaPendidikData = <?= json_encode($datas['tenaga_pendidik']) ?>;

            // Filter data for 'guru' and 'konselor'
            const guruLabels = Object.keys(tenagaPendidikData).filter(key => key.includes('guru'));
            const guruValues = guruLabels.map(key => tenagaPendidikData[key]);

            const konselorLabels = Object.keys(tenagaPendidikData).filter(key => key.includes('konselor'));
            const konselorValues = konselorLabels.map(key => tenagaPendidikData[key]);

            const otherLabels = Object.keys(tenagaPendidikData).filter(key => !key.includes('guru') && !key.includes(
                'konselor'));
            const otherValues = otherLabels.map(key => tenagaPendidikData[key]);

            // Custom label for Data Lainnya
            const customOtherLabels = otherLabels.map(label => {
                switch (label) {
                    case 'dosen':
                        return 'Dosen';
                    case 'tutor':
                        return 'Tutor';
                    case 'fasilitator':
                        return 'Fasilitator';
                    case 'pamong':
                        return 'Pamong Belajar';
                    case 'widya':
                        return 'Widya Iswara';
                    case 'instruktur':
                        return 'Instruktur';
                    default:
                        return label;
                }
            });

            // Custom label for Data Guru
            const customGuruLabels = guruLabels.map(label => {
                switch (label) {
                    case 'guruGP':
                        return 'Guru Penggerak';
                    case 'guruTGP':
                        return 'Guru Penggerak Tugas GP';
                    case 'guruPP':
                        return 'Guru Penggerak Tugas Pengajar Praktik';
                    case 'guruFasil':
                        return 'Guru Penggerak Tugas Fasilitator';
                    case 'guruInstruktur':
                        return 'Guru Penggerak Tugas Instruktur';
                    case 'guruNonGP':
                        return 'Guru Non Guru Penggerak';
                    default:
                        return label;
                }
            });

            // Custom label for Data Konselor
            const customKonselorLabels = konselorLabels.map(label => {
                switch (label) {
                    case 'konselorGP':
                        return 'Konselor Guru Penggerak';
                    case 'konselorTGP':
                        return 'Konselor Guru Penggerak Tugas GP';
                    case 'konselorPP':
                        return 'Konselor Guru Penggerak Pengajar Praktik';
                    case 'konselorFasil':
                        return 'Konselor Guru Penggerak Fasilitator';
                    case 'konselorInstruktur':
                        return 'Konselor Guru Penggerak Instruktur';
                    case 'konselorNonGP':
                        return 'Konselor Non Guru Penggerak';
                    default:
                        return label;
                }
            });

            // Donut Chart untuk Data Guru
            const guruCtx = document.getElementById('guruChart').getContext('2d');
            const guruChart = new Chart(guruCtx, {
                type: 'pie',
                data: {
                    labels: customGuruLabels,
                    datasets: [{
                        label: 'Jumlah Guru',
                        data: guruValues,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, i) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[i],
                                            strokeStyle: chart.data.datasets[0].borderColor[i],
                                            lineWidth: chart.data.datasets[0].borderWidth,
                                            index: i
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Donut Chart untuk Data Konselor
            const konselorCtx = document.getElementById('konselorChart').getContext('2d');
            const konselorChart = new Chart(konselorCtx, {
                type: 'pie',
                data: {
                    labels: customKonselorLabels,
                    datasets: [{
                        label: 'Jumlah Konselor',
                        data: konselorValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, i) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[i],
                                            strokeStyle: chart.data.datasets[0].borderColor[i],
                                            lineWidth: chart.data.datasets[0].borderWidth,
                                            index: i
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Donut Chart untuk Data Lainnya
            const lainCtx = document.getElementById('lainChart').getContext('2d');
            const lainChart = new Chart(lainCtx, {
                type: 'pie',
                data: {
                    labels: customOtherLabels,
                    datasets: [{
                        label: 'Jumlah Lainnya',
                        data: otherValues,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 99, 132, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, i) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[i],
                                            strokeStyle: chart.data.datasets[0].borderColor[i],
                                            lineWidth: chart.data.datasets[0].borderWidth,
                                            index: i
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Tenaga Kependidikan
            const tenagaKependidikData = <?= json_encode($datas['tenaga_kependidik']) ?>;

            console.log(tenagaKependidikData);
            // Filter data for Pengawas, Kepala Sekolah, and other Tenaga Kependidikan
            const pengawasLabels = Object.keys(tenagaKependidikData).filter(key => key.includes('pengawas'));
            const pengawasValues = pengawasLabels.map(key => tenagaKependidikData[key]);

            const kepalaSekolahLabels = Object.keys(tenagaKependidikData).filter(key => key.includes('kepsek'));
            const kepalaSekolahValues = kepalaSekolahLabels.map(key => tenagaKependidikData[key]);

            const otherKependidikanLabels = Object.keys(tenagaKependidikData).filter(key => !key.includes('pengawas') && !key
                .includes('kepsek'));
            const otherKependidikanValues = otherKependidikanLabels.map(key => tenagaKependidikData[key]);

            // Custom label for Data Lainnya
            const customOtherKependidikLabels = otherKependidikanLabels.map(label => {
                switch (label) {
                    case 'tata_usaha':
                        return 'Tata Usaha';
                    case 'pendidik':
                        return 'Pendidik';
                    case 'laboran':
                        return 'Laboran';
                    case 'pustakawan':
                        return 'Pustakawan';
                    default:
                        return label;
                }
            });

            // Custom label for Data Lainnya
            const customPengawasLabels = pengawasLabels.map(label => {
                switch (label) {
                    case 'pengawasGP':
                        return 'Pengawas Guru Penggerak';
                    case 'pengawasLGP':
                        return 'Pengawas Guru Penggerak Latar Sertifikat GP';
                    case 'pengawasLDC':
                        return 'Pengawas Guru Penggerak Latar Diklat Cawas';
                    case 'pengawasL':
                        return 'Pengawas Guru Penggerak Latar Lainnya';
                    case 'pengawasTGP':
                        return 'Pengawas Guru Penggerak Tugas GP';
                    case 'pengawasPP':
                        return 'Pengawas Guru Penggerak Tugas Pengajar Praktik';
                    case 'pengawasFasil':
                        return 'Pengawas Guru Penggerak Tugas Fasilitator';
                    case 'pengawasInstruktur':
                        return 'Pengawas Guru Penggerak Tugas Instruktur';
                    case 'pengawasNonGP':
                        return 'Pengawas Non Guru Penggerak';
                    default:
                        return label;
                }
            });

            // Custom label for Data Lainnya
            const customkepalaSekolahLabels = kepalaSekolahLabels.map(label => {
                switch (label) {
                    case 'kepsekGP':
                        return 'Kepala Sekolah Guru Penggerak';
                    case 'kepsekLGP':
                        return 'Kepala Sekolah Guru Penggerak Latar Sertifikat GP';
                    case 'kepsekLDC':
                        return 'Kepala Sekolah Guru Penggerak Latar Diklat Cakep';
                    case 'kepsekL':
                        return 'Kepala Sekolah Guru Penggerak Latar Lainnya';
                    case 'kepsekTGP':
                        return 'Kepala Sekolah Guru Penggerak Tugas GP';
                    case 'kepsekPP':
                        return 'Kepala Sekolah Guru Penggerak Tugas Pengajar Praktik';
                    case 'kepsekFasil':
                        return 'Kepala Sekolah Guru Penggerak Tugas Fasilitator';
                    case 'kepsekInstruktur':
                        return 'Kepala Sekolah Guru Penggerak Tugas Instruktur';
                    case 'kepsekNonGP':
                        return 'Kepala Sekolah Non Guru Penggerak';
                    default:
                        return label;
                }
            });

            // Create charts for Tenaga Kependidikan
            new Chart(document.getElementById('pengawasChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: customPengawasLabels,
                    datasets: [{
                        label: 'Jumlah Pengawas',
                        data: pengawasValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, i) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[i],
                                            strokeStyle: chart.data.datasets[0].borderColor[i],
                                            lineWidth: chart.data.datasets[0].borderWidth,
                                            index: i
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById('kepalaSekolahChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: customkepalaSekolahLabels,
                    datasets: [{
                        label: 'Jumlah Kepala Sekolah',
                        data: kepalaSekolahValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, i) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[i],
                                            strokeStyle: chart.data.datasets[0].borderColor[i],
                                            lineWidth: chart.data.datasets[0].borderWidth,
                                            index: i
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById('lainTenagaKependidikanChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: customOtherKependidikLabels,
                    datasets: [{
                        label: 'Jumlah Tenaga Kependidikan Lainnya',
                        data: otherKependidikanValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, i) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[i],
                                            strokeStyle: chart.data.datasets[0].borderColor[i],
                                            lineWidth: chart.data.datasets[0].borderWidth,
                                            index: i
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });


            // Stakeholder
            const stakeholderData = <?= json_encode($datas['stakeholder']) ?>;
            console.log(stakeholderData);

            const otherStakeholderLabels = Object.keys(stakeholderData).filter(key => !key.includes('pengawas') && !key
                .includes('kepsek'));
            const otherStakeholderValues = otherStakeholderLabels.map(key => stakeholderData[key]);

            // Custom label for Data Lainnya
            const customOtherStakeholderLabels = otherStakeholderLabels.map(label => {
                switch (label) {
                    case 'kpl_bidang':
                        return 'Kepala Bidang';
                    case 'kpl_dinas':
                        return 'Kepala Dinas';
                    case 'kpl_seksi':
                        return 'Kepala Seksi';
                    case 'pemerhati':
                        return 'Pemerhati Pendidik';
                    case 'pers':
                        return 'Pers';
                    case 'staff':
                        return 'Staff';
                    default:
                        return label;
                }
            });

            // Create chart for Stakeholder
            new Chart(document.getElementById('stakeholderChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: customOtherStakeholderLabels,
                    datasets: [{
                        label: 'Jumlah Stakeholder',
                        data: otherStakeholderValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function(chart) {
                                    return chart.data.labels.map(function(label, i) {
                                        return {
                                            text: label,
                                            fillStyle: chart.data.datasets[0].backgroundColor[i],
                                            strokeStyle: chart.data.datasets[0].borderColor[i],
                                            lineWidth: chart.data.datasets[0].borderWidth,
                                            index: i
                                        };
                                    });
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection

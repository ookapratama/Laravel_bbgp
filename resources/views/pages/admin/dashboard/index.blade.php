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
               
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Calendar Kegiatan</h4>
                </div>
                <div class="card-body">
                    <div class="fc-overflow">
                        <div id="jadwal"></div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
        <script src="{{ asset('library/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-calendar.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('js/page/index-0.js') }}"></script>
        {{-- <script>
            $(document).ready(function() {

                let token = $("meta[name='csrf-token']").attr("content");
                let jadwal = $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    type: "GET",
                    url: `/bbgp/public/dashboard/jadwalKegiatan`,
                    success: function(response) {
                        // console.log(response);
                        console.log(response.jadwalLokakarya);

                        var data = [];
                        response.jadwalLokakarya.forEach(element => {
                            console.log(element)
                            data.push({
                                title: `Kegiatan ${element.kegiatan}`,
                                start: element.tgl_kegiatan,
                                end: element.tgl_kegiatan,
                                backgroundColor: "green",
                                textColor: '#fff'

                            });
                        });
                        // console.log(data)
                        $("#jadwal").fullCalendar({
                            height: 'auto',
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay,listWeek'
                            },
                            editable: true,
                            // events: [{
                            //         title: 'Conference',
                            //         start: '2024-07-9',
                            //         end: '2024-07-11',
                            //         // duration: '02:00',
                            //         // start: '2024-07-06T08:00:00', // Waktu mulai: 9 Juli 2024 pukul 08:00 pagi
                            //         // end: '2024-07-11T10:00:00'  ,   
                            //         backgroundColor: "skyblue",
                            //         borderColor: "#fff",
                            //         textColor: '#000'
                            //     },

                            // ]
                            events: data

                        });

                    },
                    error: function(error) {
                        console.error("AJAX Error:", error);
                        swal("Error", "Ajax Error.", "error");
                    },
                });

                console.log(jadwal);


                var e = '';
                console.log(e)
                var data = [];
                // e.forEach(element => {
                //     console.log(element)
                //     data.push({
                //         title: `Jam ${element.mulai_212317} \n ${element.selesai_212317}`,
                //         start: element.periksa_212317,
                //         end: element.periksa_212317,
                //         backgroundColor: "green",
                //         textColor: '#fff'

                //     });
                // });
                // console.log(data)
                // $("#jadwal").fullCalendar({
                //     height: 'auto',
                //     header: {
                //         left: 'prev,next today',
                //         center: 'title',
                //         right: 'month,agendaWeek,agendaDay,listWeek'
                //     },
                //     editable: true,
                //     events: [{
                //             title: 'Conference',
                //             start: '2024-07-9',
                //             end: '2024-07-11',
                //             // duration: '02:00',
                //             // start: '2024-07-06T08:00:00', // Waktu mulai: 9 Juli 2024 pukul 08:00 pagi
                //             // end: '2024-07-11T10:00:00'  ,   
                //             backgroundColor: "skyblue",
                //             borderColor: "#fff",
                //             textColor: '#000'
                //         },

                //     ]
                //     // events: data

                // });
            })
        </script> --}}

        <script>
            $(document).ready(function() {
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
                            data.push({
                                title: `Kegiatan: ${element.kegiatan ?? '-'} | Atas Nama: ${element.nama}`,
                                start: element.tgl_kegiatan,
                                end: element.tgl_selesai_kegiatan,
                                backgroundColor: "green",
                                textColor: '#fff'
                            });
                        });
        
                        $("#jadwal").fullCalendar({
                            height: 'auto',
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay,listWeek'
                            },
                            editable: true,
                            events: data
                        });
                    },
                    error: function(error) {
                        console.error("AJAX Error:", error);
                        swal("Error", "Ajax Error.", "error");
                    },
                });
            });
        </script>
        

    @endpush
@endsection

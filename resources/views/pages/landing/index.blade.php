@extends('layouts.landing.app')
@section('content')
    @push('styles')
        <style>
            body {
                /* background-color: brown; */
            }
        </style>
    @endpush
    <div class="banner-carousel banner-carousel-1 mb-0">
        <div class="banner-carousel-item" style="background-image:url({{ asset('landing/images/slider-main/slide1.png') }})">
            <div class="slider-content">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12 text-center">
                            <h2 class="slide-title" data-animation-in="slideInLeft">Selamat Datang di</h2>
                            <h3 class="slide-sub-title" data-animation-in="slideInRight">BBGP Provinsi <br> Sulawesi Selatan
                            </h3>
                            <p data-animation-in="slideInLeft" data-duration-in="1.2">
                                {{-- <a href="services.html" class="slider btn btn-primary">Our Services</a>
                                <a href="contact.html" class="slider btn btn-primary border">Contact Now</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-carousel-item"
            style="background-image:url({{ asset('landing/images/slider-main/slide2.png') }})">
            <div class="slider-content text-left">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12">
                            <h2 class="slide-title-box" data-animation-in="slideInDown">Siap Melayani Anda</h2>
                            <h3 class="slide-title" data-animation-in="fadeIn">Dedikasi Kami untuk Guru</h3>
                            <h3 class="slide-sub-title" data-animation-in="slideInLeft">BBGP Provinsi Sulawesi Selatan</h3>
                            <p data-animation-in="slideInRight">
                                {{-- <a href="services.html" class="slider btn btn-primary border">Pelayanan Kami</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-carousel-item"
            style="background-image:url({{ asset('landing/images/slider-main/slide4.png') }})">
            <div class="slider-content text-right">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12">
                            <h2 class="slide-title" data-animation-in="slideInDown">Temui Para Penggerak Kami</h2>
                            <h3 class="slide-sub-title" data-animation-in="fadeIn">Keberlanjutan dalam Pendidikan</h3>
                            <p class="slider-description lead" data-animation-in="slideInRight">
                                Kami akan mendukung Anda
                                dalam meraih kesuksesan melalui pendidikan yang berkelanjutan.
                            </p>
                            <div data-animation-in="slideInLeft">
                                <a href="{{ route('user.kontak') }}" class="slider btn btn-primary"
                                    aria-label="contact-with-us">Hubungi
                                    Kami</a>
                                {{-- <a href="about.html" class="slider btn btn-primary border"
                                    aria-label="learn-more-about-us">Learn more</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="call-to-action-box no-padding">
        <div class="container my-container">
            <div class="action-style-box ">
                <ul class="info-box my-box-wrap">
                    <li class="single-info">

                        <div class="info-icon">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </div>
                        <div class="info-my-content">
                            <a href="">
                                <p>Unit Layanan Terpadu (ULT)</p>

                            </a>
                        </div>
                    </li>
                    <li class="single-info">
                        <div class="info-icon">
                            <i class="fas fa-award fa-lg"></i>
                        </div>
                        <div class="info-my-content">
                            <a href="">
                                <p>Standar Pelayanan</p>
                            </a>
                        </div>
                    </li>
                    <li class="single-info">
                        <div class="info-icon">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div class="info-my-content">
                            <a href="">
                                <p>Reformasi Birokrasi</p>
                            </a>
                        </div>
                    </li>
                    <li class="single-info">
                        <div class="info-icon">
                            <i class="fas fa-paste fa-lg"></i>
                        </div>
                        <div class="info-my-content">
                            <a href="">
                                <p>Akuntabilitas Kinerja Instansi Pemerintah (AKIP)</p>
                            </a>
                        </div>
                    </li>
                </ul>
                {{-- <div class="row align-items-center">
                    <div class="col-md-3 text-center info-box ">
                    </div>
                    <div class="col-md-3 text-center info-box">
                    </div>
                    <div class="col-md-3 text-center info-box">
                    </div>
                    <div class="col-md-3 text-center info-box">
                    </div>
                </div><!-- row end --> --}}
            </div><!-- Action style box -->
        </div><!-- Container end -->
    </section><!-- Action end -->

    {{-- slider icon img --}}
    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container">

            <div class="my-center-slider my-icon-slider">

                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('landing/images/icon-slider/logo-nogratifikasi.png') }}" alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('landing/images/icon-slider/logo-berakhlak.png') }}" alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('landing/images/icon-slider/logo-bangga-melayani.png') }}"
                                alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('landing/images/icon-slider/sehat-tanpa-korupsi.png') }}"
                                alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('landing/images/icon-slider/kami-siap-zi-wbk.png') }}" alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->



            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->




    <section id="ts-features" class="ts-features">
        <div class="container">
            <div class="row">


                <div class="col-lg-6">
                    <div class="ts-intro">
                        <h2 class="into-title">Tentang Kami</h2>
                        <h3 class="into-sub-title">BBGP Sulawesi Selatan</h3>
                        <p class="my-sub-content">
                            BBGP Provinsi Sulawesi Selatan adalah Unit Pelaksana Teknis Direktorat Jenderal Guru dan Tenaga
                            Kependidikan Kemendikbudristek dalam Bidang Pengembangan dan Pemberdayaan Guru, Pendidik
                            lainnya, Tenaga Kependidikan, Calon Kepala Sekolah, Kepala Sekolah, Calon Pengawas Sekolah, dan
                            Pengawas Sekolah di Provinsi Sulawesi Selatan.
                        </p>
                    </div><!-- Intro box end -->



                </div><!-- Col end -->

                <div class="col-lg-6 mt-4 mt-lg-4 justify-content-center">
                    <h3 class="into-sub-title"> </h3>
                    <div class="box-video">

                        <iframe width="420" height="315" src="https://www.youtube.com/embed/gJ3g7xX9O-s"
                            allowfullscreen>
                        </iframe>
                        <div class="video-title">Balai Besar Guru Penggerak</div>
                    </div>
                    <!--/ Accordion end -->
                </div><!-- Col end -->




            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Feature are end -->

    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container">

            <div class="row my-icon2-slider">

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-jurnal.png') }}"
                                alt="service-image">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Jurnal Edutrans</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-pengaduan.png') }}"
                                alt="service-image">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Pengaduan</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-ppid.png') }}"
                                alt="service-image">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a
                                        href="https://sites.google.com/instruktur.belajar.id/ult-bbgpsulsel">PPID</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-sim-penggiat.png') }}"
                                alt="service-image">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">SIM BBGP Sul-Sel</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-virtual-tour.png') }}"
                                alt="service-image">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Tur Virtual</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-visualisasi-data.png') }}"
                                alt="service-image">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Visualisasi Data</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->


            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->

    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">BBGP Sul-Sel</h2>
                    <h3 class="section-sub-title">Berita Terkini</h3>
                </div>
            </div>
            <!--/ Title row end -->
            @php
                use Illuminate\Support\Str;
            @endphp
            <div class="row my-posts-slider">
                @foreach ($datas['berita'] as $v)
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="ts-service-box">
                            <div class="ts-service-image-wrapper">
                                <img loading="lazy" class="w-100" src="{{ asset('upload/berita/' . $v->thumbnail) }}"
                                    alt="service-image">
                            </div>
                            <div class="d-flex">
                                <div class="ts-service-info">
                                    <h3 class="service-box-title"><a href="#">{{ $v->judul }}</a>
                                    </h3>
                                    <p>
                                        {{ Str::limit(strip_tags($v->isi), 120, '...') }}
                                        {{-- {!! Str::limit($v->isi, 150, '...') !!} --}}
                                    </p>
                                    <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                            class="fa fa-caret-right"></i> Detail...</a>
                                </div>
                            </div>
                        </div><!-- Service1 end -->
                    </div><!-- Col 1 end -->
                @endforeach



            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->


    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">BBGP Sul-Sel</h2>
                    <h3 class="section-sub-title">Artikel Terkini</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row my-artikel-slider">
                @foreach ($datas['artikel'] as $v)
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="ts-service-box">
                            <div class="ts-service-image-wrapper">
                                <img loading="lazy" class="w-100"
                                    src="{{ asset('upload/artikel/' . $v->thumbnail) }}" alt="service-image">
                            </div>
                            <div class="d-flex">
                                <div class="ts-service-info">
                                    <h3 class="service-box-title"><a href="#">{{ $v->judul }}</a>
                                    </h3>
                                    <p>
                                        {{ Str::limit(strip_tags($v->isi), 120, '...') }}
                                    </p>
                                    <a class="learn-more d-inline-block" href="#"
                                        aria-label="service-details"><i class="fa fa-caret-right"></i> Learn more</a>
                                </div>
                            </div>
                        </div><!-- Service1 end -->
                    </div><!-- Col 1 end -->
                @endforeach


            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->



    <section id="news" class="news">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">BBGP Sul-Sel</h2>
                    <h3 class="section-sub-title">Agenda Terkini</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row my-posts-slider">
                @foreach ($datas['agenda'] as $v)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="#" class="latest-post-img">
                                    <img loading="lazy" class="img-fluid"
                                        src="{{ asset('upload/agenda/' . $v->thumbnail) }}" alt="img">
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="#" class="d-inline-block">{{ $v->nama_kegiatan }}</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <?php
                                        setlocale(LC_ALL, 'IND');
                                        
                                        $tgl_kegiatan = strftime('%d %B %Y', strtotime($v->tgl_kegiatan));
                                        ?>
                                        <i class="fa fa-clock-o"></i> {{ $tgl_kegiatan }}
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 1st post col end -->
                @endforeach


            </div>
            <!--/ Content row end -->

            {{-- <div class="general-btn text-center mt-4">
                <a class="btn btn-primary" href="news-left-sidebar.html">See All Posts</a>
            </div> --}}

        </div>
        <!--/ Container end -->
    </section>
    <!--/ News end -->
@endsection

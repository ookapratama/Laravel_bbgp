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
            style="background-image:url({{ asset('landing/images/slider-main/slide3.png') }})">
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

            <div class="row my-icon-slider">

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid"
                                src="{{ asset('landing/images/icon-slider/logo-nogratifikasi.png') }}" alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid"
                                src="{{ asset('landing/images/icon-slider/logo-berakhlak.png') }}" alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid"
                                src="{{ asset('landing/images/icon-slider/logo-bangga-melayani.png') }}"
                                alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid"
                                src="{{ asset('landing/images/icon-slider/sehat-tanpa-korupsi.png') }}"
                                alt="service-image">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid"
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
                        <p>BBGP Provinsi Sulawesi Selatan adalah Unit Pelaksana Teknis Direktorat Jenderal Guru dan Tenaga
                            Kependidikan Kemendikbudristek dalam Bidang Pengembangan dan Pemberdayaan Guru, Pendidik
                            lainnya, Tenaga Kependidikan, Calon Kepala Sekolah, Kepala Sekolah, Calon Pengawas Sekolah, dan
                            Pengawas Sekolah di Provinsi Sulawesi Selatan.</p>
                    </div><!-- Intro box end -->

                    <div class="gap-20"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="ts-service-box">
                                <span class="ts-service-icon">
                                    <i class="fas fa-trophy"></i>
                                </span>
                                <div class="ts-service-box-content">
                                    <h3 class="service-box-title">We've Repution for Excellence</h3>
                                </div>
                            </div><!-- Service 1 end -->
                        </div><!-- col end -->

                        <div class="col-md-6">
                            <div class="ts-service-box">
                                <span class="ts-service-icon">
                                    <i class="fas fa-sliders-h"></i>
                                </span>
                                <div class="ts-service-box-content">
                                    <h3 class="service-box-title">We Build Partnerships</h3>
                                </div>
                            </div><!-- Service 2 end -->
                        </div><!-- col end -->
                    </div><!-- Content row 1 end -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="ts-service-box">
                                <span class="ts-service-icon">
                                    <i class="fas fa-thumbs-up"></i>
                                </span>
                                <div class="ts-service-box-content">
                                    <h3 class="service-box-title">Guided by Commitment</h3>
                                </div>
                            </div><!-- Service 1 end -->
                        </div><!-- col end -->

                        <div class="col-md-6">
                            <div class="ts-service-box">
                                <span class="ts-service-icon">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="ts-service-box-content">
                                    <h3 class="service-box-title">A Team of Professionals</h3>
                                </div>
                            </div><!-- Service 2 end -->
                        </div><!-- col end -->
                    </div><!-- Content row 1 end -->
                </div><!-- Col end -->

                <div class="col-lg-6 mt-4 mt-lg-0">
                    <h3 class="into-sub-title">Galeri </h3>
                    <div id="page-slider" class="page-slider small-bg">
                        <div class="item">
                            <img loading="lazy" class="img-fluid"
                                src="{{ asset('landing/images/projects/project5.jpg') }}" alt="project-image" />
                        </div>

                        <div class="item">
                            <img loading="lazy" class="img-fluid"
                                src="{{ asset('landing/images/projects/project4.jpg') }}" alt="project-image" />
                        </div>
                    </div><!-- Page slider end -->
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
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>

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
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>

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
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>

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
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>

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
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>

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
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>

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

            <div class="row my-posts-slider">

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service1.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="service-single.html"
                                    aria-label="service-details"><i class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service2.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Virtual Construction</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service2 end -->
                </div><!-- Col 2 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service3.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Build To Last</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service3 end -->
                </div><!-- Col 3 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service4.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">EXTERIOR DESIGN</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 4 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service5.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">RENOVATION</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service2 end -->
                </div><!-- Col 5 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service6.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">SAFETY MANAGEMENT</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service3 end -->
                </div><!-- Col 6 end -->

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

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service1.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Zero Harm Everyday</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="service-single.html"
                                    aria-label="service-details"><i class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service2.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Virtual Construction</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service2 end -->
                </div><!-- Col 2 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service3.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Build To Last</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service3 end -->
                </div><!-- Col 3 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service4.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">EXTERIOR DESIGN</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 4 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service5.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">RENOVATION</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service2 end -->
                </div><!-- Col 5 end -->

                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100" src="{{ asset('landing/images/services/service6.jpg') }}"
                                alt="service-image">
                        </div>
                        <div class="d-flex">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">SAFETY MANAGEMENT</a></h3>
                                <p>You have ideas, goals, and dreams. We have a culturally diverse, forward thinking team
                                    looking for talent like. Lorem ipsum dolor suscipit.</p>
                                <a class="learn-more d-inline-block" href="#" aria-label="service-details"><i
                                        class="fa fa-caret-right"></i> Learn more</a>
                            </div>
                        </div>
                    </div><!-- Service3 end -->
                </div><!-- Col 6 end -->

            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->

    {{-- <section id="project-area" class="project-area solid-bg">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="section-title">BBGP Sul-Sel</h2>
                    <h3 class="section-sub-title">Galeri </h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                <div class="col-12">
                    <div class="shuffle-btn-group">
                        <label class="active" for="all">
                            <input type="radio" name="shuffle-filter" id="all" value="all"
                                checked="checked">Show All
                        </label>
                        <label for="commercial">
                            <input type="radio" name="shuffle-filter" id="commercial" value="commercial">Commercial
                        </label>
                        <label for="education">
                            <input type="radio" name="shuffle-filter" id="education" value="education">Education
                        </label>
                        <label for="government">
                            <input type="radio" name="shuffle-filter" id="government" value="government">Government
                        </label>
                        <label for="infrastructure">
                            <input type="radio" name="shuffle-filter" id="infrastructure"
                                value="infrastructure">Infrastructure
                        </label>
                        <label for="residential">
                            <input type="radio" name="shuffle-filter" id="residential" value="residential">Residential
                        </label>
                        <label for="healthcare">
                            <input type="radio" name="shuffle-filter" id="healthcare" value="healthcare">Healthcare
                        </label>
                    </div><!-- project filter end -->


                    <div class="row shuffle-wrapper">
                        <div class="col-1 shuffle-sizer"></div>

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;government&quot;,&quot;healthcare&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="images/projects/project1.jpg" aria-label="project-img">
                                    <img class="img-fluid" src="images/projects/project1.jpg" alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="projects-single.html">Capital Teltway Building</a>
                                        </h3>
                                        <p class="project-cat">Commercial, Interiors</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 1 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;healthcare&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="images/projects/project2.jpg" aria-label="project-img">
                                    <img class="img-fluid" src="images/projects/project2.jpg" alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="projects-single.html">Ghum Touch Hospital</a>
                                        </h3>
                                        <p class="project-cat">Healthcare</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 2 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;infrastructure&quot;,&quot;commercial&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="images/projects/project3.jpg" aria-label="project-img">
                                    <img class="img-fluid" src="images/projects/project3.jpg" alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="projects-single.html">TNT East Facility</a>
                                        </h3>
                                        <p class="project-cat">Government</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 3 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;education&quot;,&quot;infrastructure&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="images/projects/project4.jpg" aria-label="project-img">
                                    <img class="img-fluid" src="images/projects/project4.jpg" alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="projects-single.html">Narriot Headquarters</a>
                                        </h3>
                                        <p class="project-cat">Infrastructure</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 4 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item"
                            data-groups="[&quot;infrastructure&quot;,&quot;education&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="images/projects/project5.jpg" aria-label="project-img">
                                    <img class="img-fluid" src="images/projects/project5.jpg" alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="projects-single.html">Kalas Metrorail</a>
                                        </h3>
                                        <p class="project-cat">Infrastructure</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 5 end -->

                        <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;residential&quot;]">
                            <div class="project-img-container">
                                <a class="gallery-popup" href="images/projects/project6.jpg" aria-label="project-img">
                                    <img class="img-fluid" src="images/projects/project6.jpg" alt="project-img">
                                    <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                </a>
                                <div class="project-item-info">
                                    <div class="project-item-info-content">
                                        <h3 class="project-item-title">
                                            <a href="projects-single.html">Ancraft Avenue House</a>
                                        </h3>
                                        <p class="project-cat">Residential</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- shuffle item 6 end -->
                    </div><!-- shuffle end -->
                </div>

                <div class="col-12">
                    <div class="general-btn text-center">
                        <a class="btn btn-primary" href="projects.html">View All Projects</a>
                    </div>
                </div>

            </div><!-- Content row end -->
        </div>
        <!--/ Container end -->
    </section><!-- Project area end --> --}}


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

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="latest-post">
                        <div class="latest-post-media">
                            <a href="news-single.html" class="latest-post-img">
                                <img loading="lazy" class="img-fluid" src="{{ asset('landing/images/news/news1.jpg') }}"
                                    alt="img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4 class="post-title">
                                <a href="news-single.html" class="d-inline-block">We Just Completes $17.6 million
                                    Medical Clinic in Mid-Missouri</a>
                            </h4>
                            <div class="latest-post-meta">
                                <span class="post-item-date">
                                    <i class="fa fa-clock-o"></i> July 20, 2017
                                </span>
                            </div>
                        </div>
                    </div><!-- Latest post end -->
                </div><!-- 1st post col end -->

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="latest-post">
                        <div class="latest-post-media">
                            <a href="news-single.html" class="latest-post-img">
                                <img loading="lazy" class="img-fluid" src="{{ asset('landing/images/news/news2.jpg') }}"
                                    alt="img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4 class="post-title">
                                <a href="news-single.html" class="d-inline-block">Thandler Airport Water
                                    Reclamation Facility Expansion Project Named</a>
                            </h4>
                            <div class="latest-post-meta">
                                <span class="post-item-date">
                                    <i class="fa fa-clock-o"></i> June 17, 2017
                                </span>
                            </div>
                        </div>
                    </div><!-- Latest post end -->
                </div><!-- 2nd post col end -->

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="latest-post">
                        <div class="latest-post-media">
                            <a href="news-single.html" class="latest-post-img">
                                <img loading="lazy" class="img-fluid" src="{{ asset('landing/images/news/news3.jpg') }}"
                                    alt="img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4 class="post-title">
                                <a href="news-single.html" class="d-inline-block">Silicon Bench and Cornike Begin
                                    Construction Solar Facilities</a>
                            </h4>
                            <div class="latest-post-meta">
                                <span class="post-item-date">
                                    <i class="fa fa-clock-o"></i> Aug 13, 2017
                                </span>
                            </div>
                        </div>
                    </div><!-- Latest post end -->
                </div><!-- 3rd post col end -->

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="latest-post">
                        <div class="latest-post-media">
                            <a href="news-single.html" class="latest-post-img">
                                <img loading="lazy" class="img-fluid" src="{{ asset('landing/images/news/news3.jpg') }}"
                                    alt="img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4 class="post-title">
                                <a href="news-single.html" class="d-inline-block">Silicon Bench and Cornike Begin
                                    Construction Solar Facilities</a>
                            </h4>
                            <div class="latest-post-meta">
                                <span class="post-item-date">
                                    <i class="fa fa-clock-o"></i> Aug 13, 2017
                                </span>
                            </div>
                        </div>
                    </div><!-- Latest post end -->
                </div><!-- 3rd post col end -->

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="latest-post">
                        <div class="latest-post-media">
                            <a href="news-single.html" class="latest-post-img">
                                <img loading="lazy" class="img-fluid" src="{{ asset('landing/images/news/news3.jpg') }}"
                                    alt="img">
                            </a>
                        </div>
                        <div class="post-body">
                            <h4 class="post-title">
                                <a href="news-single.html" class="d-inline-block">Silicon Bench and Cornike Begin
                                    Construction Solar Facilities</a>
                            </h4>
                            <div class="latest-post-meta">
                                <span class="post-item-date">
                                    <i class="fa fa-clock-o"></i> Aug 13, 2017
                                </span>
                            </div>
                        </div>
                    </div><!-- Latest post end -->
                </div><!-- 3rd post col end -->

            </div>
            <!--/ Content row end -->

            <div class="general-btn text-center mt-4">
                <a class="btn btn-primary" href="news-left-sidebar.html">See All Posts</a>
            </div>

        </div>
        <!--/ Container end -->
    </section>
    <!--/ News end -->
@endsection

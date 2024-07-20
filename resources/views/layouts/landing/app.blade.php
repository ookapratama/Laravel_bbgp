<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<!--
THEME: Constra - Construction Html5 Template
VERSION: 1.0.0
AUTHOR: Themefisher

HOMEPAGE: https://themefisher.com/products/constra-construction-template/
DEMO: https://demo.themefisher.com/constra/
GITHUB: https://github.com/themefisher/Constra-Bootstrap-Construction-Template

WEBSITE: https://themefisher.com
TWITTER: https://twitter.com/themefisher
FACEBOOK: https://www.facebook.com/themefisher
-->

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
================================================== -->
    <meta charset="utf-8">
    <title>BBGP Provinsi Sulawesi Selatan - Rumah Belajar Insan Pendidikan</title>

    <!-- Mobile Specific Metas
================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name=author content="Themefisher">
    <meta name=generator content="Themefisher Constra HTML Template v1.0">

    <!-- Favicon
================================================== -->
    <link rel="icon" type="image/png" href="{{ asset('landing/images/fav.png') }}">

    <!-- CSS
================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/animate-css/animate.css') }}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/plugins/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/colorbox/colorbox.css') }}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('styles')

</head>

<body>
    <div class="body-inner">

        @include('layouts.landing.header')
        @include('layouts.landing.topbar')

        @yield('content')

        @include('layouts.landing.footer')


        <!-- Javascript Files
  ================================================== -->

        <!-- initialize jQuery Library -->
        <script src="{{ asset('landing/plugins/jQuery/jquery.min.js') }}"></script>
        <!-- Bootstrap jQuery -->
        <script src="{{ asset('landing/plugins/bootstrap/bootstrap.min.js') }}" defer></script>
        <!-- Slick Carousel -->
        <script src="{{ asset('landing/plugins/slick/slick.min.js') }}"></script>
        <script src="{{ asset('landing/plugins/slick/slick-animation.min.js') }}"></script>
        <!-- Color box -->
        <script src="{{ asset('landing/plugins/colorbox/jquery.colorbox.js') }}"></script>
        <!-- shuffle -->
        <script src="{{ asset('landing/plugins/shuffle/shuffle.min.js') }}" defer></script>



        <!-- Template custom -->
        <script src="{{ asset('landing/js/script.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        @stack('scripts')

        @if (session('message') == 'store')
            <script>
                // iziToast.success({
                //     title: 'Sukses',
                //     message: 'Berhasil tambah data',
                //     position: 'topRight'
                // });
                Swal.fire("Berhasil", "Berhasil tambah data", "success");
            </script>
        @endif

        {{-- success update data --}}
        @if (session('message') == 'update')
            <script>
                // iziToast.success({
                //     title: 'Sukses',
                //     message: 'Berhasil update data',
                //     position: 'topRight'
                // });
                Swal.fire("Berhasil", "Berhasil update data", "success");
            </script>
        @endif

        {{-- success login --}}
        @if (session('message') == 'sukses login')
            <script>
                Swal.fire("Berhasil", "Berhasil Login", "success");
            </script>
        @endif


        @if (session('message') == 'error golongan')
            <script>
                Swal.fire("Warning", "Golongan tidak valid", "error");
            </script>
        @endif

        {{-- validasi barang keluar --}}
        @if (session('message') == 'stok error')
            <script>
                Swal.fire("Warning", "Jumlah yang anda masukkan tidak valid dengan Stok barang", "error");
            </script>
        @endif

        {{-- failed login --}}
        @if (session('message') == 'gagal login')
            <script>
                Swal.fire("Warning", "Periksa kembali username dan password anda", "error");
            </script>
        @endif

        {{--  login dulu --}}
        @if (session('message') == 'need login')
            <script>
                Swal.fire("Warning", "Anda harus login terlebih dahulu", "error");
            </script>
        @endif


        {{--  succces logout --}}
        @if (session('message') == 'sukses logout')
            <script>
                Swal.fire("Berhasil", "Anda Telah Logout", "success");
            </script>
        @endif

        {{--  validasi pegawai dan guru --}}
        @if (session('message') == 'data kosong')
            <script>
                Swal.fire("Warning", "Data anda tidak terdaftar, Silahkan mengisi biodata di bawah", "error");
            </script>
        @endif
        @if (session('message') == 'data ada')
            <script>
                Swal.fire("Berhasil", "Data anda terdaftar", "success");
            </script>
        @endif
        @if (session('message') == 'form kosong')
            <script>
                Swal.fire("Error", "Silahkan mengisi form inputan KTP", "error");
            </script>
        @endif

        @if (session('message') == 'user daftar')
            <script>
                Swal.fire("Berhasil", "Berhasil registrasi, data akan di verifikasi terlebih dahulu", "success");
            </script>
        @endif

        @if (session('message') == 'sukses daftar')
            <script>
                Swal.fire("Berhasil", "Berhasil registrasi Kegiatan", "success");
            </script>
        @endif

    </div><!-- Body inner end -->
</body>

</html>

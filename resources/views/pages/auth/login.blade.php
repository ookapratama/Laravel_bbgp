@extends('layouts.auth', ['title' => 'Login'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
    @endpush

    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login_action') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="username" class="form-control" name="username" tabindex="1" required
                        autofocus>
                    <div class="invalid-feedback">
                        Please fill in your username
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        {{-- <div class="float-right">
                            <a href="#" class="text-small">
                                Forgot Password?
                            </a>
                        </div> --}}
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        please fill in your password
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Login Sebagai</label>
                    </div>
                    <select class="form-control" name="role" id="">
                        <option value="">-- Pilih Role --</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="guru">Guru</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>


        </div>
    </div>
    {{-- <div class="mt-5 text-muted text-center">
        Don't have an account? <a href="#">Create One</a>
    </div> --}}
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>


    @push('scripts')
    @endpush

    {{-- success login --}}
    @if (session('message') == 'sukses login')
        <script>
            swal("Berhasil", "Berhasil Login", "success");
        </script>
    @endif


    {{-- failed login --}}
    @if (session('message') == 'gagal login')
        <script>
            swal("Warning", "Periksa kembali username dan password anda", "error");
        </script>
    @endif
    {{--  login dulu --}}
    @if (session('message') == 'need login')
        <script>
            swal("Warning", "Anda harus login terlebih dahulu", "error");
        </script>
    @endif

    {{--  succces logout --}}
    @if (session('message') == 'sukses logout')
        <script>
            swal("Berhasil", "Anda Telah Logout", "success");
        </script>
    @endif
@endsection

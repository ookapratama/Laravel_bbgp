@extends('layouts.app', ['title' => 'Edit Akun'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Akun</h1>
                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Form</div>
                </div> --}}
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <form action="{{ route('akun.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" name="{{ $datas->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input name="no_ktp" required placeholder="Masukkan Nomor KTP"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input name="name" required placeholder="Masukkan Nama Akun"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input name="username" required placeholder="Masukkan Usernam untuk login"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input name="password" required placeholder="Masukkan Password"
                                                    type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="role" required placeholder="Masukkan Akun"
                                                    class="form-control">
                                                    <option value="">-- Pilih Role Akun --</option>
                                                    <option value="admin">admin</option>
                                                    <option value="kepala">kepala</option>
                                                    <option value="superadmin">superadmin</option>
                                                    <option value="tenaga pendidik">tenaga pendidik</option>
                                                    <option value="tenaga kependidikan">tenaga kependidikan</option>
                                                    <option value="stakeholder">stakeholder</option>
                                                    <option value="pegawai">pegawai</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">

                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-plus"></i>
                                                Update Data Akun
                                            </button>
                                        </div>
                                    </div>
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
    @endpush
@endsection

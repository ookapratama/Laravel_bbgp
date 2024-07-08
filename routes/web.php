<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//  User
Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers\User'],
    function () {
        Route::redirect('/', '/');
        // Dashboard
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/kontak', 'UserController@kontak')->name('user.kontak');
        Route::get('/eksternal', 'UserController@guru')->name('user.guru');


        Route::get('/pegawai', 'UserController@pegawai')->name('user.pegawai');
        Route::get('/pegawai/form', 'UserController@form_pegawai')->name('user.form_pegawai');
        Route::post('/pegawai/daftar', 'UserController@daftar_pegawai')->name('user.daftar_pegawai');

        Route::get('/eksternal', 'UserController@guru')->name('user.guru');
        Route::get('/eksternal/form/{jenis}', 'UserController@form_guru')->name('user.form_guru');
        Route::post('/eksternal/daftar', 'UserController@daftar_guru')->name('user.daftar_guru');

        Route::get('/kegiatan', 'KegiatanController@index')->name('user.kegiatan');
        Route::get('/kegiatan/cari', 'KegiatanController@cari')->name('user.cari');

        Route::get('/kegiatan/registrasi', 'KegiatanController@regist')->name('user.kegiatan_regist');
        Route::post('/kegiatan/store', 'KegiatanController@store')->name('user.kegiatan_store');

        // response jsonj
        Route::get('/kegiatan/getStatus', 'KegiatanController@getStatus')->name('user.kegiatan.getStatus');
        Route::get('/kegiatan/cariPeserta', 'KegiatanController@cariPeserta')->name('user.kegiatan.cariPeserta');
        Route::get('/kegiatan/peserta', 'KegiatanController@getPesertaByKegiatan')->name('user.kegiatan.peserta');
        Route::get('/peserta/detail', 'KegiatanController@getPesertaDetail')->name('user.peserta.detail');

        Route::get('/print/absensi-peserta', 'KegiatanController@printAbsensiPeserta')->name('print.absensi.peserta');
        Route::get('/print/registrasi-peserta', 'KegiatanController@printRegistrasiPeserta')->name('print.registrasi.peserta');
        Route::get('/print/absensi-panitia', 'KegiatanController@printAbsensiPanitia')->name('print.absensi.panitia');
        Route::get('/print/absensi-narasumber', 'KegiatanController@printAbsensiNarasumber')->name('print.absensi.narasumber');



    }
);

//  Admin
Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers', 'middleware' => 'ValidasiUser'],
    function () {
        Route::redirect('/admin', 'dashboard/');
        // Dashboard
        Route::prefix('dashboard')->group(function () {

            // Root
            Route::get('/', 'AdminController@index')->name('dashboard');
            Route::get('/jadwalKegiatan', 'AdminController@jadwal')->name('dashboard.jadwal');

            // Profile User yang Login
            Route::get('/profile/{id}', 'AdminController@profile')->name('profile.index');
            Route::put('/profile/update', 'AdminController@profile_update')->name('profile.update');

            Route::get('/fetch-sekolah', ['GuruController@index', 'fetchSekolah'])->name('fetchSekolah');


            // Guru / Eksternal
            Route::prefix('eksternal')->group(function () {
                Route::get('/', 'GuruController@index')->name('guru.index');
                Route::get('/create', 'GuruController@create')->name('guru.create');
                Route::post('/store', 'GuruController@store')->name('guru.store');
                Route::post('/verifikasi/{id}', 'GuruController@verifikasi')->name('guru.verifikasi');
                Route::get('/edit/{id}', 'GuruController@edit')->name('guru.edit');
                Route::put('/update', 'GuruController@update')->name('guru.update');
                Route::post('/hapus/{id}', 'GuruController@destroy')->name('guru.hapus');


                Route::get('/export', 'GuruController@export')->name('guru.export');
                Route::get('/export/{id}', 'GuruController@exportByUser')->name('guru.export.user');

                // untuk login ekternal by user
                Route::get('/show/{id}', 'GuruController@show')->name('guru.show');
                Route::get('/editByUser/{id}', 'GuruController@editByUser')->name('guru.edit.user');
                Route::put('/updateByUser', 'GuruController@updateByUser')->name('guru.update.user');
            });

            // Pegawai
            Route::prefix('pegawai')->group(function () {
                Route::get('/', 'PegawaiController@index')->name('pegawai.index');
                Route::get('/create', 'PegawaiController@create')->name('pegawai.create');
                Route::post('/store', 'PegawaiController@store')->name('pegawai.store');
                Route::post('/verifikasi/{id}', 'PegawaiController@verifikasi')->name('pegawai.verifikasi');
                Route::get('/edit/{id}', 'PegawaiController@edit')->name('pegawai.edit');
                Route::put('/update', 'PegawaiController@update')->name('pegawai.update');
                Route::post('/hapus/{id}', 'PegawaiController@destroy')->name('pegawai.hapus');

                // untuk login pegawai by user
                Route::get('/{id}', 'PegawaiController@show')->name('pegawai.show');
                Route::post('/lokakarya', 'InternalController@storeLokakaryaPegawai')->name('pegawai.lokakarya');

                Route::get('/editUser/{id}', 'PegawaiController@editUser')->name('pegawai.edit.user');
                Route::put('/updateUser', 'PegawaiController@updateUser')->name('pegawai.update.user');

                Route::get('/penugasan/{id}', 'PegawaiController@editPenugasan')->name('pegawai.editPenugasan');
                Route::get('/pendamping/{id}', 'PegawaiController@editPendamping')->name('pegawai.editPendamping');


            });

            // Kepegawaian
            Route::prefix('kepegawaian')->group(function () {
                Route::get('/', 'KepegawaianController@index')->name('kepegawaian.index');
                Route::get('/create', 'KepegawaianController@create')->name('kepegawaian.create');
                Route::post('/store', 'KepegawaianController@store')->name('kepegawaian.store');
                Route::get('/edit/{id}', 'KepegawaianController@edit')->name('kepegawaian.edit');
                Route::put('/update', 'KepegawaianController@update')->name('kepegawaian.update');
                Route::post('/hapus/{id}', 'KepegawaianController@destroy')->name('kepegawaian.hapus');
            });

            // Kepegawaian
            Route::prefix('kependidikan')->group(function () {
                Route::get('/', 'KependidikanController@index')->name('kependidikan.index');
                Route::get('/create', 'KependidikanController@create')->name('kependidikan.create');
                Route::post('/store', 'KependidikanController@store')->name('kependidikan.store');
                Route::get('/edit/{id}', 'KependidikanController@edit')->name('kependidikan.edit');
                Route::put('/update', 'KependidikanController@update')->name('kependidikan.update');
                Route::post('/hapus/{id}', 'KependidikanController@destroy')->name('kependidikan.hapus');
            });

            // Internal
            Route::prefix('internal')->group(function () {
                Route::get('/', 'InternalController@index')->name('internal.index');

                // untuk tampil berdasar dari id pegawai
                Route::get('/{id_pegawai}', 'InternalController@show')->name('internal.show');

                Route::get('/tabel/{jenis}', 'InternalController@get_tabel')->name('internal.tabel');
                // Route::get('/tabel/ppnpn', 'InternalController@get_tabel')->name('internal.tabel.ppnpn');
                // Route::get('/tabel/lokakarya', 'InternalController@get_tabel')->name('internal.tabel.lokakarya');
                Route::post('/verifikasi/{id}', 'InternalController@verifikasi')->name('internal.verifikasi');

                // Khusus Loka karya
                Route::get('/indexLokakarya/{nik}', 'InternalController@indexLokakarya')->name('internal.index.lokakarya');
                Route::get('/createLokakarya/{id}', 'InternalController@createLokakarya')->name('internal.create.lokakarya');
                Route::post('/storeLokakarya', 'InternalController@storeLokakarya')->name('internal.store.lokakarya');
                Route::get('/editLokakarya/{id}', 'InternalController@editLokakarya')->name('internal.edit.lokakarya');
                Route::post('/updateLokakarya', 'InternalController@updateLokakarya')->name('internal.update.lokakarya');
                Route::get('/jadwalLokakarya/{id}', 'InternalController@jadwalLokakarya')->name('internal.jadwal.lokakarya');
                Route::post('/cariLokakarya', 'InternalController@cariLokakarya')->name('internal.cari.lokakarya');

                // Penugasan PEgawai BBGP
                Route::get('/indexPegawai/{nik}', 'InternalController@indexPegawai')->name('internal.index.pegawai');
                Route::get('/createPegawai/{id}', 'InternalController@createPegawai')->name('internal.create.pegawai');
                Route::post('/storePegawai', 'InternalController@storePegawai')->name('internal.store.pegawai');
                Route::get('/editPegawai/{id}', 'InternalController@editPegawai')->name('internal.edit.pegawai');
                Route::post('/updatePegawai', 'InternalController@updatePegawai')->name('internal.update.pegawai');


                // Penugasan PPNPN
                Route::get('/indexPpnpn/{nik}', 'InternalController@indexPpnpn')->name('internal.index.ppnpn');
                Route::get('/createPpnp/{id}', 'InternalController@createPpnpn')->name('internal.create.ppnpn');
                Route::post('/storePpnp', 'InternalController@storePpnpn')->name('internal.store.ppnpn');
                Route::get('/editPpnp/{id}', 'InternalController@editPpnpn')->name('internal.edit.ppnpn');
                Route::post('/updatePpnp', 'InternalController@updatePpnpn')->name('internal.update.ppnpn');
                Route::post('/hapusPpnpn/{id}', 'InternalController@hapusPpnpn')->name('internal.hapus.ppnpn');


                Route::post('/store', 'InternalController@store')->name('internal.store');
                Route::get('/edit/{id}', 'InternalController@edit')->name('internal.edit');
                Route::put('/update', 'InternalController@update')->name('internal.update');
                Route::post('/hapus/{id}', 'InternalController@destroy')->name('internal.hapus');

                Route::put('/updatePegawai', 'InternalController@updatePegawai')->name('internal.update.pegawai');
            });

            // Pendamping
            Route::prefix('pendamping')->group(function () {
                Route::get('/', 'PendampingController@index')->name('pendamping.index');

                Route::get('/tabel', 'PendampingController@tabel')->name('pendamping.tabel');
                Route::get('/create', 'PendampingController@create')->name('pendamping.create');
                Route::post('/store', 'PendampingController@store')->name('pendamping.store');
                Route::get('/edit/{id}', 'PendampingController@edit')->name('pendamping.edit');
                Route::put('/update', 'PendampingController@update')->name('pendamping.update');
                Route::post('/hapus/{id}', 'PendampingController@destroy')->name('pendamping.hapus');


                Route::put('/updatePendamping', 'PendampingController@updatePendamping')->name('pendamping.update.user');
            });


            // Akun
            Route::prefix('akun')->group(function () {
                Route::get('/', 'AkunController@index')->name('akun.index');
                Route::get('/create', 'AkunController@create')->name('akun.create');
                Route::post('/store', 'AkunController@store')->name('akun.store');
                Route::post('/regis', 'AkunController@regis')->name('akun.regis');
                Route::get('/edit/{id}', 'AkunController@edit')->name('akun.edit');
                Route::put('/update', 'AkunController@update')->name('akun.update');
                Route::post('/hapus/{id}', 'AkunController@destroy')->name('akun.hapus');
            });


            // Kegiatan
            Route::prefix('kegiatan')->group(function () {
                Route::get('/', 'KegiatanController@index')->name('kegiatan.index');
                Route::get('/create', 'KegiatanController@create')->name('kegiatan.create');
                Route::post('/store', 'KegiatanController@store')->name('kegiatan.store');
                Route::get('/edit/{id}', 'KegiatanController@edit')->name('kegiatan.edit');
                Route::put('/update', 'KegiatanController@update')->name('kegiatan.update');
                Route::post('/hapus/{id}', 'KegiatanController@destroy')->name('kegiatan.hapus');
            });

            // Honor
            Route::prefix('honor')->group(function () {
                Route::get('/', 'HonorController@index')->name('honor.index');
                Route::get('/create', 'HonorController@create')->name('honor.create');
                Route::post('/store', 'HonorController@store')->name('honor.store');
                Route::get('/edit/{id}', 'HonorController@edit')->name('honor.edit');
                Route::put('/update', 'HonorController@update')->name('honor.update');
                Route::post('/hapus/{id}', 'HonorController@destroy')->name('honor.hapus');
                Route::get('/cetak/{jabatan}', 'HonorController@cetak')->name('honor.cetak');
            });


            //kuitansi
            Route::prefix('kuitansi')->group(function () {
                Route::get('/', 'KuitansiController@index')->name('kuitansi.index');
                Route::get('/create', 'KuitansiController@create')->name('kuitansi.create');
                Route::post('/store', 'KuitansiController@store')->name('kuitansi.store');
                Route::get('/edit/{id}', 'KuitansiController@edit')->name('kuitansi.edit');
                Route::put('/update', 'KuitansiController@update')->name('kuitansi.update');
                Route::post('/hapus/{id}', 'KuitansiController@destroy')->name('kuitansi.hapus');
            });




        });
    }
);




// Auth
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'AuthController@login')->name('login');
    // Route::get('/reset', 'AuthController@reset')->name('reset');
    // Route::get('/reset_password', 'AuthController@reset_password')->name('reset.password');
    Route::post('/login', 'AuthController@login_action')->name('login_action');
    Route::get('/logout', function () {
        Session::flush();
        return redirect()->route('user.index')->with('message', 'sukses logout');
    })->name('logout');
});

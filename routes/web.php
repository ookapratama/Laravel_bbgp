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

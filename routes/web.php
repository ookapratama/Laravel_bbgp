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


Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers', 'middleware' => 'ValidasiUser'],
    function () {
        Route::redirect('/', 'dashboard/');
        // Dashboard
        Route::prefix('dashboard')->group(function () {

            // Root
            Route::get('/', 'AdminController@index')->name('dashboard');

            // Guru
            Route::prefix('guru')->group(function () {

                Route::get('/', 'GuruController@index')->name('guru.index');
                Route::get('/create', 'GuruController@create')->name('guru.create');
                Route::post('/store', 'GuruController@store')->name('guru.store');
                Route::get('/edit/{id}', 'GuruController@edit')->name('guru.edit');
                Route::put('/update', 'GuruController@update')->name('guru.update');
                Route::post('/hapus/{id}', 'GuruController@destroy')->name('guru.hapus');

            });
        });
    }
);


// Blank
Route::get('blank', function () {
    return view('pages.blank.layout-blank', ['menu' => 'blank']);
})->name('blank');


// Auth
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@login_action')->name('login_action');
    Route::get('/logout', function () {
        Session::flush();
        return redirect()->route('login');
    })->name('logout');
});

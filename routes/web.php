<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', 'TransaksiController@index')->name('home');
Route::get('/', 'TransaksiController@index')->name('home');

Route::resource('metadata', 'MetadataController');
Route::resource('masteracara', 'MasteracaraController');

Route::get('rinciankegiatan/getSubunsurList/{id}','RinciankegiatanController@getSubunsurList');
Route::resource('rinciankegiatan', 'RinciankegiatanController');

Route::get('rincianangkakredit/getSubunsurList','RincianangkakreditController@getSubunsurList');
Route::get('rincianangkakredit/getRinciankegiatanList','RincianangkakreditController@getRinciankegiatanList');
Route::get('rincianangkakredit/getAngkaKredit','RincianangkakreditController@getAngkaKredit');
Route::resource('rincianangkakredit', 'RincianangkakreditController');

Route::resource('transaksi', 'TransaksiController');


Route::get('pegawai', 'PegawaiController@index')->name('pegawai');
Route::get('pegawai/tambah', 'PegawaiController@tambah');
Route::post('pegawai/store', 'PegawaiController@store');
Route::get('pegawai/edit/{id}', 'PegawaiController@edit');
Route::put('pegawai/update/{id}', 'PegawaiController@update');
Route::get('pegawai/hapus/{id}', 'PegawaiController@delete');
Route::get('pegawai/comingsoon', 'PegawaiController@comingsoon');

Route::get('penilai/dashboard', 'PenilaiController@dashboardPenilai');
Route::resource('penilai', 'PenilaiController');


Route::get('admin', function () {
    return view('adminlte');
});



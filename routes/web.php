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

Route::get('/home', 'PenilaiController@dashboardPenilai')->name('home');
Route::get('/', 'PenilaiController@dashboardPenilai');

//Route master data pegawai as login item
Route::get('pegawai', 'PegawaiController@index')->name('pegawai');
Route::get('pegawai/tambah', 'PegawaiController@tambah');
Route::post('pegawai/store', 'PegawaiController@store');
Route::get('pegawai/edit/{id}', 'PegawaiController@edit');
Route::put('pegawai/update/{id}', 'PegawaiController@update');
Route::get('pegawai/hapus/{id}', 'PegawaiController@delete');
Route::get('pegawai/comingsoon', 'PegawaiController@comingsoon');

//Route untuk master data
Route::resource('metadata', 'MetadataController');
Route::resource('masteracara', 'MasteracaraController');

Route::resource('rinciankegiatan', 'RinciankegiatanController');
Route::get('rinciankegiatan/getSubunsurList/{id}','RinciankegiatanController@getSubunsurList');

Route::get('rincianangkakredit/getSubunsurList','RincianangkakreditController@getSubunsurList');
Route::get('rincianangkakredit/getRinciankegiatanList','RincianangkakreditController@getRinciankegiatanList');
Route::get('rincianangkakredit/getAngkaKredit','RincianangkakreditController@getAngkaKredit');
Route::resource('rincianangkakredit', 'RincianangkakreditController');

//Route untuk Transaksi pengisian DUPAK
Route::resource('transaksi', 'TransaksiController');
Route::post('generatedupak','TransaksiController@generateDupak');
Route::get('dupak','TransaksiController@dupak');


//Route untuk Tim Evaluasi penilaian dupak
Route::get('penilai/dashboard', 'PenilaiController@dashboardPenilai');
Route::resource('penilai', 'PenilaiController');


//Route untuk Pengeplot DUPAK di TU
Route::resource('plotpenilai', 'PlotpenilaiController');

// Route::get('plotpenilai/edit2/{id}', 'PlotpenilaiController@edit')->name('plotpenilai.edit2');


//edit yg mana bi?


//Soon be deleted
Route::get('admin', function () {
    return view('adminlte');
});



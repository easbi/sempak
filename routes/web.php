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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

//Route master data pegawai as login item
Route::get('pegawai', 'PegawaiController@index')->name('pegawai');
Route::get('pegawai/tambah', 'PegawaiController@tambah');
Route::post('pegawai/store', 'PegawaiController@store');
Route::get('pegawai/edit/{id}', 'PegawaiController@edit')->name('pegawai.edit');
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
Route::get('rincianangkakredit/edit/{id}', 'RincianangkakreditController@edit')->name('rincianangkakredit.edit');
Route::resource('rincianangkakredit', 'RincianangkakreditController');

//Route untuk Transaksi pengisian DUPAK
Route::resource('transaksi', 'TransaksiController');
Route::get('periode/{y}/{m}', 'TransaksiController@byPeriode');
Route::get('usulan/{y}/{m}/{kk}', 'TransaksiController@byKk');
Route::get('transaksi/{y}/{m}/{kk}', 'TransaksiController@createByKk');
Route::get('/test/{awal}/{akhir}', 'TransaksiController@submit_flag');
Route::post('generatedupak','TransaksiController@generateDupak');
Route::get('dupak','TransaksiController@dupak');
Route::post('/transaksi/getAcara/','TransaksiController@getAcara')->name('transaksi.getAcara');


//Route untuk Tim Evaluasi penilaian dupak
Route::get('penilai/dashboard', 'PenilaiController@dashboardPenilai');
Route::get('penilai/showDokdasar/{id_user}', 'PenilaiController@showDokdasar')->name('penilai.showDokdasar');
Route::resource('penilai', 'PenilaiController');


//Route untuk Pengeplot DUPAK di TU
Route::resource('plotpenilai', 'PlotpenilaiController');

//Route untuk Sekretariat DUPAK
Route::get('sekretariat/bapak', 'SekretariatController@bapak');
Route::get('sekretariat/eksporbapak','SekretariatController@eksporbapak');
Route::get('sekretariat/rekap3', 'SekretariatController@rekap3');
Route::get('sekretariat/rekap2/{id_user}', 'SekretariatController@rekap2');
Route::get('sekretariat/rekap1', 'SekretariatController@rekap1');
Route::resource('sekretariat', 'SekretariatController');

Route::resource('dokdasar', 'DokdasarController');


//Soon be deleted
Route::get('admin', function () {
    return view('adminlte');
});



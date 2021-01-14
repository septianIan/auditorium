<?php

use App\Http\Controllers\Admin\RelRuangFasilitasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
   return redirect()->route('admin.room.index');
});

Route::resource('room','RoomController');
Route::resource('fasilitas', 'AmenitiesController');

Route::resource('kelolaRuang', 'RelRuangFasilitasController')->except('create','show');
Route::get('kelolaRuang/{id}', 'RelRuangFasilitasController@createRuangFasilitas')->name('kelolaRuang.createRuangFasilitas');

Route::get('kelolaRuang/hapusFasilitas/{id}', 'RelRuangFasilitasController@hapusFasilitas')->name('hapusFasilitas.hapus');

/**
 * Mahasiswa
 */
Route::resource('mahasiswa', 'MahasiswaController');
//dataTable
Route::get('data/mahasiswa', 'MahasiswaController@dataTableMahasiswa')->name('data.mahasiswa');

/**
 * Pegawai
 */
Route::resource('masterPegawai', 'PegawaiController');
//dataTable
Route::get('data/masterPegawai', 'PegawaiController@dataTablePegawai')->name('data.masterPegawai');

/**
 * Data auditorium
 */

Route::resource('auditorium', 'RuangFasilitasController')->except('show');

/** 
 * Create peminjaman
 * mahasiswa
 * pegawai
 * umum
*/
Route::get('peminjaman/mahasiswa/{id}', 'RuangFasilitasController@peminjamanMahasiswa')->name('auditorium.peminjamanMahasiswa');
Route::get('peminjaman/pegawai/{id}', 'RuangFasilitasController@peminjamanPagawai')->name('auditorium.peminjamanPegawai');
Route::get('peminjaman/umum/{id}', 'RuangFasilitasController@peminjamanUmum')->name('auditorium.peminjamanUmum');

/**
 * Mahasiswa
 */
Route::resource('peminjaman', 'PeminjamanController');
Route::get('peminjaman/pengembalian/{id}', 'PeminjamanController@pengembalian')->name('peminjaman.pengembalian');
Route::get('data/peminjaman', 'DataTable\DataTablePeminjamanController')->name('data.peminjam');
Route::put('editFasilitas/mahasiswa', 'PeminjamanController@editFasilitas')->name('editFasilitas.mahasiswa');
Route::get('generatePdf/mahasiswa/{id}', 'PeminjamanController@generatePdf')->name('generatePdf.mahasiswa');
Route::get('print/mahasiswa/{id}', 'PeminjamanController@print')->name('print.mahasiswa');


/**
 * Pegawai
 */
Route::resource('pegawai', 'PeminjamanPegawaiController')->except('create');
Route::get('pegawai/pengembalian/{id}', 'PeminjamanPegawaiController@pengembalian')->name('pegawai.pengembalian');
Route::get('data/pegawai', 'DataTable\DataTablePegawaiController')->name('data.peminjamPegawai');
Route::put('editFasilitas/pegawai', 'PeminjamanPegawaiController@editFasilitas')->name('editFasilitas.pegawai');
Route::get('peminjamanPegawai/hapusFasilitas/{id}', 'PeminjamanPegawaiController@deleteFasilitas');
Route::get('generatePdf/mahasiswa/{id}', 'PeminjamanPegawaiController@generatePdf')->name('generatePdf.pegawai');
Route::get('print/pegawai/{id}', 'PeminjamanPegawaiController@print')->name('print.pegawai');

/**
 * Peminjaman umum
 */
Route::resource('umum', 'PeminjamanUmumController');
Route::get('umum/pengembalian/{id}', 'PeminjamanUmumController@pengembalian')->name('umum.pengembalian');
Route::get('data/umum', 'DataTable\DataTableUmumController')->name('data.peminjamUmum');
Route::put('editFasilitas/umum', 'PeminjamanUmumController@editFasilitas')->name('editFasilitas.umum');
Route::get('generatePdf/umum/{id}', 'PeminjamanUmumController@generatePdf')->name('generatePdf.umum');
Route::get('print/umum/{id}', 'PeminjamanUmumController@print')->name('print.umum');


/**
 * PENGEMBALIAN
 */
Route::resource('pengembalian', 'PengembalianController')->only('indexMahasiswa');
Route::get('pengembalian/mahasiswa', 'PengembalianController@indexMahasiswa')->name('pengembalian.mahasiswa');
Route::get('pengembalian/pegawai', 'PengembalianController@indexPegawai')->name('pengembalian.pegawai');
Route::get('pengembalian/umum', 'PengembalianController@indexUmum')->name('pengembalian.umum');

/**
 * get jquery
 */
Route::post('cariNim', 'RuangFasilitasController@cariNim')->name('cariNim.data');
Route::post('cariTglPinjam', 'RuangFasilitasController@cariTglPinjam')->name('cariTglPinjam.data');
Route::post('cariStok', 'RuangFasilitasController@cariStok')->name('cariStok.data');
Route::post('cariNik', 'RuangFasilitasController@cariNik')->name('cariNik.data');

Route::get('peminjaman/hapusFasilitas/{id}', 'PeminjamanController@hapusFasilitas');
Route::get('peminjamanUmum/hapusFasilitas/{id}', 'PeminjamanUmumController@hapusFasilitas');

/**
 * Cek peminjaman
 */
Route::get('laporan', 'Laporan\LaporanController@index')->name('laporan.index');
Route::post('laporan/cekPeminjaman', 'Laporan\LaporanController@cekPeminjaman')->name('laporan.cekPenjaman');
Route::get('cetak/laporan', 'Laporan\LaporanController@print')->name('print');
Route::post('laporan/cekMahasiswa', 'Laporan\LaporanController@cekMahasiswa')->name('laporan.cekMahasiswa');
Route::post('laporan/cekPegawai', 'Laporan\LaporanController@cekPegawai')->name('laporan.cekPegawai');
Route::post('laporan/cekUmum', 'Laporan\LaporanController@cekUmum')->name('laporan.cekUmum');

/**
 * Semua Meninjaman
 */
Route::get('laporan/semuaPeminjaman', 'Laporan\LaporanController@allPeminjaman')->name('laporan.semuaPeminjaman');

/**
 * Calendar
 */
Route::get('calendar', 'kelender\CalendarController@indexAdmin')->name('calendar.index');

/**
 * User Control
 */
Route::resource('user', 'UserController');
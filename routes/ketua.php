<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
   return redirect()->route('ketua.calendar.index');
});

Route::get('laporan/peminjaman', 'LaporanPeminjamanController@index')->name('laporan.index');
Route::post('laporan/cekPeminjaman', 'LaporanPeminjamanController@cekPeminjaman')->name('laporan.cekPeminjaman');
//mahasiswa
Route::get('peminjaman/mahasiswa', 'CekPeminjamanController@indexMahasiswa')->name('peminjaman.mahasiswa');
Route::get('detail/mahasiswa/{id}', 'CekPeminjamanController@detailMahasiswa')->name('detail.mahasiswa');
//pegawai
Route::get('peminjaman/pegawai', 'CekPeminjamanController@indexPegawai')->name('peminjaman.pegawai');
Route::get('detail/pegawai/{id}', 'CekPeminjamanController@detailPegawai')->name('detail.pegawai');
//umum
Route::get('peminjaman/umum', 'CekPeminjamanController@indexUmum')->name('peminjaman.umum');
Route::get('detail/umum/{id}', 'CekPeminjamanController@detailUmum')->name('detail.umum');

/**
 * Calendar
 */
Route::get('calendar', 'Kalender\CalenderController@indexKetua')->name('calendar.index');
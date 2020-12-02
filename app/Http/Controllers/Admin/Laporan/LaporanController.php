<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\PeminjamanUmum;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function cekPeminjaman(Request $request)
    {
        $from = $request->dari;
        $to = $request->sampai;
        $dari = Carbon::parse($from)->format('d, M Y');
        $sampai = Carbon::parse($to)->format('d, M Y');

        $mahasiswa = PeminjamanAuditorium::where('status' ,1)
            ->whereBetween('tglPinjam', [$from, $to])->get();
        $pegawai = PeminjamanAuditoriumPegawai::where('status' ,1)
            ->whereBetween('tglPinjam', [$from, $to])->get();
        $umum = PeminjamanUmum::where('status' ,1)
            ->whereBetween('tglPinjam', [$from, $to])->get();
        return view('laporan.cetakLaporan' ,\compact(
            'mahasiswa', 'pegawai', 'umum', 'dari', 'sampai'
        ));
    }

    public function cekMahasiswa(Request $request)
    {
        $from = $request->dari;
        $to = $request->sampai;
        $dari = Carbon::parse($from)->format('d, M Y');
        $sampai = Carbon::parse($to)->format('d, M Y');

        $mahasiswa = PeminjamanAuditorium::where('status' ,1)
            ->whereBetween('tglPinjam', [$from, $to])->get();
        return view('laporan.cetakLaporanMahasiswa' ,\compact('mahasiswa', 'dari', 'sampai'));
    }

    public function cekPegawai(Request $request)
    {
        $from = $request->dari;
        $to = $request->sampai;
        $dari = Carbon::parse($from)->format('d, M Y');
        $sampai = Carbon::parse($to)->format('d, M Y');

        $pegawai = PeminjamanAuditoriumPegawai::where('status' ,1)
            ->whereBetween('tglPinjam', [$from, $to])->get();
        return view('laporan.cetakLaporanPegawai' ,\compact('pegawai', 'dari', 'sampai'));
    }

    public function cekUmum(Request $request)
    {
        $from = $request->dari;
        $to = $request->sampai;
        $dari = Carbon::parse($from)->format('d, M Y');
        $sampai = Carbon::parse($to)->format('d, M Y');

        $umum = PeminjamanUmum::where('status' ,1)
            ->whereBetween('tglPinjam', [$from, $to])->get();
        return view('laporan.cetakLaporanUmum' ,\compact('umum', 'dari', 'sampai'));
    }
}

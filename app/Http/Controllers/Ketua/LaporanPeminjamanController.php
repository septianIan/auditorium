<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\PeminjamanUmum;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanPeminjamanController extends Controller
{
    public function index()
    {
        return view('ketua.laporan.index');
    }

    public function cekPeminjaman(Request $request)
    {
        $from = $request->form;
        $to = $request->to;
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
}

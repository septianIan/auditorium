<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\PeminjamanUmum;
use Illuminate\Http\Request;

class CekPeminjamanController extends Controller
{
    public function indexMahasiswa()
    {
        $mahas = PeminjamanAuditorium::where('status', 1)->get();
        return view('ketua.cekPeminjaman.indexMahasiswa', \compact('mahas'));
    }

    public function detailMahasiswa($id)
    {
        $mahasiswa = PeminjamanAuditorium::findOrFail($id);
        return view('ketua.cekPeminjaman.detailMaha', \compact('mahasiswa'));
    }

    //pegawai
    public function indexPegawai()
    {
        $employess = PeminjamanAuditoriumPegawai::where('status', 1)->get();
        return view('ketua.cekPeminjaman.indexPegawai', \compact('employess'));
    }

    public function detailPegawai($id)
    {
        $peminjam = PeminjamanAuditoriumPegawai::findOrFail($id);
        return view('ketua.cekPeminjaman.detailPegawai', \compact('peminjam'));
    }

    //umum
    public function indexUmum()
    {
        $umums = PeminjamanUmum::where('status', 1)->get();
        return view('ketua.cekPeminjaman.indexUmum', \compact('umums'));
    }

    public function detailUmum($id)
    {
        $peminjam = PeminjamanUmum::findOrFail($id);
        return view('ketua.cekPeminjaman.detailUmum', \compact('peminjam'));
    }
}

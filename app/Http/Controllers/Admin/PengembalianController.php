<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\PeminjamanUmum;
use App\Room;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMahasiswa()
    {
        $mahas = PeminjamanAuditorium::where('status', 0)->get();
        return view('admin.pengembalian.indexMahasiswa',  \compact('mahas'));
    }

    public function indexPegawai()
    {
        $employess = PeminjamanAuditoriumPegawai::where('status', 0)->get();
        return view('admin.pengembalian.indexPegawai',  \compact('employess'));
    }

    public function indexUmum()
    {
        $umums = PeminjamanUmum::where('status', 0)->get();
        return view('admin.pengembalian.indexUmum',  \compact('umums'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailMahasiswa($id)
    {
        $peminjam = PeminjamanAuditorium::findOrFail($id);
        $room = Room::where('id', $peminjam->id)->first();
        return view('admin.pengembalian.detailMahasiswa', \compact('peminjam', 'room'));
    }

    public function detailPegawai($id)
    {
        $peminjam = PeminjamanAuditoriumPegawai::findOrFail($id);
        $room = Room::where('id', $peminjam->id)->first();
        return view('admin.pengembalian.detailPegawai', \compact('peminjam', 'room'));
    }

    public function detailUmum($id)
    {
        $peminjam = PeminjamanUmum::findOrFail($id);
        $room = Room::where('id', $peminjam->id)->first();
        return view('admin.pengembalian.detailUmum', \compact('peminjam', 'room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

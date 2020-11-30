<?php

namespace App\Http\Controllers\Admin;

use App\Amenities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'fasilitas' => 'required',
        ]);

        Amenities::updateOrCreate($request->only('fasilitas', 'jumlah'));
        \session()->flash('pesanFasilitas', 'Data berhasil ditambahkan');
        return \redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $fasilitas = Amenities::findOrFail($id);
        $fasilitas->update([
            'fasilitas' => $request->fasilitas,
        ]);

        \session()->flash('pesanFasilitas', 'Data berhasil diubah');
        return \redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fasilitas = Amenities::findOrFail($id);
        $fasilitas->delete();
        \session()->flash('pesanFasilitas', 'Data berhasil dihapus');
        return \redirect()->back();
    }
}

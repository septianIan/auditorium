<?php

namespace App\Http\Controllers\Admin;

use App\Amenities;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index', [
            'rooms' => Room::orderBy('ruang')->get(),
            'amenities' => Amenities::orderBy('fasilitas')->get()
        ]);
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
            'ruang' => 'required'
        ]);

        Room::updateOrCreate($request->only('ruang'));
        \session()->flash('messageRoom', 'Data berhasil di tambahkan');
        return \redirect()->route('admin.room.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $room = Room::findOrFail($id);
        if ($room->status == 1) {
            \session()->flash('messageError', 'Data tidak berhasil di hapus');
            return \redirect()->route('admin.room.index');
        } else {
            $room->delete();
            \session()->flash('messageRoom', 'Data berhasil di dihapus');
            return \redirect()->route('admin.room.index');
        }
    }
}

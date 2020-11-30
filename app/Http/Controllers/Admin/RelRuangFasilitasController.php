<?php

namespace App\Http\Controllers\Admin;

use App\Amenities;
use App\Http\Controllers\Controller;
use App\Room;
use App\RuangFasilitas;
use Illuminate\Http\Request;

class RelRuangFasilitasController extends Controller
{
    public function index()
    {   
        $rooms = Room::latest()->get();
        return \view('admin.indexRuangFasilitas', [
            'rooms' => $rooms
        ]);
    }

    public function createRuangFasilitas($id)
    {
        $room = Room::findOrFail($id);
        $fasilitas = Amenities::orderBy('fasilitas', 'asc')->get();
        return \view('admin.createRuangFasilitas', \compact('room', 'fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room' => 'required',
            'fasilitas' => 'required'
        ]);

        if (\count($request->fasilitas) > 0) {
            foreach($request->fasilitas as $key => $v){
                $data = [
                    'room_id' => $request->room,
                    'fasilitas' => $request->fasilitas[$key]
                ];
                RuangFasilitas::updateOrCreate($data);
            }
        }

        return \redirect()->route('admin.kelolaRuang.edit', $request->room);
    }

    public function edit($id)
    {   
        $room = Room::orderBy('ruang', 'asc')->findOrFail($id);
        $fasilitas = Amenities::orderBy('fasilitas', 'asc')->get();
        return \view('admin.editRuangFasilitas', \compact('room', 'fasilitas'));
    }

    public function update(Request $request, $id)
    {   
        for ($i=0; $i < \count($request->idRuangFasilitas); $i++) { 
            RuangFasilitas::where('id', $request->idRuangFasilitas[$i])
            ->update([
                'jumlah' => $request->jumlah[$i]
            ]);
        }
        $room = Room::findOrFail($id);
        $room->update([
            'status' => '1'
        ]);
        \session()->flash('message', 'Fasilitas berhasil ditambahkan');
        return \redirect()->route('admin.kelolaRuang.index');
    }

    public function hapusFasilitas($id)
    {
        $ruangFasilitas = RuangFasilitas::findOrFail($id);
        $ruangFasilitas->delete();
        \session()->flash('pesanHapusFasilitas', 'Fasilitas berhail di hapus');
        return \redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DetailPeminjaman;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestFromPeminjaman;
use App\Mahasiswa;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\Room;
use App\RuangFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('admin.peminjaman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestFromPeminjaman $request)
    {   
        $nim = DB::table('mahasiswas')->where('nim', $request->nim)->first();
        if (empty($nim)) {
            \session()->flash('pesan', 'User belum terdaftar');
            return \redirect()->back();
        }
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads');
        }

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
        $mahasiswa_id = $mahasiswa->id;
        $room_id = $request->room;
        $dataPeminjam = \array_merge(
            $request->only('tglPinjam', 'dariJam', 'sampaiJam', 'kegiatan', 'image', 'noTelp', 'email'), \compact('image', 'room_id', 'mahasiswa_id')
        );
        $peminjaman = PeminjamanAuditorium::create($dataPeminjam);
        $peminjaman->update(['status' => 1]);

        if (\count($request->fasilitas) > 0) {
            foreach($request->fasilitas as $key => $v){
                $data = [
                    'peminjaman_auditorium_id' => $peminjaman->id,
                    'fasilitas' => $request->fasilitas[$key],
                    'jumlah' => $request->jumlah[$key]
                ];
                DB::table('detail_peminjaman')->insert($data);
            }
        }

        return \redirect()->route('admin.peminjaman.show', $peminjaman->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjam = PeminjamanAuditorium::findOrFail($id);
        $room = Room::where('id', $peminjam->id)->first();
        return view('admin.peminjaman.detailPeminjaman', \compact('peminjam', 'room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjam = PeminjamanAuditorium::findOrFail($id);
        $relRuangFasilitas = RuangFasilitas::where('room_id', $peminjam->room_id)->get();
        return view('admin.peminjaman.edit', \compact(
            'peminjam','relRuangFasilitas'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,PeminjamanAuditorium $peminjaman)
    {
        $nim = DB::table('mahasiswas')->where('nim', $request->nim)->first();
        if (empty($nim)) {
            \session()->flash('pesan', 'User belum terdaftar');
            return \redirect()->back();
        }
        $image = $peminjaman->image ?? null;
        if ($request->hasFile('image')) {
            Storage::delete($peminjaman->image);
            $image = $request->file('image')->store('uploads');
        }

        $dataPeminjam = \array_merge($request->only('mahasiswa_id', 'tglPinjam', 'dariJam', 'sampaiJam', 'kegiatan'), \compact('image'));
        $peminjaman->update($dataPeminjam);

        \session()->flash('message', 'Data berhasil di ubah');
        return \redirect()->route('admin.peminjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $peminjamanAuditorium = PeminjamanAuditorium::findOrFail($id);
        if ($peminjamanAuditorium->image) {
            Storage::delete($peminjamanAuditorium->image);
        }
        $peminjamanAuditorium->fasilitas->each->delete();
        $peminjamanAuditorium->delete();
        $success = false;
        $message = 'Data telah di hapus.';
        return \response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function hapusFasilitas($id)
    {
        $hapusFasilitas = DetailPeminjaman::findOrFail($id);
        $hapusFasilitas->delete();
        \session()->flash('pesanHapusFasilitas', 'Fasilitas berhail di hapus');
        return \redirect()->back();
    }

    public function pengembalian($id)
    {   
        $peminjaman = PeminjamanAuditorium::findOrFail($id);
        $peminjaman->update(['status' => 0]);
        return \response()->json([
            'success' => true
        ]);
    }

    public function editFasilitas(Request $request)
    {
        $peminjaman = DetailPeminjaman::findOrFail($request->idPeminjam);
        //update fasilitas
        for ($i = 0; $i < \count($request->idRuangFasilitas); $i++) {
            DB::table('detail_peminjaman')->where('id', $request->idRuangFasilitas[$i])
            ->update([
                'peminjaman_auditorium_id' => $request->idPeminjam,
                'fasilitas' => $request->fasilitas[$i],
                'jumlah' => $request->jumlah[$i]
            ]);
        }


        ///tambah fasilitas
        if (\count($request->fasilitas) > \count(array($peminjaman->fasilitas))) {
            foreach($request->fasilitas as $key => $v){
                $data = [
                    'peminjaman_auditorium_id' => $request->idPeminjam,
                    'fasilitas' => $request->fasilitas[$key],
                    'jumlah' => $request->jumlah[$key]
                ];
                DetailPeminjaman::updateOrCreate(['fasilitas' => $request->fasilitas[$key]],$data);
            }
        }

        return \redirect()->back();
    }

    public function generatePdf($id)
    {
        $mahasiswa = PeminjamanAuditorium::findOrFail($id);

        $pdf = PDF::loadview('admin.peminjaman.laporan_mahasiswa', ['peminjam' => $mahasiswa]);
        // return $pdf->download('cetak'. $mahasiswa->mahasiswa->nama .'.pdf');
        return $pdf->stream();
    }

    public function print($id)
    {
        $peminjam = PeminjamanAuditorium::findOrFail($id);

        return view('admin.peminjaman.laporan_mahasiswa', \compact('peminjam'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DetailPeminjamanUmum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestFormPeminjamanUmum;
use App\Http\Requests\RequestFromPeminjaman;
use App\PeminjamanUmum;
use App\Room;
use App\RuangFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class PeminjamanUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.peminjamanUmum.index');
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
    public function store(RequestFormPeminjamanUmum $request)
    {   
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads');
        }

        $dataPeminjam = \array_merge(
            $request->only('nik', 'nama', 'alamat', 'tglPinjam', 'dariJam', 'sampaiJam', 'kegiatan', 'image', 'noTelp', 'email', 'room_id'), \compact('image')
        );
        $peminjaman = PeminjamanUmum::create($dataPeminjam);
        $peminjaman->update(['status' => 1]);

        if (\count($request->fasilitas) > 0) {
            foreach($request->fasilitas as $key => $v){
                $data = [
                    'peminjaman_id' => $peminjaman->id,
                    'fasilitas' => $request->fasilitas[$key],
                    'jumlah' => $request->jumlah[$key]
                ];
                DB::table('detail_peminjaman_umums')->insert($data);
            }
        }

        //SEND EMAIL
        $email = $request->email;
        $peminjam = PeminjamanUmum::findOrFail($peminjaman->id);
        $data = [
            'nama' => $request->nama,
            'peminjam' => $peminjam,
        ];

        Mail::send('admin.template.email_templateUmum', $data, function($mail) use($email){
            $mail->to($email, 'no-reply')
                ->subject('Detail Peminjaman');
            $mail->from('adamwahyu929@gmail.com', 'Peminjaman Auditorium');
        });

        return \redirect()->route('admin.umum.show', $peminjaman->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjam = PeminjamanUmum::findOrFail($id);
        $room = Room::where('id', $peminjam->id)->first();
        return view('admin.peminjamanUmum.detailPeminjamanUmum', \compact('peminjam', 'room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjam = PeminjamanUmum::findOrFail($id);
        $detailFasiltas = DetailPeminjamanUmum::where('peminjaman_id', $id)->get();
        $relRuangFasilitas = RuangFasilitas::where('room_id', $peminjam->room_id)->get();
        $room = RuangFasilitas::where('room_id', $peminjam->room_id)->get();
        return view('admin.peminjamanUmum.edit', \compact(
            'peminjam', 'detailFasiltas', 'room', 'relRuangFasilitas'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,PeminjamanUmum $peminjamanUmum)
    {
        // \dd($request->all());
        $image = $peminjamanUmum->image ?? null;
        if ($request->hasFile('image')) {
            Storage::delete($peminjamanUmum->image);
            $image = $request->file('image')->store('uploads');
        }

        $dataPeminjam = \array_merge(
            $request->only('nik', 'nama', 'alamat', 'tglPinjam', 'dariJam', 'sampaiJam', 'kegiatan', 'image', 'noTelp', 'email', 'room_id'), \compact('image')
        );
        $peminjamanUmum->update($dataPeminjam);

        \session()->flash('message', 'Data berhasil di ubah');
        return \redirect()->route('admin.pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peminjamanAuditorium = PeminjamanUmum::findOrFail($id); 
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
        $hapusFasilitas = DetailPeminjamanUmum::findOrFail($id);
        $hapusFasilitas->delete();
        \session()->flash('pesanHapusFasilitas', 'Fasilitas berhail di hapus');
        return \redirect()->back();
    }

    public function pengembalian($id)
    {   
        $peminjaman = PeminjamanUmum::findOrFail($id);
        $peminjaman->update(['status' => 0]);
        return \response()->json([
            'success' => true
        ]);
    }

    public function editFasilitas(Request $request)
    {
        //update fasilitas
        for ($i = 0; $i < \count($request->idRuangFasilitas); $i++) {
            DB::table('detail_peminjaman_umums')->where('id', $request->idRuangFasilitas[$i])
            ->update([
                'peminjaman_id' => $request->idPeminjam,
                'fasilitas' => $request->fasilitas[$i],
                'jumlah' => $request->jumlah[$i]
            ]);
        }


        //tambah fasilitas
        $peminjaman = DetailPeminjamanUmum::findOrFail($request->idPeminjam);
        if (\count($request->fasilitas) > \count(array($peminjaman->fasilitas))) {
            foreach($request->fasilitas as $key => $v){
                $data = [
                    'peminjaman_id' => $request->idPeminjam,
                    'fasilitas' => $request->fasilitas[$key],
                    'jumlah' => $request->jumlah[$key]
                ];
                DetailPeminjamanUmum::updateOrCreate(['fasilitas' => $request->fasilitas[$key]],$data);
            }
        }

        return \redirect()->back();
    }

    public function generatePdf($id)
    {
        $umum = PeminjamanUmum::findOrFail($id);

        $pdf = PDF::loadview('admin.peminjamanUmum.laporan_umum', ['peminjam' => $umum]);
        // return $pdf->download('cetak'. $mahasiswa->mahasiswa->nama .'.pdf');
        return $pdf->stream();
    }

    public function print($id)
    {
        $peminjam = PeminjamanUmum::findOrFail($id);

        return view('admin.peminjamanUmum.laporan_umum', \compact('peminjam'));
    }
}
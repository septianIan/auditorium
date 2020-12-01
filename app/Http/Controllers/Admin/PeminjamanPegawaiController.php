<?php

namespace App\Http\Controllers\Admin;

use App\DetailPeminjaman;
use App\DetailPeminjamanPegawai;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestFormPeminjamanPegawai;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Requests\RequestFromPeminjaman;
use App\Mahasiswa;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\RuangFasilitas;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class PeminjamanPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('admin.peminjamanPegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        \dd($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestFormPeminjamanPegawai $request)
    {   
        $nik = DB::table('pegawais')->where('nik', $request->nik)->first();
        if (empty($nik)) {
            \session()->flash('pesan', 'User belum terdaftar');
            return \redirect()->back();
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads');
        }

        $dataPeminjam = \array_merge(
            $request->only('tglPinjam', 'dariJam', 'sampaiJam', 'kegiatan', 'image', 'noTelp', 'email', 'room_id', 'pegawai_id'), \compact('image')
        );
        $peminjaman = PeminjamanAuditoriumPegawai::create($dataPeminjam);
        $peminjaman->update(['status' => 1]);

        if (\count($request->fasilitas) > 0) {
            foreach($request->fasilitas as $key => $v){
                $data = [
                    'peminjaman_pegawai_id' => $peminjaman->id,
                    'fasilitas' => $request->fasilitas[$key],
                    'jumlah' => $request->jumlah[$key]
                ];
                DB::table('detail_peminjaman_pegawais')->insert($data);
            }
        }

        //SEND EMAIL
        $email = $request->email;
        $peminjam = PeminjamanAuditoriumPegawai::findOrFail($peminjaman->id);
        $data = [
            'nama' => $request->nama,
            'peminjam' => $peminjam,
        ];

        Mail::send('admin.template.email_templatePegawai', $data, function($mail) use($email){
            $mail->to($email, 'no-reply')
                ->subject('Detail Peminjaman');
            $mail->from('adamwahyu929@gmail.com', 'Peminjaman Auditorium');
        });

        return \redirect()->route('admin.pegawai.show', $peminjaman->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjam = PeminjamanAuditoriumPegawai::findOrFail($id);
        $room = Room::where('id', $peminjam->id)->first();
        return view('admin.peminjamanPegawai.detailPeminjamanPegawai', \compact('peminjam', 'room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjam = PeminjamanAuditoriumPegawai::findOrFail($id);
        $relRuangFasilitas = RuangFasilitas::where('room_id', $peminjam->room_id)->get();
        return view('admin.peminjamanPegawai.edit', \compact(
            'peminjam', 'relRuangFasilitas'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,PeminjamanAuditoriumPegawai $peminjamanAuditoriumPegawai)
    {
        $nik = DB::table('pegawais')->where('nik', $request->nik)->first();
        if (empty($nik)) {
            \session()->flash('message', 'User belum terdaftar');
            return \redirect()->back();
        }

        $image = $peminjamanAuditoriumPegawai->image ?? null;
        if ($request->hasFile('image')) {
            Storage::delete($peminjamanAuditoriumPegawai->image);
            $image = $request->file('image')->store('uploads');
        }

        $dataPeminjam = \array_merge(
            $request->only('tglPinjam', 'dariJam', 'sampaiJam', 'kegiatan', 'image', 'noTelp', 'email', 'room_id', 'pegawai_id'), \compact('image')
        );
        $peminjamanAuditoriumPegawai->update($dataPeminjam);

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
        $peminjamanAuditorium = PeminjamanAuditoriumPegawai::findOrFail($id); 
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

    public function pengembalian($id)
    {   
        $peminjaman = PeminjamanAuditoriumPegawai::findOrFail($id);
        $peminjaman->update(['status' => 0]);
        return \response()->json([
            'success' => true
        ]);
    }

    public function editFasilitas(Request $request)
    {
        //update fasilitas
        for ($i = 0; $i < \count($request->idRuangFasilitas); $i++) {
            DB::table('detail_peminjaman_pegawais')->where('id', $request->idRuangFasilitas[$i])
            ->update([
                'peminjaman_pegawai_id' => $request->idPeminjam,
                'fasilitas' => $request->fasilitas[$i],
                'jumlah' => $request->jumlah[$i]
            ]);
        }


        //tambah fasilitas
        $peminjaman = DetailPeminjamanPegawai::findOrFail($request->idPeminjam);
        if (\count($request->fasilitas) > \count(array($peminjaman->fasilitas))) {
            foreach($request->fasilitas as $key => $v){
                $data = [
                    'peminjaman_pegawai_id' => $request->idPeminjam,
                    'fasilitas' => $request->fasilitas[$key],
                    'jumlah' => $request->jumlah[$key]
                ];
                DetailPeminjamanPegawai::updateOrCreate(['fasilitas' => $request->fasilitas[$key]],$data);
            }
        }
        \session()->flash('pesanHapusFasilitas', 'Berhasil');
        return \redirect()->back();
    }

    public function deleteFasilitas($id)
    {

        $hapusFasilitas = DetailPeminjamanPegawai::where('id', $id)->delete();
        // \dd($hapusFasilitas);
        \session()->flash('pesanHapusFasilitas', 'Fasilitas berhail di hapus');
        return \redirect()->back();
    }

    public function generatePdf($id)
    {
        $pegawai = PeminjamanAuditoriumPegawai::findOrFail($id);

        $pdf = PDF::loadview('admin.peminjamanPegawai.laporan_pegawai', ['peminjam' => $pegawai]);
        // return $pdf->download('cetak'. $mahasiswa->mahasiswa->nama .'.pdf');
        return $pdf->stream();
    }

    public function print($id)
    {
        $peminjam = PeminjamanAuditoriumPegawai::findOrFail($id);

        return view('admin.peminjamanPegawai.laporan_pegawai', \compact('peminjam'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\PeminjamanUmum;
use App\Room;
use App\RuangFasilitas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuangFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::latest()->get();
        return \view('admin.auditorium', [
            'rooms' => $rooms
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function peminjamanMahasiswa($id)
    {
        $room = Room::findOrFail($id);
        return \view('admin.peminjaman.createPeminjaman', \compact('room'));
    }

    public function peminjamanPagawai($id)
    {
        $room = Room::findOrFail($id);
        return \view('admin.peminjamanPegawai.createPeminjaman', \compact('room'));
    }

    public function peminjamanUmum($id)
    {
        $room = Room::findOrFail($id);
        return \view('admin.peminjamanUmum.createPeminjaman', \compact('room'));
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

    public function cariNim(Request $request)
    {
        $nim = DB::table('mahasiswas')->where('nim', $request->nim)->first();
        if (!empty($nim)) {
            $success = true;
            $message = 'Nim sudah terdaftar';
            $data = $nim;
        } else {
            $success = \false;
            $message = 'Nim belum terdaftar';
            $data = '';
        }
        return \response()->json([
            'success' => $success,
            'message' => $message,
            'maha' => $data,
        ]);
    }

    public function cariTglPinjam(Request $request)
    {
        $tglPinjamMaha = PeminjamanAuditorium::where([
            ['room_id', '=', $request->room_id],
            ['tglPinjam', '=', $request->tglPinjam]
            ])->first();
        $tglPinjamPegawai = PeminjamanAuditoriumPegawai::where([
            ['room_id', '=', $request->room_id],
            ['tglPinjam', '=', $request->tglPinjam]
            ])->first();
        $tglPinjamUmum = PeminjamanUmum::where([
            ['room_id', '=', $request->room_id],
            ['tglPinjam', '=', $request->tglPinjam]
            ])->first();

        switch (true) {
            case ($tglPinjamMaha != "" && $tglPinjamMaha->status == 1):
                $success = true;
                $message = 'Tanggal '.$tglPinjamMaha->tglPinjam.' Ruangan '.$tglPinjamMaha->room->ruang.' masih di gunakan !!!';
                break;
            case($tglPinjamPegawai != "" && $tglPinjamPegawai->status == 1):
                $success = true;
                $message = 'Tanggal '.$tglPinjamPegawai->tglPinjam.' Ruangan '.$tglPinjamPegawai->room->ruang.' masih di gunakan !!!';
                break;
            case($tglPinjamUmum != "" && $tglPinjamUmum->status == 1):
                $success = true;
                $message = 'Tanggal '.$tglPinjamUmum->tglPinjam.' Ruangan '.$tglPinjamUmum->room->ruang.' masih di gunakan !!!';
                break;
            default:
                $success = false;
                $message = 'Tanggal siap digunakan';
                break;
        }
        return \response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function cariStok(Request $request)
    {
        $relRuangFasilitas = RuangFasilitas::where('fasilitas', $request->fasilitas)->first();
        return \response()->json($relRuangFasilitas);
    }

    public function cariNik(Request $request)
    {
        $nik = DB::table('pegawais')->where('nik', $request->nik)->first();
        if (!empty($nik)) {
            $success = true;
            $message = 'Nik sudah terdaftar';
            $data = $nik;
        } else {
            $success = \false;
            $message = 'Nik belum terdaftar';
            $data = '';
        }
        return \response()->json([
            'success' => $success,
            'message' => $message,
            'pegawai' => $data,
        ]);
    }
}

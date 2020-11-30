<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pegawai;
use App\PeminjamanAuditoriumPegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'email' => 'required',
        ]);
        $data = $request->except('_token');
        Pegawai::create($data);
        \session()->flash('pesan', 'Data pegawai berhasil ditambahkan');
        return \redirect()->route('admin.pegawai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return view('admin.pegawai.detail', [
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('admin.pegawai.edit', [
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'email' => 'required',
        ]);
        $data = $request->except('_token');
        $pegawai->update($data);
        \session()->flash('pesan', 'Data pegawai berhasil diubah');
        return \redirect()->route('admin.pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $peminjaman = PeminjamanAuditoriumPegawai::where('pegawai_id', $pegawai->id)->first();

        if ($peminjaman != '' && $peminjaman->status == 0 || empty($peminjaman)) {
            $pegawai->delete();
            $success = true;
            $message = 'Data berhasil dihapus';
        } else if($peminjaman != '' && $peminjaman->status == 1){
            $success = \false;
            $message = 'Pegawai masih dalam pinjaman';
        }
        return \response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function dataTablePegawai()
    {
        $employee = Pegawai::latest()->get();
        return \datatables()->of($employee)
            ->addColumn('action', 'template.components.action.DT-action-admin')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}

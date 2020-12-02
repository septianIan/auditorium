<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\PeminjamanAuditorium;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mahasiswa.index', [
            'students' => Mahasiswa::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
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
            'nim' => 'required',
            'nama' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'email' => 'required',
        ]);
        $data = $request->except('_token');
        Mahasiswa::create($data);
        \session()->flash('pesan', 'Data mahasiswa berhasil ditambahkan');
        return \redirect()->route('admin.mahasiswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.detail', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return \view('admin.mahasiswa.edit', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'email' => 'required',
        ]);
        $data = $request->except('_token');
        $mahasiswa->update($data);
        \session()->flash('pesan', 'Data mahasiswa berhasil diubah');
        return \redirect()->route('admin.mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $peminjaman = PeminjamanAuditorium::where('mahasiswa_id', $mahasiswa->id)->first();

        if (empty($peminjaman)) {
            $mahasiswa->delete();
            $success = true;
            $message = 'Data berhasil dihapus';
        } else if($peminjaman != ''){
            $success = \false;
            $message = 'Mahasiswa masih dalam pinjaman atau memiliki riwayat';
        }
        return \response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function dataTableMahasiswa()
    {
        $students = Mahasiswa::latest()->get();
        return \datatables()->of($students)
            ->addColumn('action', 'template.components.action.DT-action-admin')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }
}

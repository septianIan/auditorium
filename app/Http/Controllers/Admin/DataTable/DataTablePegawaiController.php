<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\PeminjamanAuditoriumPegawai;
use Illuminate\Http\Request;

class DataTablePegawaiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $peminjam = PeminjamanAuditoriumPegawai::with(['pegawai','room'])->where('status', 1)->latest()->get();
        return \datatables()->of($peminjam)
            ->addColumn('action', 'template.components.action.DT-action-admin')
            ->addColumn('dariSampai',  function(PeminjamanAuditoriumPegawai $peminjamanAuditoriumPegawai){
                return $peminjamanAuditoriumPegawai->getDariSampai();
            })
            ->addColumn('tglPinjam', function(PeminjamanAuditoriumPegawai $peminjamanAuditoriumPegawai){
                return $peminjamanAuditoriumPegawai->getFormatTgl();
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'dariSampai', 'tglPinjam'])
            ->toJson();
    }
}

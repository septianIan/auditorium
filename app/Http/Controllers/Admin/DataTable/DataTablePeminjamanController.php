<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\PeminjamanAuditorium;
use Illuminate\Http\Request;

class DataTablePeminjamanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $peminjam = PeminjamanAuditorium::with(['mahasiswa','room'])->where('status', 1)->latest()->get();
        return \datatables()->of($peminjam)
            ->addColumn('action', 'template.components.action.DT-action-admin')
            ->addColumn('dariSampai',  function(PeminjamanAuditorium $peminjamanAuditorium){
                return $peminjamanAuditorium->getDariSampai();
            })
            ->addColumn('tglPinjam',  function(PeminjamanAuditorium $peminjamanAuditorium){
                return $peminjamanAuditorium->getFormatTgl();
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'dariSampai', 'tglPinjam'])
            ->toJson();
    }
}

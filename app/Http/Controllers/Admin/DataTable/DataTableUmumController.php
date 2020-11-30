<?php

namespace App\Http\Controllers\Admin\DataTable;

use App\Http\Controllers\Controller;
use App\PeminjamanUmum;
use Illuminate\Http\Request;

class DataTableUmumController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $peminjam = PeminjamanUmum::with('room')->where('status', 1)->latest()->get();
        return \datatables()->of($peminjam)
            ->addColumn('action', 'template.components.action.DT-action-admin')
            ->addColumn('dariSampai',  function(PeminjamanUmum $peminjamanUmum){
                return $peminjamanUmum->getDariSampai();
            })
            ->addColumn('tglPinjam',  function(PeminjamanUmum $peminjamanUmum){
                return $peminjamanUmum->getDariSampai();
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'dariSampai', 'tglPinjam'])
            ->toJson();
    }
}
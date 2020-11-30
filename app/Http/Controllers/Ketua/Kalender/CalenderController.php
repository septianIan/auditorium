<?php

namespace App\Http\Controllers\Ketua\Kalender;

use App\Http\Controllers\Controller;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\PeminjamanUmum;
use DateTime;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function indexKetua()
    {   
        $students = PeminjamanAuditorium::where('status', 1)->get();
        $employees = PeminjamanAuditoriumPegawai::where('status', 1)->get();
        $umums = PeminjamanUmum::where('status', 1)->get();
        return view('calendar.indexKetua', \compact('students', 'employees', 'umums'));
    }
}

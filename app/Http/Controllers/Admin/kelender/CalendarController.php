<?php

namespace App\Http\Controllers\Admin\kelender;

use App\Http\Controllers\Controller;
use App\PeminjamanAuditorium;
use App\PeminjamanAuditoriumPegawai;
use App\PeminjamanUmum;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function indexAdmin()
    {   
        $students = PeminjamanAuditorium::where('status', 1)->get();
        $employees = PeminjamanAuditoriumPegawai::where('status', 1)->get();
        $umums = PeminjamanUmum::where('status', 1)->get();
        return view('calendar.index', \compact('students', 'employees', 'umums'));
    }
}

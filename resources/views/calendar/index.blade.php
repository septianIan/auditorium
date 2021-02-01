@extends('template.ui')
@section('title', 'Calendar')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">Calendar</li>
</ol>
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="card card-outline card-success">
               <div id="calendar"></div>
            </div>
         </div>
      </div>
   </div>
@endsection
@push('styles')
   <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
   <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('scripts')
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>
   <script>
      $(document).ready(function(){
         $('#calendar').fullCalendar({
            header : {
               left: 'prev, next today',
               center: 'Kalender',
               right: 'month, basicWeek, basicDay'
            },
            initialView: 'dayGridMonth',
            initialDate: '2020-11-12',
            eventColor: 'green',
            events: [
               @foreach($students as $student)
                     {
                        title: '{{ $student->mahasiswa->nama.' | '.$student->dariJam }} - {{ $student->sampaiJam }}',
                        start: '{{ $student->tglPinjam }}',
                        url: 'peminjaman/{{ $student->id }}',
                        color: 'blue'
                     },
               @endforeach
               @foreach($employees as $employee)
                     {
                        title: '{{ $employee->pegawai->nama.' | '.$employee->dariJam }} - {{ $employee->sampaiJam }}',
                        start: '{{ $employee->tglPinjam }}',
                        url: 'pegawai/{{ $employee->id }}',
                        color: 'green'
                     },
               @endforeach
               @foreach($umums as $umum)
                     {
                        title: '{{ $umum->nama.' | '.$umum->dariJam. ''.$umum->sampaiJam }}',
                        start: '{{ $umum->tglPinjam }}',
                        url: 'umum/{{ $umum->id }}',
                        color: 'orange'
                     },
               @endforeach
            ],
         });
      })
   </script>  
@endpush
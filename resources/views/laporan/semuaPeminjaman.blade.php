@extends('template.ui')
@section('title', 'Batas Tanggal Peminjam')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">Semua Peminjam</li>
</ol>
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="card card-outline card-default">
               <div class="card-header">
                  Batas Tanggal Peminjam
               </div>
               <div class="card-body">
                  <table id="dataTable" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama</th>
                           <th>Tanggal Pinjam</th>
                           <th>Jam</th>
                           <th>Ruang</th>
                           <th>Jenis peminjam</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                           $no = 1;
                        @endphp
                        @foreach($peminjamanMahasiswa as $mahasiswa)
                           <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $mahasiswa->mahasiswa->nama }}</td>
                              <td style="color:red;">{{ $mahasiswa->tglPinjam }}</td>
                              <td>{{ $mahasiswa->dariJam }} - {{ $mahasiswa->sampaiJam }}</td>
                              <td>{{ $mahasiswa->room->ruang }}</td>
                              <td>Mahasiswa</td>
                           </tr>
                        @endforeach
                        @foreach($peminjamanPegawai as $pegawai)
                           <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $pegawai->pegawai->nama }}</td>
                              <td style="color:red;">{{ $pegawai->tglPinjam }}</td>
                              <td>{{ $pegawai->dariJam }} - {{ $pegawai->sampaiJam }}</td>
                              <td>{{ $pegawai->room->ruang }}</td>
                              <td>Pegawai</td>
                           </tr>
                        @endforeach
                        @foreach($peminjamanUmum as $umum)
                           <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $umum->nama }}</td>
                              <td style="color:red;">{{ $umum->tglPinjam }}</td>
                              <td>{{ $umum->dariJam }} - {{ $umum->sampaiJam }}</td>
                              <td>{{ $umum->room->ruang }}</td>
                              <td>Umum</td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
   $(function(){
      $('.multiSelect').select2({
            theme: 'bootstrap4'
      })
   })

   $(function() {

      $("#dataTable").DataTable({
         "responsive": true,
         "autoWidth": false,
      });
      //notif
      $('#notif').fadeTo(2000, 500).slideUp(500, function(){
               $('#notif').slideUp(500);
      })
   });
</script>
@endpush
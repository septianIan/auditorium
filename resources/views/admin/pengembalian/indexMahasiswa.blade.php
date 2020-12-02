@extends('template.ui')
@section('title', 'Data pengembalian mahasiswa')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">Data pengembalian mahasiswa</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <div class="card card-primary">
            <div class="card-body">
               <table id="dataTable1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Fakultas</th>
                        <th>Jurusan</th>
                        <th>No Telp</th>
                        <th>Auditorium</th>
                        <th>Dari - Sampai</th>
                        <th>Tgl pinjam</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($mahas as $maha)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $maha->mahasiswa->nim }}</td>
                           <td>{{ $maha->mahasiswa->nama }}</td>
                           <td>{{ $maha->mahasiswa->fakultas }}</td>
                           <td>{{ $maha->mahasiswa->jurusan }}</td>
                           <td>{{ $maha->noTelp }}</td>
                           <td>{{ $maha->room->ruang }}</td>
                           <td>{{ $maha->getDariSampai() }}</td>
                           <td>{{ $maha->getFormatTgl() }}</td>
                           <td>
                              <div class="btn-group align-middle py-0">
                                 {{-- Detail --}}
                                 <a href="{{ route('admin.peminjaman.show', $maha->id) }}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                              </div>
                           </td>
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

<!--- Sweet alert -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Sweet alert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
   $(function () {
      $("#dataTable1").DataTable({
         "responsive": true,
         "autoWidth": false,
      });
   });
</script>
@endpush
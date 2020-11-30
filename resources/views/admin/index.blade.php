@extends('template.ui')
@section('title', 'Data kelola ruang')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">Data kelola ruang</li>
</ol>
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Data kelola ruang</h3>
               </div>
               <div class="card-body" style="overflow-x:auto;height:560px;">
                  @if(session('messageRoom'))
                     <div  div id="notif" class="alert alert-info">{{ session('messageRoom') }}</div>
                  @elseif(session('messageError'))
                     <div  div id="notif" class="alert alert-danger">{{ session('messageError') }}</div>
                  @endif
                  <form action="{{ route('admin.room.store') }}" method="post">
                     @csrf
                     <div class="input-group input-group-sm">
                        <input type="text" placeholder="Ruang ..." name="ruang" class="form-control @error('ruang') is-invalid @enderror">
                        <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat">Simpan!</button>
                        </span>
                        @error('ruang')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </form>

                  <table id="dataTable" class="table table-bordered table-striped mt-2">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama ruang</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($rooms as $room)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $room->ruang }}</td>
                           <td>
                              <form action="{{ route('admin.room.destroy', $room->id) }}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      
         <div class="col-md-6">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Data kelola fasilitas</h3>
               </div>
               <div class="card-body" style="overflow-x:auto;height:560px;">
                  <form action="{{ route('admin.fasilitas.store') }}" method="post">
                  @csrf
                     <div class="input-group input-group-sm">
                        <input type="text" placeholder="Fasilitas ..." name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror">
                        <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat">Simpan!</button>
                        </span>
                        @error('fasilitas')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </form>

                  @if(session('pesanFasilitas'))
                     <div  div id="notifFasilitas" class="alert alert-info">{{ session('pesanFasilitas') }}</div>
                  @endif
                  <table id="example1" class="table table-bordered table-striped mt-2">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Fasilitas</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($amenities as $v)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $v->fasilitas }}</td>
                           <td>
                              <form action="{{ route('admin.fasilitas.destroy', $v->id) }}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </form>
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
@endpush

@push('scripts')
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
   <script>
      $('#notif').fadeTo(2000, 500).slideUp(500, function(){
            $('#notif').slideUp(500);
      });

      $('#notifFasilitas').fadeTo(2000, 500).slideUp(500, function(){
         $('#notifFasilitas').slideUp(500);
      });

      (function () {
         $("#example1").DataTable({
         "responsive": true,
         "autoWidth": false,
         });
      });
   </script>
@endpush
@extends('template.ui')
@section('title', 'Detail peminjaman mahasiswa')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('ketua.peminjaman.mahasiswa') }}">Data peminjam</a></li>
   <li class="breadcrumb-item active">Detail peminjaman</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-12">
         <div class="invoice p-3 mb-3">
            <div class="row">
               <div class="col-12">
                  <h4><i class="fa fa-info-circle"></i>&nbsp;Detail Peminjaman <b>{{ $mahasiswa->room->ruang }}</b></h4>
               </div>
            </div>
            <div class="row invoice-info">
               <div class="col-3 invoice-col">
                  <address>
                     Nama : {{ $mahasiswa->mahasiswa->nama }} <br>
                     Nim : {{ $mahasiswa->mahasiswa->nim }} <br>
                     Fakultas : {{ $mahasiswa->mahasiswa->fakultas }} <br>
                     Jurusan : {{ $mahasiswa->mahasiswa->jurusan }}<br>
                  </address>
               </div>
               <div class="col-4 invoice-col">
                  <address>
                     Dari : {{ $mahasiswa->dariJam }} <br>
                     Sampai : {{ $mahasiswa->sampaiJam }} <br>
                     Tgl pinjam : {{ $mahasiswa->getFormatTgl() }} <br>
                     Kegiatan : {{ $mahasiswa->kegiatan }}<br>
                  </address>
               </div>
               <div class="col-3 invoice-col">
                  <address>
                     No Telp : {{ $mahasiswa->noTelp }} <br>
                     Email : {{ $mahasiswa->email }} <br>
                  </address>
               </div>
            </div>
            {{-- Row table --}}
            <div class="row">
               <div class="col-12 table-responsive">
                  <table id="dataTable" class="table table-stripped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Fasilitas</th>
                           <th>Jumlah</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($mahasiswa->fasilitas as $fasilitas)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $fasilitas->fasilitas }}</td>
                              <td>{{ $fasilitas->jumlah }}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>

            <div class="row no-print">
               <div class="col-12">
               <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-xl">
                  <i class="nav-icon far fa-image"></i> Lihat gambar
               </a>
               </div>
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

<div class="modal fade" id="modal-xl">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Extra Large Modal</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <img src="{{ $mahasiswa->getImage() }}" style="width:1100px;">
      </div>
      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Sweet alert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@endpush
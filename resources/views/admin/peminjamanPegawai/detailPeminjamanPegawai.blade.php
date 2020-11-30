@extends('template.ui')
@section('title', 'Detail peminjaman')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('admin.pegawai.index') }}">Data peminjam pegawai</a></li>
   <li class="breadcrumb-item active">Detail peminjaman pagawai</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-12">
         <div class="invoice p-3 mb-3">
            <div class="row">
               <div class="col-12">
                  <h4><i class="fa fa-info-circle"></i>&nbsp;Detail Peminjaman pagawai<b> {{ $peminjam->room->ruang }}</b></h4>
               </div>
            </div>
            <div class="row invoice-info">
               <div class="col-3 invoice-col">
                  <address>
                     Nama : {{ $peminjam->pegawai->nama }} <br>
                     Nik : {{ $peminjam->pegawai->nik }} <br>
                     Alamat : {{ $peminjam->pegawai->alamat }} <br>
                  </address>
               </div>
               <div class="col-4 invoice-col">
                  <address>
                     Dari : {{ $peminjam->dariJam }} <br>
                     Sampai : {{ $peminjam->sampaiJam }} <br>
                     tglPinjam : {{ $peminjam->getFormatTgl() }} <br>
                     Kegiatan : {{ $peminjam->kegiatan }}<br>
                  </address>
               </div>
               <div class="col-3 invoice-col">
                  <address>
                     No Telp : {{ $peminjam->noTelp }} <br>
                     Email : {{ $peminjam->email }} <br>
                  </address>
               </div>
            </div>
            {{-- Row table --}}
            <div class="row">
               <div class="col-12 table-responsive">
                  <table class="table table-stripped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Fasilitas</th>
                           <th>Jumlah</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($peminjam->fasilitas as $fasilitas)
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
               <a href="{{ route('admin.print.pegawai', $peminjam->id) }}" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
               @if($peminjam->status === 1)
                  <a href="#" data-id="{{ $peminjam->id }}" class="btn btn-success btn-flat float-right" id="pengembalian" style="margin-right: 5px;">
                     <i class="fa fa-check-square"></i> Pengembalian
                  </a>
               @else
                  <font style="float:right;font-weight:bold;">User sudah mengembalikan</font>
               @endif

               {{-- <a href="{{ route('admin.generatePdf.pegawai', $peminjam->id) }}" class="btn btn-primary btn-flat float-right" style="margin-right: 5px;">
                  <i class="fas fa-download"></i> Generate PDF
               </a> --}}
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
         <img src="{{ $peminjam->getImage() }}" style="width:1100px;">
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
<script>
   $('#pengembalian').on('click', function(e){
      e.preventDefault();
      var id = $(this).data('id'); //ambil dari data-id

      Swal.fire({
         title: 'Pengembalian kunci auditorium?',
         text: "",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes!',
         cancelButtonText: 'Cancel!',
      }).then((result) => {
         if (result.value) {
            $.ajax({
               type: "GET",
               url: "/administator/pegawai/pengembalian/"+id,
               data: {
                  "id": id,
                  "_token": "{{ csrf_token() }}"
               },

               //setelah berhasil di hapus
               success: function(data){
                  Swal.fire(
                  'Pengembalian!',
                  'Pengembalian auditorium.',
                  'success'
                  )
                  //setelah alert succes, maka reload halaman
                  location.reload(true);
               }
            })
         }
      })
   });
</script>
@endpush
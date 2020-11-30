@extends('template.ui')
@section('title', 'Detail umum')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('ketua.umum.index') }}">Data peminjam umum</a></li>
   <li class="breadcrumb-item active">Detail peminjaman umum</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-12">
         <div class="invoice p-3 mb-3">
            <div class="row">
               <div class="col-12">
                  <h4><i class="fa fa-info-circle"></i>&nbsp;Detail Peminjaman umum<b> {{ $peminjam->room->ruang }}</b></h4>
               </div>
            </div>
            <div class="row invoice-info">
               <div class="col-3 invoice-col">
                  <address>
                     Nama : {{ $peminjam->nama }} <br>
                     Nik : {{ $peminjam->nik }} <br>
                     Alamat : {{ $peminjam->alamat }} <br>
                  </address>
               </div>
               <div class="col-4 invoice-col">
                  <address>
                     Dari : {{ $peminjam->dariJam }} <br>
                     Sampai : {{ $peminjam->sampaiJam }} <br>
                     Tgl pinjam : {{ $peminjam->getFormatTgl() }} <br>
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
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  @if($peminjam->status === 1)
                     <a href="#" data-id="{{ $peminjam->id }}" class="btn btn-success btn-flat float-right" id="pengembalian" style="margin-right: 5px;">
                        <i class="fa fa-check-square"></i> Pengembalian
                     </a>
                  @else
                     <font style="float:right;font-weight:bold;">User sudah mengembalikan</font>
                  @endif

                  <a href="#" class="btn btn-primary btn-flat float-right" style="margin-right: 5px;">
                     <i class="fas fa-download"></i> Generate PDF
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('styles')
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
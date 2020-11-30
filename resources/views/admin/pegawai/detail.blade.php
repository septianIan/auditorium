@extends('template.ui')
@section('title', 'Detail data pegawai')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('admin.pegawai.index') }}">Data pegawai</a></li>
</ol>
@endsection
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="invoice p-3 mb-3">
               <div class="row">
                  <div class="col-12">
                     <h4><i class="fa fa-info-circle"></i>&nbsp;Detail pegawai</h4>
                  </div>
               </div>
               <div class="row invoice-info">
                  <div class="col-3 invoice-col">
                     <address>
                        Nama : {{ $pegawai->nama }} <br>
                        Nik : {{ $pegawai->nik }} <br>
                        Alamat : {{ $pegawai->alamat }} <br>
                     </address>
                  </div>
                  <div class="col-3 invoice-col">
                     <address>
                        No Telp : {{ $pegawai->noTelp }} <br>
                        Email : {{ $pegawai->email }} <br>
                     </address>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
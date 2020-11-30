@extends('template.ui')
@section('title', 'Laporan')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">laporan</li>
</ol>
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="card card-outline card-default">
               <div class="card-header">
                  Laporan between
               </div>
               <div class="card-body">
                  <form action="{{ route('admin.laporan.cekPenjaman') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-sm-4">
                           <label for="">Dari</label>
                           <input type="date" name="dari" class="form-control" id="">
                        </div>
                        <div class="col-sm-4">
                           <label for="">Sampai</label>
                           <input type="date" name="sampai" class="form-control" id="">
                        </div>
                        <div class="col-sm-2" style="display:inline;margin-top:30px;">
                           <input type="submit" class="btn btn-default btn-flat" value="Submit">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <div class="col-lg-6">
            <div class="card card-outline card-success">
               <div class="card-header">
                  Laporan mahasiswa
               </div>
               <div class="card-body">
                  <form action="{{ route('admin.laporan.cekMahasiswa') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-sm-4">
                           <label for="">Dari</label>
                           <input type="date" name="dari" class="form-control" id="">
                        </div>
                        <div class="col-sm-4">
                           <label for="">Sampai</label>
                           <input type="date" name="sampai" class="form-control" id="">
                        </div>
                        <div class="col-sm-2" style="display:inline;margin-top:30px;">
                           <input type="submit" class="btn btn-default btn-flat" value="Submit">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-6">
            <div class="card card-outline card-primary">
               <div class="card-header">
                  Laporan pegawai
               </div>
               <div class="card-body">
                  <form action="{{ route('admin.laporan.cekPegawai') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-sm-4">
                           <label for="">Dari</label>
                           <input type="date" name="dari" class="form-control" id="">
                        </div>
                        <div class="col-sm-4">
                           <label for="">Sampai</label>
                           <input type="date" name="sampai" class="form-control" id="">
                        </div>
                        <div class="col-sm-2" style="display:inline;margin-top:30px;">
                           <input type="submit" class="btn btn-default btn-flat" value="Submit">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>

         <div class="col-lg-6">
            <div class="card card-outline card-warning">
               <div class="card-header">
                  Laporan umum
               </div>
               <div class="card-body">
                  <form action="{{ route('admin.laporan.cekUmum') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-sm-4">
                           <label for="">Dari</label>
                           <input type="date" name="dari" class="form-control" id="">
                        </div>
                        <div class="col-sm-4">
                           <label for="">Sampai</label>
                           <input type="date" name="sampai" class="form-control" id="">
                        </div>
                        <div class="col-sm-2" style="display:inline;margin-top:30px;">
                           <input type="submit" class="btn btn-default btn-flat" value="Submit">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
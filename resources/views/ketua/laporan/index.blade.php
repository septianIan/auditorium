@extends('template.ui')
@section('title', 'Laporan peminjaman')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">Laporan peminjaman</li>
</ol>
@endsection

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="card card-primary card-outline">
               <div class="card-body">
                  <form action="{{ route('ketua.laporan.cekPeminjaman') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-sm-4">
                           <label for="">Dari</label>
                           <input type="date" name="form" class="form-control" id="">
                        </div>
                        <div class="col-sm-4">
                           <label for="">Sampai</label>
                           <input type="date" name="to" class="form-control" id="">
                        </div>
                        <div class="col-sm-2" style="display:inline;margin-top:30px;">
                           <input type="submit" class="btn btn-default btn-flat" value="Submit">
                        </div>
                     </div>
                  </form>
               </div>

               <div class="col-12 table-responsive">
                  @if(isset($mahasiswa, $pegawai, $umum))
                     <table class="table table-bordered table-striped">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Nomor Identitas</th>
                              <th>Nama</th>
                              <th>Alamat</th>
                              <th>Tgl Pinjam</th>
                              <th>Jam</th>
                              <th>No Telpon</th>
                              <th>Email</th>
                              <th>Status peminjam</th>
                           </tr>
                        </thead>
                        <tbody style="font-size:12px;">
                           @php
                              $no = 1;
                           @endphp
                           @foreach($mahasiswa as $v)
                              <tr>
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $v->mahasiswa->nim }}</td>
                                 <td>{{ $v->mahasiswa->nama }}</td>
                                 <td>{{ $v->mahasiswa->alamat }}</td>
                                 <td>{{ $v->getFormatTgl() }}</td>
                                 <td>{{ $v->getDariSampai() }}</td>
                                 <td>{{ $v->noTelp }}</td>
                                 <td>{{ $v->email }}</td>
                                 <td>Mahasiswa</td>
                              </tr>
                           @endforeach
                           @foreach($pegawai as $v)
                              <tr>
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $v->pegawai->nik }}</td>
                                 <td>{{ $v->pegawai->nama }}</td>
                                 <td>{{ $v->pegawai->alamat }}</td>
                                 <td>{{ $v->getFormatTgl() }}</td>
                                 <td>{{ $v->getDariSampai() }}</td>
                                 <td>{{ $v->noTelp }}</td>
                                 <td>{{ $v->email }}</td>
                                 <td>Pegawai</td>
                              </tr>
                           @endforeach
                           @foreach($umum as $v)
                              <tr>
                                 <td>{{ $no++ }}</td>
                                 <td>{{ $v->nik }}</td>
                                 <td>{{ $v->nama }}</td>
                                 <td>{{ $v->alamat }}</td>
                                 <td>{{ $v->getFormatTgl() }}</td>
                                 <td>{{ $v->getDariSampai() }}</td>
                                 <td>{{ $v->noTelp }}</td>
                                 <td>{{ $v->email }}</td>
                                 <td>Umum</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cetak laporan</title>
   @include('template.components.style')
</head>
<body>
   <div class="wrapper">
      <section class="invoice">
         <div class="row">
         <div class="col-12">
         <h2 class="page-header">
            <i class="fas fa-globe"></i> Auditorium Universitas Muhammadyah Malang.
            <small class="float-right">Tanggal: {{ date('d-M-Y') }}</small>
         </h2>
         </div>
         <!-- /.col -->
      </div>
         <div class="row">
            <div class="col-12">
               <div class="invoice p-3 mb-3">
                  <div class="row">
                     <div class="col-12">
                        <h4><i class="fa fa-info-circle"></i>&nbsp;Detail Peminjaman <b>{{ $peminjam->room->ruang }}</b></h4>
                     </div>
                  </div>
                  <div class="row invoice-info">
                     <div class="col-3 invoice-col">
                        <address>
                           Nama : {{ $peminjam->pegawai->nama }} <br>
                           Nim : {{ $peminjam->pegawai->nik }} <br>
                           Fakultas : {{ $peminjam->pegawai->fakultas }} <br>
                           Jurusan : {{ $peminjam->pegawai->jurusan }}<br>
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
                        <table class="table table-striped">
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
               </div>
            </div>
         </div>
      </section>
   </div>
   @include('template.components.script')
</body>
<script>
   window.addEventListener("load", window.print());
</script>
</html>
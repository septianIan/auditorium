<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cetak laporan peminjam umum</title>
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
                        Laporan Peminjaman {{ $dari }} - {{ $sampai }}
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 table-responsive">
                        <table class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Nik</th>
                                 <th>Nama</th>
                                 <th>Alamat</th>
                                 <th>Tgl Pinjam</th>
                                 <th>Jam</th>
                                 <th>No Telpon</th>
                                 <th>Email</th>
                              </tr>
                           </thead>
                           <tbody style="font-size:12px;">
                              @php
                                 $no = 1;
                              @endphp
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
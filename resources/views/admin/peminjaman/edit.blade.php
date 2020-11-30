@extends('template.ui')
@section('title', 'Edit Peminjam')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="">Home</a></li>
   <li class="breadcrumb-item active"><a href="{{ route('admin.peminjaman.index') }}">Data peminjam</a></li>
   <li class="breadcrumb-item active">Edit peminjaman</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-6">
      <form action="{{ route('admin.peminjaman.update', $peminjam->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')

      <input type="hidden" id="mahasiswa_id" name="mahasiswa_id" value="{{ $peminjam->mahasiswa_id }}">
         <div class="card card-primary">
            <div class="card-header">
               <h3 class="card-title">Form Peminjaman</h3>
            </div>
            <div class="card-body">
            @if(session('message'))
               <div div id="notif" class="alert alert-info">{{ session('message') }}</div>
            @endif
            <div id="notification" style="font-weight:bold;"></div>
               <div class="row">
                  <div class="col-sm-6">
                     <label for="">Nim</label>
                     <input type="number" name="nim" id="nim" value="{{ $peminjam->mahasiswa->nim }}" class="form-control @error('nim') is-invalid @enderror" autocomplete="off">
                     @error('nim')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Nama</label>
                     <input type="text" name="nama" value="{{ $peminjam->mahasiswa->nama }}" id="nama" class="form-control @error('nama') is-invalid @enderror">
                     @error('nama')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <label for="">No telp</label>
                     <input type="number" name="noTelp" value="{{ $peminjam->noTelp }}" id="noTelp" class="form-control @error('noTelp') is-invalid @enderror" autocomplete="off">
                     @error('noTelp')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Email</label>
                     <input type="text" name="email" value="{{ $peminjam->email }}" id="email" class="form-control">
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <label for="">Fakultas</label>
                     <input type="text" name="fakultas" value="{{ $peminjam->mahasiswa->fakultas }}" id="fakultas" class="form-control @error('fakultas') is-invalid @enderror" autocomplete="off">
                     @error('fakultas')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Jurusan</label>
                     <input type="text" name="jurusan" value="{{ $peminjam->mahasiswa->jurusan }}" id="jurusan" class="form-control @error('jurusan') is-invalid @enderror">
                     @error('jurusan')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <label for="">Tanggal pinjam</label>
                     <input type="date" name="tglPinjam" id="tglPinjam" value="{{ $peminjam->tglPinjam }}" class="form-control @error('tglPinjam') is-invalid @enderror">
                     @error('tglPinjam')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Upload surat izin</label>
                     <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                     @error('image')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <label for="">Dari jam</label>
                     <input type="time" name="dariJam" value="{{ $peminjam->dariJam }}" class="form-control @error('dariJam') is-invalid @enderror">
                     @error('dariJam')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Sampai jam</label>
                     <input type="time" name="sampaiJam" value="{{ $peminjam->sampaiJam }}" class="form-control @error('sampaiJam') is-invalid @enderror">
                     @error('sampaiJam')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <label for="">Kegiatan</label>
                     <textarea name="kegiatan" id="" cols="4" rows="4" class="form-control @error('kegiatan') is-invalid @enderror">{{ $peminjam->kegiatan }}</textarea>
                     @error('kegiatan')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-block btn-primary btn-flat">Simpan</button>
            </div>
         </div>
      </form>
      </div>

      <div class="col-md-6">
         <div class="card card-primary">
            <div class="card-header">
               Detail Auditorium
               <a href="#" class="tambahFasilitas px-1"><i class="fa fa-plus px-1"></i>Tambah fasilitas</a>
            </div>
            <form action="{{ route('admin.editFasilitas.mahasiswa') }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" id="idPeminjam" name="idPeminjam" value="{{ $peminjam->id }}">
               <div class="card-body">
                  <label for="">Nama Ruang</label>
                  <select name="room" class="form-control @error('room') is-invalid @enderror" id="">
                     <option value="{{ $peminjam->room_id }}">{{ $peminjam->room->ruang }}</option>
                  </select>
                  
                  <label for="">Fasilitas</label>
                     <div class="row tambahRowFasilitas">
                     @foreach($peminjam->fasilitas as $value)
                        <div class="col-sm-6">
                           <input type="hidden" value="{{ $value->id }}" name="idRuangFasilitas[]">
                           <input type="text" class="form-control mt-2" value="{{ $value->fasilitas }}" name="fasilitas[]" readonly>
                        </div>
                        <div class="col-sm-2">
                           <input type="number" class="form-control mt-2 jumlah" placeholder="Jumlah ..." value="{{ $value->jumlah }}" id="jumlah{{ $loop->iteration }}" name="jumlah[]">
                        </div>
                        <div class="col-sm-2">
                           <font style="font-size:14px;">Stok : {{ $value->jumlah }}</font>
                        </div>
                        <div class="col-sm-2 mt-2" style="display:inline;">
                           @if($peminjam->status == 1)
                              <a href="#" class="btn btn-danger removeFasilitas" data-id="{{ $value->id }}"><i class="fa fa-trash"></i></a>
                           @else
                           
                           @endif
                        </div>
                     @endforeach
                     </div>
                  </select>
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-block btn-primary btn-flat">Simpan</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@push('styles')
<!--- Sweet alert -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')

<!-- Sweet alert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
   $(function() {
      $('.multiSelect').select2({
         theme: 'bootstrap4'
      })
   })

   $(document).ready(function(){
      $("#nim").change(function(){
         var nim = $(this).val();
         $.ajax({
            type: "POST",
            url: "{{ route('admin.cariNim.data') }}",
            data: {
               "_token": "{{ csrf_token() }}",
               'nim':nim
            },
            beforeSend: function(){
               $("#nim").css("background","#FFF url({{ asset('assets/gif/loading3.gif') }}) no-repeat 115px");
            },
            dataType: 'json',
            success : function(data) {
               $('#nama').val(data.nama);
               $('#fakultas').val(data.fakultas);
               $('#jurusan').val(data.jurusan);
               $('#noTelp').val(data.noTelp);
               $('#email').val(data.email);
               $('#mahasiswa_id').val(data.id);
               $('#nim').css("background","#FFF");
            },
            error: function(jqXHR, textStatus, errorThrown) {}
         });
      });

      //
      $('#tglPinjam').change(function(){
         var tglPinjam = $(this).val();
         $.ajax({
            type: "POST",
            url: "{{ route('admin.cariTglPinjam.data') }}",
            data: {
               "_token": "{{ csrf_token() }}",
               'tglPinjam': tglPinjam
            },
            beforeSend: function(){
               $("#nim").css("background","#FFF url({{ asset('assets/gif/loading3.gif') }}) no-repeat 115px");
            },
            dataType: "json",
            success: function(data){
               if(data.success === true){
                  $('#notification').addClass('alert alert-warning');
                  $('#notification').html(data.message);
                  $('#nim').css("background","#FFF");
                  getResetTglPinjam();
               } else if(data.success === false){
                  $('#notification').addClass('alert alert-warning');
                  $('#notification').html(data.message);
                  $('#nim').css("background","#FFF");
               }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
         });
      });

      function getResetTglPinjam()
      {
         $('#tglPinjam').val('');
      } 
   });
   //BATAS

   $('.removeFasilitas').live('click', function() {
      if (confirm('Yakin dihapus?')) {
         let id = $(this).data("id");
         $.ajax({
            type: "GET"
            , url: "/administator/peminjaman/hapusFasilitas/" + id
            , data: {
               "id": id
               , "_method": 'DELETE'
               , "_token": "{{ csrf_token() }}"
            },

            success: function(data) {
               alert('Fasilitas berhasil di hapus');
               location.reload(true);      
            }
         });
      } else {
         return false
      }
   });

   $('#notif').fadeTo(2000, 500).slideUp(500, function(){
         $('#notif').slideUp(500);
   });

   $('.tambahFasilitas').on('click', function(){
      tambahFasilitas();
   });

   function tambahFasilitas() {
      let row = `
         <div class="col-sm-6 mt-2" id="1">
            <select class="form-control" id="relJumlah" name="fasilitas[]">
               <option></option>
               @foreach($relRuangFasilitas as $rel)
                  <option value="{{ $rel->fasilitas }}">{{ $rel->fasilitas }}</option>
               @endforeach
            </select>
         </div>
         <div class="col-sm-3 mt-2" id="2">
            <input type="number" class="form-control id="jumlah" mt-2 jumlah" placeholder="Jumlah ..." value="" name="jumlah[]">
         </div>
         <div class="col-sm-2 mt-2" id="3" style="display:inline;">
            <a href="#" class="btn btn-danger remove">X</a>
         </div>
      `;
      $('.tambahRowFasilitas').append(row);
   };

   $('.remove').live('click', function() {
      $('#1').remove();
      $('#2').remove();
      $('#3').remove();
   });
</script>
@endpush
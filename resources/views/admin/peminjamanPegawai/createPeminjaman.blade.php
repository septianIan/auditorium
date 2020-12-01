@extends('template.ui')
@section('title', 'Detail auditorium')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('admin.auditorium.index') }}">Data auditorium</a></li>
   <li class="breadcrumb-item active">Detail auditorium</li>
</ol>
@endsection

@section('content')
<form action="{{ route('admin.pegawai.store') }}" method="post" enctype="multipart/form-data">
@csrf

<input type="hidden" name="pegawai_id" id="id">

<div class="container">
   <div class="row">
      <div class="col-md-6">
         <div class="card card-success">
            <div class="card-header">
               <h3 class="card-title">Form Peminjaman pegawai</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="card-body">
            @if(session('pesan'))
               <div id="notif" class="alert alert-success">{{ session('pesan') }}</div>
            @endif
            <div id="notification" style="font-weight:bold;"></div>
               <div class="row">
                  <div class="col-sm-6">
                     <label for="">Nik</label>
                     <input type="number" name="nik" id="nik" value="{{ old('nik') }}" class="form-control @error('nik') is-invalid @enderror" autofocus autocomplete="off">
                     @error('nik')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Nama</label>
                     <input type="text" name="nama" value="{{ old('nama') }}" id="nama" class="form-control @error('nama') is-invalid @enderror">
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
                     <input type="number" name="noTelp" value="{{ old('noTelp') }}" id="noTelp" class="form-control @error('noTelp') is-invalid @enderror" autocomplete="off">
                     @error('noTelp')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Email</label>
                     <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <label for="">Alamat</label>
                     <textarea name="alamat" id="alamat" cols="4" rows="4" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                     @error('alamat')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <label for="">Tanggal pinjam</label>
                     <input type="date" name="tglPinjam" id="tglPinjam" value="{{ old('tglPinjam') }}" class="form-control @error('tglPinjam') is-invalid @enderror">
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
                     <input type="time" name="dariJam" value="{{ old('dariJam') }}" class="form-control @error('dariJam') is-invalid @enderror">
                     @error('dariJam')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                     <label for="">Sampai jam</label>
                     <input type="time" name="sampaiJam" value="{{ old('sampaiJam') }}" class="form-control @error('sampaiJam') is-invalid @enderror">
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
                     <textarea name="kegiatan" id="" cols="4" rows="4" class="form-control @error('kegiatan') is-invalid @enderror">{{ old('kegiatan') }}</textarea>
                     @error('kegiatan')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-block btn-success btn-flat">Simpan</button>
            </div>
         </div>
      </div>

      <div class="col-md-6">
         <div class="card card-success card-tabs">
            <div class="card-header">
               Detail Auditorium
            </div>
            <div class="card-body">
               <label for="">Nama Ruang</label>
               <select name="room_id" class="form-control @error('room') is-invalid @enderror" id="">
                  <option value="{{ $room->id }}">{{ $room->ruang }}</option>
               </select>
               <input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
               <label for="">Fasilitas</label>
               
               
               @foreach($room->fasilitas as $value)
                  <div class="row" id="xyz">
                     <div class="col-sm-6">
                        <input type="hidden" value="{{ $value->id }}" name="idRuangFasilitas[]">
                        <input type="text" class="form-control mt-2 fasilitasAuditorium" value="{{ $value->fasilitas }}" data-posttd="{{ $loop->iteration }}" name="fasilitas[]">
                     </div>
                     <div class="col-sm-2" id="jumlah_{{ $loop->iteration }}">
                        <input type="number" class="form-control mt-2 jumlah" placeholder="Jumlah ..." value="{{ $value->jumlah }}" onchange="stok()" name="jumlah[]">
                     </div>
                     <div class="col-sm-2" id="checkboxes">
                        <input type="checkbox" class="form-control check_list mt-2" value="{{ $value->fasilitas }}" name="fasilitas[]" required>
                     </div>
                  </div>
                  @endforeach
                  <hr>
                  <div class="row">
                     <div class="col-sm-8">
                        <label for="">Check List All</label>
                     </div>
                     <div class="col-sm-2">
                        <input type="checkbox" id="checkall" class="form-control" >
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>
</form>
@endsection

@push('styles')
<!--- Sweet alert -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
@endpush

@push('scripts')

<!-- Sweet alert -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
   $(document).ready(function(){
      $("#nik").change(function(){
         var nik = $(this).val();
         $.ajax({
            type: "POST",
            url: "{{ route('admin.cariNik.data') }}",
            data: {
               "_token": "{{ csrf_token() }}",
               'nik':nik
            },
            beforeSend: function(){
               $("#nik").css("background","#FFF url({{ asset('assets/gif/loading3.gif') }}) no-repeat 115px");
            },
            dataType: 'json',
            success : function(data) {
               if(data.success === true){
                  $('#id').val(data.pegawai.id);
                  $('#nama').val(data.pegawai.nama);
                  $('#alamat').val(data.pegawai.alamat);
                  $('#noTelp').val(data.pegawai.noTelp);
                  $('#email').val(data.pegawai.email);
                  $('#notification').addClass('alert alert-success');
                  $('#notification').html(data.message);
                  $('#nik').css("background","#FFF");
               } else if(data.success === false){
                  $('#notification').addClass('alert alert-success');
                  $('#notification').html(data.message);
                  getResetNik();
                  $('#nik').css("background","#FFF");
               }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
         });
      });

      //
      $('#tglPinjam').change(function(){
         var tglPinjam = $(this).val();
         var room_id = $('#room_id').val();
         $.ajax({
            type: "POST",
            url: "{{ route('admin.cariTglPinjam.data') }}",
            data: {
               "_token": "{{ csrf_token() }}",
               'tglPinjam': tglPinjam,
               'room_id': room_id
            },
            beforeSend: function(){
               $("#nim").css("background","#FFF url({{ asset('assets/gif/loading3.gif') }}) no-repeat 115px");
            },
            dataType: "json",
            success: function(data){
               if(data.success === true){
                  $('#notification').addClass('alert alert-success');
                  $('#notification').html(data.message);
                  $('#nim').css("background","#FFF");
                  getResetTglPinjam();
               } else if(data.success === false){
                  $('#notification').addClass('alert alert-success');
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

      function getResetNik()
      {
         $('#nik').val('');
      }

      //notif
      $('#notif').fadeTo(2000, 500).slideUp(500, function(){
            $('#notif').slideUp(500);
      })
   });

   $("#checkall").click(function(){
      $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

   });
</script>
@endpush
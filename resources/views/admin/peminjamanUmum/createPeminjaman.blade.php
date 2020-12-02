@extends('template.ui')
@section('title', 'Detail auditorium umum')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('admin.auditorium.index') }}">Data auditorium</a></li>
   <li class="breadcrumb-item active">Detail auditorium umum</li>
</ol>
@endsection

@section('content')
<form action="{{ route('admin.umum.store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="container">
   <div class="row">
      <div class="col-md-6">
         <div class="card card-warning">
            <div class="card-header">
               <h3 class="card-title">Form Peminjaman umum</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="card-body">
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
               <button type="submit" class="btn btn-block btn-warning btn-flat">Simpan</button>
            </div>
         </div>
      </div>

      <div class="col-md-6">
         <div class="card card-warning card-tabs">
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
                  <div class="row" id="hapus_{{ $loop->iteration }}">
                     <div class="col-sm-6">
                        <input type="hidden" value="{{ $value->id }}" name="idRuangFasilitas[]">
                        <input type="text" class="form-control mt-2 fasilitasAuditorium" value="{{ $value->fasilitas }}" data-id="{{ $loop->iteration }}" name="" readonly>
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
            dataType: "json",
            success: function(data){
               if(data.success === true){
                  $('#notification').addClass('alert alert-warning');
                  $('#notification').html(data.message);
                  getResetTglPinjam();
               } else if(data.success === false){
                  $('#notification').addClass('alert alert-warning');
                  $('#notification').html(data.message);
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

   $("#checkall").click(function(){
      $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

   });
</script>
@endpush
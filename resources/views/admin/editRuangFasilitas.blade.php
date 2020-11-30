@extends('template.ui')
@section('title', 'Edit kelola ruang')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="{{ route('admin.kelolaRuang.index') }}">Data kelola ruang</a></li>
   <li class="breadcrumb-item active">Edit kelola ruang</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-primary">
            <div class="card-header">
               <h3 class="card-title">Edit kelola ruang</h3>
            </div>
               <div class="card-body">
               @if(session('pesanHapusFasilitas'))
                  <div  div id="notif" class="alert alert-info">{{ session('pesanHapusFasilitas') }}</div>
               @endif
                  <form action="{{ route('admin.kelolaRuang.update', $room->id) }}" method="post">
                     @csrf
                     @method('put')
                     <label for="">Nama Ruang</label>
                     <select name="room" class="form-control @error('room') is-invalid @enderror" id="">
                        <option value="{{ $room->id }}">{{ $room->ruang }}</option>
                     </select>

                     @error('room')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror

                     <label for="">Fasilitas</label>
                     @foreach($room->fasilitas as $value)
                     
                        <div class="row">
                           <div class="col-sm-6">
                              <input type="hidden" value="{{ $value->id }}" name="idRuangFasilitas[]">
                              <input type="text" class="form-control mt-2" value="{{ $value->fasilitas }}" name="fasilitas[]">
                           </div>
                           <div class="col-sm-4">
                              <input type="number" class="form-control mt-2" placeholder="Jumlah ..." value="{{ $value->jumlah }}" name="jumlah[]">
                           </div>
                           <div class="col-sm-2 mt-2" style="display:inline;">
                              <a href="#" class="btn btn-danger removeFasilitas" data-id="{{ $value->id }}">X</a>
                           </div>
                        </div>
                     
                     @endforeach
                     </select>

                     @error('fasilitas')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                  </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card card-success">
            <div class="card-header">
               Tambah fasilitas
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
               </div>
            </div>
            <form action="{{ route('admin.kelolaRuang.store') }}" method="post">
            @csrf
               <div class="card-body">
                     <div class="row">
                        <div class="col-md-6">
                           <label for="">Nama Ruang</label>
                           <select name="room" class="form-control @error('room') is-invalid @enderror" id="">
                              <option value="{{ $room->id }}">{{ $room->ruang }}</option>
                           </select>
                        </div>
                        <div class="col-md-6">
                           <label for="">Fasilitas</label>
                           <select name="fasilitas[]" class="form-control @error('fasilitas') is-invalid @enderror multiSelect" id="" multiple>
                              <option value=""></option>
                              @foreach($fasilitas as $v)
                                 <option value="{{ $v->fasilitas }}" @if($room->fasilitas->contains($v))
                                       selected="selected"
                                 @endif>{{ $v->fasilitas }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-success">Simpan</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
   $(function() {
      $('.multiSelect').select2({
         theme: 'bootstrap4'
      })
   });

   $('#notif').fadeTo(2000, 500).slideUp(500, function(){
         $('#notif').slideUp(500);
   });

   $('.removeFasilitas').live('click', function() {
      if (confirm('Yakin dihapus?')) {
         let id = $(this).data("id");
         $.ajax({
            type: "GET"
            , url: "/administator/kelolaRuang/hapusFasilitas/" + id
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
</script>
@endpush

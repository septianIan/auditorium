@extends('template.ui')
@section('title', 'Create kelola ruang')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item"><a href="{{ route('admin.kelolaRuang.index') }}">Data kelola ruang</a></li>
   <li class="breadcrumb-item active">Create kelola ruang</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-primary">
            <div class="card-header">
               <h3 class="card-title">Create kelola ruang</h3>
            </div>
            <form action="{{ route('admin.kelolaRuang.store') }}" method="post">
            @csrf
               <div class="card-body">
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
                  <select name="fasilitas[]" class="form-control @error('fasilitas') is-invalid @enderror multiSelect" id="" multiple>
                     <option value=""></option>
                     
                     @if(count($room->fasilitas) <= 0)
                        @foreach($fasilitas as $v)
                        <option value="{{ $v->fasilitas }}">{{ $v->fasilitas }}</option>
                        @endforeach
                     @else
                        @foreach($room->fasilitas as $v)
                        <option value="{{ $v->fasilitas }}" @if($room->fasilitas->contains($v))
                           selected="selected"
                        @endif>{{ $v->fasilitas }}</option>
                        @endforeach
                     @endif

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
   })
</script>
@endpush

@extends('template.ui')
@section('title', 'Edit data pegawai')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('admin.pegawai.index') }}">Data pegawai</a></li>
</ol>
@endsection
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-success">
               <div class="card-header">
                  <h3 class="card-title">Edit data pegawai</h3>
               </div>
               <div class="card-body">
                  <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="post">
                  @csrf
                  @method('put')
                     <label for="">Nik</label>
                     <input type="number" name="nik" value="{{ $pegawai->nik }}" class="form-control @error('nik') is-invalid @enderror" placeholder="Nik ...">
                     @error('nik')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                     <label for="">Nama</label>
                     <input type="text" name="nama" value="{{ $pegawai->nama }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama ...">
                     @error('nama')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Alamat</label>
                     <input type="text" name="alamat" value="{{ $pegawai->alamat }}" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat ...">
                     @error('alamat')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">No Telp</label>
                     <input type="number" name="noTelp" value="{{ $pegawai->noTelp }}" class="form-control @error('noTelp') is-invalid @enderror" placeholder="No Telpon ...">
                     @error('noTelp')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Email</label>
                     <input type="email" name="email" value="{{ $pegawai->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email ...">
                     @error('email')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <button class="btn btn-success btn-flat mt-3">
                        Simpan
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
@extends('template.ui')
@section('title', 'Edit data mahasiswa')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active"><a href="{{ route('admin.mahasiswa.index') }}">Data mahasiswa</a></li>
</ol>
@endsection
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card card-primary">
               <div class="card-header">
                  <h3 class="card-title">Edit data mahasiswa</h3>
               </div>
               <div class="card-body">
                  <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="post">
                  @csrf
                  @method('put')
                     <label for="">Nim</label>
                     <input type="number" name="nim" value="{{ $mahasiswa->nim }}" class="form-control @error('nim') is-invalid @enderror" placeholder="Nim ...">
                     @error('nim')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                     <label for="">Nama</label>
                     <input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama ...">
                     @error('nama')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Fakultas</label>
                     <input type="text" name="fakultas" value="{{ $mahasiswa->fakultas }}" class="form-control @error('fakultas') is-invalid @enderror" placeholder="Fakultas ...">
                     @error('fakultas')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Jurusan</label>
                     <input type="text" name="jurusan" value="{{ $mahasiswa->jurusan }}" class="form-control @error('jurusan') is-invalid @enderror" placeholder="Jurusan ...">
                     @error('jurusan')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Alamat</label>
                     <input type="text" name="alamat" value="{{ $mahasiswa->alamat }}" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat ...">
                     @error('alamat')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">No Telp</label>
                     <input type="number" name="noTelp" value="{{ $mahasiswa->noTelp }}" class="form-control @error('noTelp') is-invalid @enderror" placeholder="No Telpon ...">
                     @error('noTelp')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <label for="">Email</label>
                     <input type="email" name="email" value="{{ $mahasiswa->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email ...">
                     @error('email')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror

                     <button class="btn btn-primary btn-flat mt-3">
                        Simpan
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
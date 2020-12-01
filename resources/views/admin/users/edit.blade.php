@extends('template.ui')
@section('title', 'Edit user')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
   <li class="breadcrumb-item active">Edit user</li>
</ol>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-md-8">
         <div class="card card-primary">
            <div class="card-header">
               <h3 class="card-title">Edit user</h3>
            </div>
            <div class="card-body">
               <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                  @csrf
                  @method('put')
                  <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                           <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                           @error('name')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                  </div>

                  <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                           @error('email')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                  </div>

                  <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                           @error('password')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                           <strong class="text-warning">Biarkan kosong, kalau tidak ganti password</strong>
                        </div>
                  </div>

                  <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                           <button type="submit" class="btn btn-primary btn-flat">
                              {{ __('Register') }}
                           </button>
                        </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="col-sm-2"></div>
   </div>
</div>
@endsection
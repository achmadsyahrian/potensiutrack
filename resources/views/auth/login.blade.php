@extends('layouts.app')
@section('content')
<div class="container container-normal py-8 mt-4">
   <div class="row align-items-center g-4">
      <div class="col-lg">
         <div class="container-tight">
            <div class="text-center mb-4">
               <a href="." class="navbar-brand navbar-brand-autodark h3"><img
                     src="{{ asset('image/Logopotensiutama.png') }}" height="36" alt=""> Universitas Potensi Utama</a>
            </div>
            <div class="card card-md">
               <div class="card-body">
                  <h2 class="h2 text-center mb-4">Masuk ke akunmu</h2>
                  <form action="{{ route('login') }}" method="post" autocomplete="off">
                     @csrf
                     <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="mb-3">
                           <input type="text" class="form-control @error('username') is-invalid border-danger @enderror"
                              name="username" placeholder="Username" value="{{ old('username') }}">
                           <x-invalid-feedback field='username'></x-invalid-feedback>
                        </div>
                     </div>
                     <div class="mb-2">
                        <label class="form-label">
                           Password
                        </label>
                        <div class="input-group input-group-flat">
                           <input id="password-input" type="password" name="password" class="form-control @error('password') is-invalid border-danger @enderror"
                              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                              autocomplete="off">
                           <span class="input-group-text @error('password') border-danger is-invalid @enderror">
                              <a href="" class="link-secondary" title="Lihat password" id="show-password-toggle"
                                 data-bs-toggle="tooltip">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path
                                       d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                 </svg>
                              </a>
                           </span>
                           <x-invalid-feedback field='password'></x-invalid-feedback>
                        </div>
                     </div>
                     <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg d-none d-lg-block">
         <img src="./static/illustrations/undraw_secure_login_pdn4.svg" height="300" class="d-block mx-auto" alt="">
      </div>
   </div>
</div>

@if (session()->has('error'))
   <x-notify head='Gagal!' type="danger" body="{{ session('error') }}"></x-notify>
@elseif (session()->has('success'))
   <x-notify head='Berhasil!' type="success" body="{{ session('success') }}"></x-notify>
@endif

@endsection
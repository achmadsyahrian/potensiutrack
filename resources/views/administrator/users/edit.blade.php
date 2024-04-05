@extends('layouts.app')
@section('content')

@include('components.notification-handler')
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               <ol class="breadcrumb breadcrumb-arrows">
                  <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Akun</a></li>
                  <li class="breadcrumb-item active"><a href="#">Edit</a></li>
               </ol>
            </div>
            <h2 class="page-title">
               Potensi Utama Track
            </h2>
         </div>
      </div>
   </div>
</div>
<!-- Page body -->
<div class="page-body">
   <div class="container-xl">
      <div class="card">
         <div class="row row-deck row-cards">
            <form action="{{ route('users.update', ['user' => $user]) }}" method="post" enctype="multipart/form-data">
               @csrf
               @method('put')
               <div class="col d-flex flex-column">
                  <div class="card-body">
                     <h2 class="mb-4">Data Akun</h2>
                     {{-- <h3 class="card-title">Detail Akun</h3> --}}
                     <div class="row align-items-center">
                        <div class="col-auto">
                           @if (!$user->photo)
                           <span class="avatar avatar-xl"
                              style="background-image: url({{ asset('image/avatar/defaul-profile.jpg') }})"></span>
                           @else
                           <span class="avatar avatar-xl"
                              style="background-image: url({{ asset('storage/' . $user->photo) }})"></span>
                           @endif
                        </div>
                        <div class="col-auto mt-4">
                           <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" class="form-control @error('photo') is-invalid @enderror">
                           <x-invalid-feedback field='photo'></x-invalid-feedback>
                        </div>
                     </div>
                     <div class="row g-3 mt-4">
                        <div class="col-md">
                           <div class="form-label required">Nama</div>
                           <input type="text" placeholder="Masukkan nama"
                              class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"
                              name="name" autocomplete='off'>
                           <input type="hidden"
                              class="form-control" value="{{ $user->id }}"
                              name="id">
                           <x-invalid-feedback field='name'></x-invalid-feedback>
                        </div>
                        <div class="col-md">
                           <div class="form-label required">Username</div>
                           <input type="text" placeholder="Masukkan username"
                              class="form-control @error('username') is-invalid @enderror"
                              value="{{ $user->username }}" name="username" autocomplete='off'>
                           <x-invalid-feedback field='username'></x-invalid-feedback>
                        </div>
                        <div class="col-md">
                           <div class="form-label">No. Handphone</div>
                           <input type="text" placeholder="Masukkan nomor"
                              class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone}}"
                              name="phone" autocomplete='off'>
                           <x-invalid-feedback field='phone'></x-invalid-feedback>
                        </div>
                     </div>
                     <h3 class="card-title mt-4">Email</h3>
                     <p class="card-subtitle">Harap masukkan alamat email yang valid.</p>
                     <div>
                        <div class="row g-2">
                           <div class="col-md">
                              <input type="text" placeholder="Masukkan email"
                                 class="form-control @error('email') is-invalid @enderror"
                                 value="{{ $user->email}}" name="email" autocomplete='off'>
                              <x-invalid-feedback field='email'></x-invalid-feedback>
                           </div>
                        </div>
                     </div>
                     <h3 class="card-title mt-4">Kata Sandi</h3>
                     <p class="card-subtitle">Kosongkan jika tidak ingin mengubahnya.</p>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="input-group input-group-flat">
                              <input id="password-input" type="password" name="password" class="form-control @error('password') is-invalid border-danger @enderror"
                                 placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                 autocomplete="off">
                              <span class="input-group-text @error('password') border-danger is-invalid @enderror">
                                 <a href="" class="link-secondary" title="Lihat password" id="show-password-toggle"
                                    data-bs-toggle="tooltip">
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
                     </div>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                     <div class="btn-list justify-content-end">
                        <a href="{{ route('users.index') }}" class="btn">
                           Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                           Simpan
                        </button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
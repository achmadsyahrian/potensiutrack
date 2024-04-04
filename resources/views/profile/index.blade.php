@extends('layouts.app')
@section('content')

@if (session()->has('error'))
   <x-notify head='Gagal!' type="danger" body="{{ session('error') }}"></x-notify>
@elseif (session()->has('success'))
   <x-notify head='Berhasil!' type="success" body="{{ session('success') }}"></x-notify>
@endif

<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <h2 class="page-title">
               Pengaturan Akun
            </h2>
         </div>
      </div>
   </div>
</div>
<!-- Page body -->
<div class="page-body">
   <div class="container-xl">
      <div class="card">
         <div class="row g-0">
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
               @csrf
               @method('put')
               <div class="col d-flex flex-column">
                  <div class="card-body">
                     <h2 class="mb-4">Akun Saya</h2>
                     <h3 class="card-title">Detail Akun</h3>
                     <div class="row align-items-center">
                        <div class="col-auto">
                           @if (!Auth::user()->photo) 
                              <span class="avatar avatar-xl" style="background-image: url({{ asset('image/avatar/defaul-profile.jpg') }})"></span> 
                           @else
                              <span class="avatar avatar-xl" style="background-image: url({{ asset('storage/' . Auth::user()->photo) }})"></span> 
                           @endif
                        </div>
                        <div class="col-auto mt-4">
                           <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" class="form-control @error('photo') is-invalid @enderror">
                           <x-invalid-feedback field='photo'></x-invalid-feedback>
                        </div>
                        @if (Auth::user()->photo)
                           <div class="col-auto">
                              <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-confirm-{{ Auth::id() }}">
                                 Hapus foto
                               </a>
                           </div>
                        @endif
                     </div>
                     <div class="row g-3 mt-4">
                        <div class="col-md">
                           <div class="form-label required">Nama</div>
                           <input type="text" placeholder="Masukkan nama" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" name="name">
                           <x-invalid-feedback field='name'></x-invalid-feedback>
                        </div>
                        <div class="col-md">
                           <div class="form-label required">Username</div>
                           <input type="text" placeholder="Masukkan username" class="form-control @error('username') is-invalid @enderror" value="{{ Auth::user()->username }}" name="username">
                           <x-invalid-feedback field='username'></x-invalid-feedback>
                        </div>
                        <div class="col-md">
                           <div class="form-label">No. Handphone</div>
                           <input type="text" placeholder="Masukkan nomor" class="form-control @error('phone') is-invalid @enderror" value="{{ Auth::user()->phone}}" name="phone">
                           <x-invalid-feedback field='phone'></x-invalid-feedback>
                        </div>
                     </div>
                     <h3 class="card-title mt-4">Email</h3>
                     <p class="card-subtitle">Harap masukkan alamat email yang valid.</p>
                     <div>
                        <div class="row g-2">
                           <div class="col-md">
                              <input type="text" placeholder="Masukkan email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email}}" name="email">   
                              <x-invalid-feedback field='email'></x-invalid-feedback>
                           </div>
                        </div>
                     </div>
                     <h3 class="card-title mt-4">Kata Sandi</h3>
                     <p class="card-subtitle">Anda dapat menetapkan kata sandi permanen jika Anda tidak ingin menggunakan kode login sementara.</p>
                     <div>
                        <a href="{{ route('profile.editpassword') }}" class="btn">
                           Buat kata sandi baru
                        </a>
                     </div>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                     <div class="btn-list justify-content-end">
                        <button type="reset" class="btn">
                           Batal
                        </button>
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

{{-- Modal Confirm --}}
<x-confirm-modal route="{{ route('profilephoto.delete') }}" method='patch' id='{{ Auth::id() }}'></x-confirm-modal>

@endsection
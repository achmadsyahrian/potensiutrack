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
            <form action="{{ route('profile.updatepassword') }}" method="post">
               @csrf
               @method('patch')
               <div class="col d-flex flex-column">
                  <div class="card-body">
                     <h2 class="mb-4">Kata Sandi Saya</h2>
                     <div class="row g-3 mt-4">
                        <div class="col-md">
                           <div class="form-label required">Password Lama</div>
                           <input type="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" class="form-control @error('old_password') is-invalid @enderror" name="old_password">
                           <x-invalid-feedback field='old_password'></x-invalid-feedback>
                        </div>
                        <div class="col-md">
                           <div class="form-label required">Password Baru</div>
                           <input type="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" class="form-control @error('new_password') is-invalid @enderror" name="new_password">
                           <x-invalid-feedback field='new_password'></x-invalid-feedback>
                        </div>
                        <div class="col-md">
                           <div class="form-label required">Konfirmasi Password</div>
                           <input type="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password">
                           <x-invalid-feedback field='confirm_password'></x-invalid-feedback>
                        </div>
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

@endsection
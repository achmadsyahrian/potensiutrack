@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
               Beranda
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
      <div class="row row-deck row-cards">
         @if (Auth::user()->role_id != 2)
            <div class="col-12">
               <div class="card card-md">
                  <div class="card-stamp card-stamp-lg">
                     <div class="card-stamp-icon bg-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path
                              d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" />
                           <path d="M10 10l.01 0" />
                           <path d="M14 10l.01 0" />
                           <path d="M10 14a3.5 3.5 0 0 0 4 0" />
                        </svg>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-10">
                           <h3 class="h1">Selamat Datang {{ Auth::user()->name }}</h3>
                           <div class="markdown text-muted">
                              Selamat datang di situs web pemantauan dan pelaporan pengecekan perangkat di <a href="https://instagram.com/official_upu" target="_blank" rel="noopener">Universitas Potensi Utama</a>.
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @endif

         @if (Auth::user()->role_id == 1)
            @include('dashboard.administrator')
         @elseif (Auth::user()->role_id == 2)
            @include('dashboard.kabag')
         @elseif (Auth::user()->role_id == 4)
            @include('dashboard.teknisi')
         @elseif (Auth::user()->role_id == 5)
            @include('dashboard.pegawai')
         @elseif (Auth::user()->role_id == 7)
            @include('dashboard.puskom')
         @elseif (Auth::user()->role_id == 8)
            @include('dashboard.wakilrektor2')
         @elseif (Auth::user()->role_id == 9)
            @include('dashboard.wakilrektor1')
         @endif
         
      </div>
   </div>
</div>

@endsection
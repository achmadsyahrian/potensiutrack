@extends('layouts.app')
@section('content')

@include('components.notification-handler')
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               <ol class="breadcrumb breadcrumb-arrows">
                  <li class="breadcrumb-item"><a href="#">Layanan</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('vicerector.webmaintenancesreport.index') }}">Permohonan Maintenance Web Aplikasi</a></li>
                  <li class="breadcrumb-item active"><a href="#">Lihat</a></li>
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
            <div class="col d-flex flex-column">
               <div class="card-body">
                  <h2 class="mb-4">Data Permohonan</h2>
                  <div class="row g-3 mt-4">
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label class="form-label">Tanggal</label>
                           <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($web_maintenance->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" readonly>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label class="form-label">Aplikasi</label>
                           <input type="text" class="form-control" value="{{ $web_maintenance->application->name }}" autocomplete="off" readonly>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label class="form-label">Divisi</label>
                           <input type="text" class="form-control" value="{{ $web_maintenance->division->name }}" autocomplete="off" readonly>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="mb-3">
                           <label class="form-label">Pemohon</label>
                           <input type="text" class="form-control" value="{{ $web_maintenance->reporter->name }}" autocomplete="off" readonly>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="mb-3">
                           <label class="form-label">Permasalahan</label>
                           <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini" class="form-control @error('error') is-invalid @enderror" id="" cols="" rows="1" readonly>{{ $web_maintenance->error }}</textarea>
                        </div>
                     </div>
                     @if ($web_maintenance->status == 1)
                     <hr>
                     <div class="col-lg-12">
                        <div class="mb-3">
                           <label class="form-label required">Tanggal Selesai</label>
                           <div class="row g-2">
                              <div class="col">
                                 <input type="date" class="form-control @error('finish_date') is-invalid @enderror" name="finish_date" value="{{ $web_maintenance->finish_date }}" autocomplete="off">
                                 <x-invalid-feedback field='finish_date'></x-invalid-feedback>
                              </div>
                              <div class="col-auto align-self-center">
                                 <span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<p>Silakan isi kolom ini ketika sudah selesai.</p>" data-bs-html="true">?</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     @else
                     <div class="col-lg-12">
                        <div class="mb-3">
                           <label class="form-label">Tanggal Selesai</label>
                           <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($web_maintenance->finish_date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" readonly>
                        </div>
                     </div>
                     @endif
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                     <div class="btn-list justify-content-end">
                        <a href="{{ route('vicerector.webmaintenancesreport.index') }}" class="btn">
                           Kembali
                        </a>
                        @if ($web_maintenance->status == 1)
                        <button type="submit" class="btn btn-success">
                           Selesai
                        </button>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
   @endsection

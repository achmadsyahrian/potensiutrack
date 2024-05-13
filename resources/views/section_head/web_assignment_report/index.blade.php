@extends('layouts.app')
@section('content')

@include('components.notification-handler')
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               <ol class="breadcrumb breadcrumb-arrows">
                  <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                  <li class="breadcrumb-item active"><a href="#">Penugasan Web Informasi</a></li>
               </ol>
            </div>
            <h2 class="page-title">
               Potensi Utama Track
            </h2>
         </div>
         {{-- <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
               <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-search">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                     <path d="M21 21l-6 -6" />
                  </svg>
                  Cari
               </a>
               <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-search" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                     <path d="M21 21l-6 -6" />
                  </svg>
               </a>
            </div>
         </div>
         <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
               <a href="{{ route('sectionhead.webassignmentreport.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                     <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                  Reset Pencarian
               </a>
               <a href="{{ route('sectionhead.employeepcdailychecks.index') }}" class="btn btn-secondary d-sm-none btn-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                     <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
               </a>
            </div>
         </div> --}}
      </div>
   </div>
</div>

<div class="page-body">
   <div class="container-xl">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Data Laporan</h3>
         </div>
         <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
               <thead>
                  <tr>
                     <th class="w-1">No.</th>
                     <th>Tahun</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($data as $item)
                  <tr>
                     <td><span class="text-muted">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</span></td>
                     <td>
                        {{ $item->month }} {{ $item->year }}
                    </td>                 
                     <td>
                        <div class="btn-list justify-content-end flex-nowrap">
                           <a href="{{ route('sectionhead.webassignmentreport.showByIndex', ['year' => $item->year]) }}"
                              class="btn btn-outline-info">
                              Lihat
                           </a>
                           @if ($item->isVerified($item->year, Auth::user()->role_id))
                              <button class="btn btn-teal">
                                 Sudah Verifikasi
                              </button>
                           @else
                              <a href="#"
                                 class="btn btn-outline-teal" data-bs-toggle="modal" data-bs-target="#modal-report-{{ $loop->index }}">
                                 Verifikasi
                              </a>
                           @endif
                        </div>
                     </td>
                     <x-verify-signature route="{{ route('sectionhead.webassignmentreport.verify', ['year' => $item->year]) }}" method='post' id='{{ $loop->index }}' title="Paraf Kabag" name="kabag_signature"></x-verify-signature>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="6">
                        <p class="text-center text-muted">Data tidak tersedia <svg xmlns="http://www.w3.org/2000/svg"
                              width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                              <path d="M12 9v4" />
                              <path d="M12 16v.01" />
                           </svg></p>
                     </td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         <x-pagination :data="$data" />
      </div>
   </div>
</div>

{{-- @include('components.employeepcdailychecks.modal-search') --}}
@endsection
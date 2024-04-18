@extends('layouts.app')
@section('content')

@include('components.notification-handler')

<div class="page-header d-print-none">
   <div class="container-xl">
       <div class="row g-2 align-items-center">
           <div class="col">
               <div class="page-pretitle">
                  <ol class="breadcrumb breadcrumb-arrows">
                     <li class="breadcrumb-item"><a href="#">Lab</a></li>
                     <li class="breadcrumb-item active"><a href="#">Permohonan Penggunaan</a></li>
                  </ol>
               </div>
               <h2 class="page-title">
                   Potensi Utama Track
               </h2>
           </div>
           <div class="col-auto ms-auto d-print-none">
               <div class="btn-list">
                   <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                       data-bs-target="#modal-report">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M12 5l0 14" />
                           <path d="M5 12l14 0" />
                       </svg>
                       Tambah Laporan
                   </a>
                   <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                       data-bs-target="#modal-report" aria-label="Create new report">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M12 5l0 14" />
                           <path d="M5 12l14 0" />
                       </svg>
                   </a>
               </div>
           </div>
       </div>
   </div>
</div>

<div class="page-body">
   <div class="container-xl">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Data Permohonan</h3>
            <div class="ms-auto text-muted">
               <div class="ms-2 d-inline-block">
                  <a href="#" class="btn btn-info btn-pill btn-sm me-1" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#modal-search">
                     Cari <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-search ms-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                     </svg>
                  </a>
                  <a href="{{ route('labassistant.labrequests.index') }}" class="btn btn-secondary btn-pill btn-sm" style="width: 150px;" >
                     Reset Pencarian <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-zoom-reset ms-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M21 21l-6 -6" />
                        <path
                           d="M3.268 12.043a7.017 7.017 0 0 0 6.634 4.957a7.012 7.012 0 0 0 7.043 -6.131a7 7 0 0 0 -5.314 -7.672a7.021 7.021 0 0 0 -8.241 4.403" />
                        <path d="M3 4v4h4" />
                     </svg>
                  </a>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
               <thead>
                  <tr>
                     <th class="w-1">No.</th>
                     <th>Tanggal</th>
                     <th>Lab</th>
                     <th>Dosen</th>
                     <th>Kelas</th>
                     <th>Waktu Rencana Penggunaan</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($labRequests as $item)
                      <tr>
                        </td>
                        <td><span class="text-muted">{{ ($labRequests->currentPage() - 1) * $labRequests->perPage() + $loop->iteration }}</span></td>
                        <td>
                           {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}
                        </td>                       
                        <td>
                           <span class="badge bg-success me-1"></span> {{ $item->lab->name }}
                        </td>
                        <td>
                           {{ $item->lecturer->name }}
                        </td>
                        <td>
                           {{ $item->class }}
                        </td>
                        <td>
                           {{ \Carbon\Carbon::parse($item->scheduled_date)->isoFormat('DD MMMM YYYY') }}
                           <span class="badge bg-success me-1">{{ \Carbon\Carbon::parse($item->scheduled_date)->isoFormat(' HH:mm') }}</span>
                        </td>                        
                        <td>
                           <div class="btn-list justify-content-end flex-nowrap">
                              {{-- <a href="{{ route('labassistant.labrequests.edit', ['lab_request' => $item->id]) }}" class="btn btn-outline-info">
                                 Edit
                              </a> --}}
                              <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirm-{{ $item->id }}">
                                 Hapus
                              </a>
                           </div>
                        </td>
                        <x-confirm-modal route="{{ route('labassistant.labrequests.destroy', ['lab_request' => $item->id]) }}" method='delete' id='{{ $item->id }}'></x-confirm-modal>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="6">
                           <p class="text-center text-muted">Data tidak tersedia <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle">
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
         <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">Showing <span>{{ $labRequests->firstItem() }}</span> to <span>{{ $labRequests->lastItem() }}</span> of <span>{{ $labRequests->total() }}</span> entries</p>
            <ul class="pagination m-0 ms-auto">
               <li class="page-item {{ $labRequests->previousPageUrl() ? '' : 'disabled' }}">
                   <a class="page-link" href="{{ $labRequests->previousPageUrl() ?? '#' }}" tabindex="-1" aria-disabled="true">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M15 6l-6 6l6 6" />
                       </svg>
                       prev
                   </a>
               </li>
               @php
                   $start = max(1, min($labRequests->currentPage() - 2, $labRequests->lastPage() - 4));
                   $end = min($start + 4, $labRequests->lastPage());
               @endphp
               @for ($i = $start; $i <= $end; $i++)
                   <li class="page-item {{ $i == $labRequests->currentPage() ? 'active' : '' }}">
                       <a class="page-link" href="{{ $labRequests->url($i) }}">{{ $i }}</a>
                   </li>
               @endfor
               <li class="page-item {{ $labRequests->nextPageUrl() ? '' : 'disabled' }}">
                   <a class="page-link" href="{{ $labRequests->nextPageUrl() ?? '#' }}">
                       next
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M9 6l6 6l-6 6" />
                       </svg>
                   </a>
               </li>
           </ul>       
         </div>
      </div>
   </div>
</div>

@include('components.labrequests.modal')
@include('components.labrequests.modal-search')
@endsection
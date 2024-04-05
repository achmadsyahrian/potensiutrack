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
                  <li class="breadcrumb-item active"><a href="#">Perawatan & Perbaikan</a></li>
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
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M12 5l0 14" />
                     <path d="M5 12l14 0" />
                  </svg>
                  Tambah permohonan
               </a>
               <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                  data-bs-target="#modal-report" aria-label="Create new report">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
               Cari:
               <div class="ms-2 d-inline-block">
                  <form action="{{ route('repairrequests.index') }}" method="GET">
                     <input type="text" class="form-control form-control-sm" name="search" aria-label="Search invoice"
                        value="{{ request('search') }}">
                  </form>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
               <thead>
                  <tr>
                     <th class="w-1">No.</th>
                     <th>Kode Inventaris</th>
                     <th>Tanggal</th>
                     <th>Pemohon</th>
                     <th>Penanggung Jawab</th>
                     <th>Status</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($repairRequests as $item)
                  <tr>
                     </td>
                     <td><span class="text-muted">{{ ($repairRequests->currentPage() - 1) * $repairRequests->perPage() +
                           $loop->iteration }}</span></td>
                     <td class="text-muted">
                        {{ $item->inventory_code ?? '---' }}
                     </td>
                     <td>
                        {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}
                     </td>    
                     <td>
                        {{ $item->requester->name }}
                     </td>
                     <td>
                        {{ $item->technician->name }}
                     </td>
                     <td>
                        @php
                           $status = '';
                           $badgeClass = '';
                        
                           switch ($item->status) {
                              case 1:
                                 $status = 'Baru';
                                 $badgeClass = 'warning';
                              break;
                              case 2:
                                 $status = 'Sudah Diperbaiki';
                                 $badgeClass = 'teal';
                              break;
                              case 3:
                                 $status = 'Sudah Diterima';
                                 $badgeClass = 'cyan';
                                 break;
                              case 4:
                                 $status = 'Sudah Disetujui';
                                 $badgeClass = 'success';
                              break;
                              case 5:
                                 $status = 'Tidak Disetujui';
                                 $badgeClass = 'danger';
                              break;
                              default:
                                 $status = 'Status Tidak Valid';
                                 $badgeClass = 'dark';
                           }
                        @endphp
                        <span class="badge bg-{{ $badgeClass }} me-1"></span> {{ $status }}
                     </td>                                     
                     <td>
                        <div class="btn-list justify-content-end flex-nowrap">
                           <a href="{{ route('repairrequests.edit', ['repair_request' => $item->id]) }}"
                              class="btn btn-outline-info">
                              Edit
                           </a>
                           <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal"
                              data-bs-target="#modal-confirm-{{ $item->id }}">
                              Hapus
                           </a>
                        </div>
                     </td>
                     <x-confirm-modal route="{{ route('repairrequests.destroy', ['repair_request' => $item->id]) }}"
                        method='delete' id='{{ $item->id }}'></x-confirm-modal>
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
         <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">Showing <span>{{ $repairRequests->firstItem() }}</span> to <span>{{
                  $repairRequests->lastItem() }}</span> of <span>{{ $repairRequests->total() }}</span> entries</p>
            <ul class="pagination m-0 ms-auto">
               <li class="page-item {{ $repairRequests->previousPageUrl() ? '' : 'disabled' }}">
                  <a class="page-link" href="{{ $repairRequests->previousPageUrl() ?? '#' }}" tabindex="-1"
                     aria-disabled="true">
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
               $start = max(1, min($repairRequests->currentPage() - 2, $repairRequests->lastPage() - 4));
               $end = min($start + 4, $repairRequests->lastPage());
               @endphp
               @for ($i = $start; $i <= $end; $i++) <li
                  class="page-item {{ $i == $repairRequests->currentPage() ? 'active' : '' }}">
                  <a class="page-link" href="{{ $repairRequests->url($i) }}">{{ $i }}</a>
                  </li>
                  @endfor
                  <li class="page-item {{ $repairRequests->nextPageUrl() ? '' : 'disabled' }}">
                     <a class="page-link" href="{{ $repairRequests->nextPageUrl() ?? '#' }}">
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

@include('components.repairrequests.modal')
@endsection
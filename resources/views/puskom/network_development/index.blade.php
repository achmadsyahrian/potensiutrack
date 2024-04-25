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
                     <li class="breadcrumb-item active"><a href="#">Permohonan Pengembangan Jaringan</a></li>
                  </ol>
               </div>
               <h2 class="page-title">
                   Potensi Utama Track
               </h2>
           </div>
           <div class="col-auto ms-auto d-print-none">
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
               <a href="{{ route('puskom.networkdev.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                     <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                  Reset Pencarian
               </a>
               <a href="{{ route('puskom.networkdev.index') }}" class="btn btn-secondary d-sm-none btn-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                     <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
               </a>
            </div>
         </div>
           <div class="col-auto ms-auto d-print-none">
               <div class="btn-list">
                   <a href="#" class="btn btn-teal d-none d-sm-inline-block" data-bs-toggle="modal"
                       data-bs-target="#modal-report">
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M12 5l0 14" />
                           <path d="M5 12l14 0" />
                       </svg>
                       Tambah Permohonan
                   </a>
                   <a href="#" class="btn btn-teal d-sm-none btn-icon" data-bs-toggle="modal"
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
         </div>
         <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
               <thead>
                  <tr>
                     <th class="w-1">No.</th>
                     <th>Tanggal Laporan</th>
                     <th>Divisi</th>
                     <th>Alasan</th>
                     <th>Status</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($networkDev as $item)
                      <tr>
                        </td>
                        <td><span class="text-muted">{{ ($networkDev->currentPage() - 1) * $networkDev->perPage() + $loop->iteration }}</span></td>
                        <td>
                           {{ \Carbon\Carbon::parse($item->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                        </td>
                        <td>
                           {{ $item->division->name }}
                        </td>
                        <td style="max-width: 300px; text-wrap: wrap;">
                           {{ $item->network_expansion_reason }}
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
                                    $status = 'Sudah Selesai';
                                    $badgeClass = 'teal';
                                 break;
                                 case 3:
                                    $status = 'Sudah Dikonfirmasi';
                                    $badgeClass = 'cyan';
                                    break;
                                 case 4:
                                    $status = 'Sudah Disetujui Kabag';
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
                              <a href="{{ route('puskom.networkdev.edit', ['network_development' => $item->id]) }}" class="btn btn-outline-info">
                                 Lihat
                              </a>
                              <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirm-{{ $item->id }}">
                                 Hapus
                              </a>
                           </div>
                        </td>
                        <x-confirm-modal route="{{ route('puskom.networkdev.destroy', ['network_development' => $item->id]) }}" method='delete' id='{{ $item->id }}'></x-confirm-modal>
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
         <x-pagination :data="$networkDev" />
      </div>
   </div>
</div>

@include('components.puskom.network_development.modal')
@include('components.puskom.network_development.modal-search')
@endsection
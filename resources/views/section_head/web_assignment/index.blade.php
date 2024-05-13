@extends('layouts.app')
@section('content')

@include('components.notification-handler')

<div class="page-header d-print-none">
   <div class="container-xl">
       <div class="row g-2 align-items-center">
           <div class="col">
               <div class="page-pretitle">
                  <ol class="breadcrumb breadcrumb-arrows">
                     <li class="breadcrumb-item active"><a href="#">Penugasan Web Aplikasi</a></li>
                  </ol>
               </div>
               <h2 class="page-title">
                   Potensi Utama Track
               </h2>
           </div><div class="col-auto ms-auto d-print-none">
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
               <a href="{{ route('sectionhead.webassignment.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                     <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
                  Reset Pencarian
               </a>
               <a href="{{ route('sectionhead.webassignment.index') }}" class="btn btn-secondary d-sm-none btn-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                     <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>
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
            <h3 class="card-title">Data Penugasan</h3>
         </div>
         <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
               <thead>
                  <tr>
                     <th class="w-1">No.</th>
                     <th>Tanggal</th>
                     <th>Programmer</th>
                     <th>Aplikasi</th>
                     <th>Tgl Selesai</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($data as $item)
                      <tr>
                        </td>
                        <td><span class="text-muted">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</span></td>
                        <td>
                           {{ \Carbon\Carbon::parse($item->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                        </td>
                        <td>
                           {{ $item->programmer->name }}
                        </td>
                        <td>
                           <div class="d-flex py-1 align-items-center">
                              <div class="flex-fill">
                                 <div class="font-weight-medium">{{ $item->application }}</div>
                                 <div class="text-muted">{{ $item->assignmentTypeDisplay() }}</div>
                              </div>
                           </div>
                        </td>      
                        <td>
                           @if(isset($item->finish_date))
                              {{ \Carbon\Carbon::parse($item->finish_date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                           @else
                              --
                           @endif
                        </td>                                                    
                        <td>
                           <div class="btn-list justify-content-end flex-nowrap">
                              @if ($item->finish_date !== null && $item->kabag_signature === null)
                                 <a href="#" class="btn btn-outline-teal" data-bs-toggle="modal" data-bs-target="#modal-report-{{ $loop->index }}">
                                    Verifikasi
                                 </a>
                              @elseif ($item->kabag_signature !== null)
                                 <a href="#" class="btn btn-teal">
                                    Sudah Diverifikasi
                                 </a>
                              @endif
                           </div>
                        </td>
                        <x-verify-signature route="{{ route('sectionhead.webassignment.verify', ['id' => $item->id]) }}" method='post' id='{{ $loop->index }}' title="Paraf Kabag" name="kabag_signature"></x-verify-signature>
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
         <x-pagination :data="$data" />
      </div>
   </div>
</div>

@include('components.sectionhead.web_assignment.modal-search')
@endsection
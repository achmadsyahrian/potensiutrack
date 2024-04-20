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
                  <li class="breadcrumb-item active"><a href="#">Komputer</a></li>
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
                  Tambah komputer
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
            <h3 class="card-title">Data Komputer</h3>
            <div class="ms-auto text-muted">
               Cari:
               <div class="ms-2 d-inline-block">
                  <form action="{{ route('computers.index') }}" method="GET">
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
                     <th>Nama</th>
                     <th>Lab</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($computers as $item)
                  <tr>
                     </td>
                     <td><span class="text-muted">{{ ($computers->currentPage() - 1) * $computers->perPage() +
                           $loop->iteration }}</span></td>
                     <td>
                        {{ $item->name }}
                     </td>
                     <td>
                        <span class="badge bg-success me-1"></span> {{ $item->lab->name }}
                     </td>
                     <td>
                        <div class="btn-list justify-content-end flex-nowrap">
                           <a href="{{ route('computers.edit', ['computer' => $item->id]) }}"
                              class="btn btn-outline-info">
                              Edit
                           </a>
                           <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal"
                              data-bs-target="#modal-confirm-{{ $item->id }}">
                              Hapus
                           </a>
                        </div>
                     </td>
                     <x-confirm-modal route="{{ route('computers.destroy', ['computer' => $item->id]) }}"
                        method='delete' id='{{ $item->id }}'></x-confirm-modal>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="5">
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
         <x-pagination :data="$computers"/>
      </div>
   </div>
</div>

@include('components.computers.modal')

{{-- Modal Confirm --}}
{{-- <x-confirm-modal route="{{ route('users.destroy', ['user' => $item->id]) }}" method='delete'></x-confirm-modal>
--}}
@endsection
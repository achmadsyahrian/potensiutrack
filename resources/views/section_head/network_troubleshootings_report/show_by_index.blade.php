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
                  <li class="breadcrumb-item"><a href="{{ route('sectionhead.networktroubleshootingsreport.index') }}">Penanganan Gangguan Jaringan</a></li>
                  <li class="breadcrumb-item active"><a href="#"> {{ $month }} {{ $year }}</a></li>
               </ol>
            </div>
            <h2 class="page-title">
               Potensi Utama Track
            </h2>
         </div>
         {{-- <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
               <a href="{{ route('sectionhead.networktroubleshootingsreport.index') }}" class="btn btn-warning d-none d-sm-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-left">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M11 7l-5 5l5 5" />
                     <path d="M17 7l-5 5l5 5" /></svg>
                  Kembali
               </a>
               <a href="{{ route('sectionhead.networktroubleshootingsreport.index') }}" class="btn btn-secondary d-sm-none btn-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11 7l-5 5l5 5" />
                    <path d="M17 7l-5 5l5 5" /></svg>
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
                     <th>Tanggal</th>
                     <th>Divisi</th>
                     <th>Pelapor</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($data as $item)
                  <tr>
                     <td><span class="text-muted">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</span></td>
                     <td>
                        {{ \Carbon\Carbon::parse($item->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                    </td>
                    <td>
                        {{ $item->division->name }}
                    </td>
                    <td>
                        {{ $item->reporter->name }}
                    </td>
                     <td>
                        <div class="btn-list justify-content-end flex-nowrap">
                           <a href="{{ route('sectionhead.networktroubleshootingsreport.show', ['id' => $item]) }}"
                              class="btn btn-outline-info">
                              Lihat
                           </a>
                        </div>
                     </td>
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

{{-- @include('components.employeepcdailychecks.modal')
@include('components.employeepcdailychecks.modal-search') --}}
@endsection
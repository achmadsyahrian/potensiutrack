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
                  <form action="{{ route('technician.repairrequests.index') }}" method="GET">
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
                     <th>Tanggal</th>
                     <th>Divisi</th>
                     <th>Alasan</th>
                     <th>Status</th>
                     <th>Tanggal Selesai</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($networkDevelopment as $item)
                  <tr>
                     </td>
                     <td><span class="text-muted">{{ ($networkDevelopment->currentPage() - 1) * $networkDevelopment->perPage() +
                           $loop->iteration }}</span></td>
                     <td>
                        {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}
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
                        @if(isset($item->finish_date))
                            {{ \Carbon\Carbon::parse($item->finish_date)->format('d F Y') }}
                        @else
                            --
                        @endif
                     </td>                                   
                     <td>
                        <div class="btn-list justify-content-end flex-nowrap">
                           <a href="{{ route('employee.networkdev.show', ['id' => $item->id]) }}"
                              class="btn btn-outline-info">
                              Lihat
                           </a>
                        </div>
                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="8">
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
         <x-pagination :data="$networkDevelopment" />
      </div>
   </div>
</div>

@endsection
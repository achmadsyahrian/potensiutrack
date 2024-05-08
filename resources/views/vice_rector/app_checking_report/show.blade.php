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
                        <li class="breadcrumb-item"><a href="{{ route('vicerector.appcheckingsreport.index') }}">Pengecekan Web Aplikasi</a></li>
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
                                    <label class="form-label">Tahun</label>
                                    <input type="text" class="form-control" value="{{ $appChecking->year }}" autocomplete="off" readonly>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="mb-3">
                                    <label class="form-label">Bulan</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::create()->month($appChecking->month)->translatedFormat('F') }}" autocomplete="off" readonly>
                              </div>
                           </div>

                           @php
                              use Carbon\Carbon;
                              $totalDays = Carbon::create($appChecking->year, $appChecking->month)->daysInMonth;
                           @endphp
                           
                           <div class="col-lg-12">
                              <div class="card mb-3">
                                    @foreach ($webApps as $webApp)
                                       {{-- <h2> Aplikasi {{ $webApp->id }} </h2> --}}
                                       <div class="table-responsive">
                                          <table class="table table-vcenter card-table" id="computer-table">
                                                <thead>
                                                   <tr class="text-left">
                                                      <th class="text-white fs-5" colspan="100">{{ $webApp->name }} 
                                                            @if ($webApp->url)
                                                            - 
                                                            <span class="text-muted text-sm">
                                                               <a href="{{ $webApp->url }}" class="text-muted" target="_blank">
                                                                  <small>{{ $webApp->url }}</small>
                                                               </a>
                                                            </span>
                                                            @endif
                                                      </th>
                                                   </tr>
                                                   <tr class="text-center">
                                                      <th>Jam</th>
                                                      @for ($i = 1; $i <= $totalDays; $i++)
                                                            <th>{{ $i }}</th>
                                                      @endfor
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach (['08:00', '11:00', '16:00', '19:00'] as $jam)
                                                      <tr class="text-center">
                                                            <td>{{ $jam }}</td>
                                                            @for ($day = 1; $day <= $totalDays; $day++)
                                                               @php
                                                                  // Buat nama checkbox
                                                                  $checkboxName = 'app_' . $webApp->id . '_' . $appChecking->year . '-0' . $appChecking->month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) . '_' . str_replace(':', '', $jam);
                                                                  
                                                                  // Dekode hasil laporan dari JSON
                                                                  $results = json_decode($appChecking->result, true);
                                                                  
                                                                  // Buat kunci untuk tanggal dan waktu
                                                                  $checkboxKey = $appChecking->year . '-0' . $appChecking->month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                                                  $jamKey = 'jam_' . substr(str_replace(':', '', $jam), 0, 2);
                                                                  
                                                                  // Periksa apakah checkbox harus dicentang berdasarkan hasil laporan
                                                                  $isChecked = isset($results['app_' . $webApp->id][$checkboxKey][$jamKey]) && $results['app_' . $webApp->id][$checkboxKey][$jamKey] == 1;
                                                               @endphp
                                                               <td>
                                                                  <input class="form-check-input m-0 align-middle" onclick="return false;" type="checkbox" name="{{ $checkboxName }}" {{ $isChecked ? 'checked' : '' }}>
                                                               </td>
                                                            @endfor
                                                      </tr>
                                                   @endforeach
                                                </tbody>
                                          </table>
                                       </div>
                                    @endforeach

                              
                              </div>
                           </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                           <div class="btn-list justify-content-end">
                              <a href="{{ route('vicerector.appcheckingsreport.index') }}" class="btn">
                                    Kembali
                              </a>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('dist/libs/fslightbox/index.js?1684106062') }}" defer></script>
@endsection

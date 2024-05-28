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
                                    <input type="text" class="form-control" value="{{ $year }}" autocomplete="off" readonly>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="mb-3">
                                    <label class="form-label">Bulan</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}" autocomplete="off" readonly>
                              </div>
                           </div>

                           @php
                              use Carbon\Carbon;
                              $totalDays = Carbon::create($year, $month)->daysInMonth;
                           @endphp
                           
                           <div class="col-lg-12">
                              <div class="card mb-3">
                                    @foreach ($appChecking as $appItem)
                                       <div class="table-responsive">
                                          <table class="table table-vcenter card-table" id="computer-table">
                                                <thead>
                                                   <tr class="text-left">
                                                      <th class="text-white fs-5" colspan="100">{{ $appItem->application->name }} 
                                                            @if ($appItem->application->url)
                                                            - 
                                                            <span class="text-muted text-sm">
                                                               <a href="{{ $appItem->application->url }}" class="text-muted" target="_blank">
                                                                  <small>{{ $appItem->application->url }}</small>
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
                                                                  $checkboxName = 'app_' . $appItem->web_app_id . '_day_' . $day . '_jam_' . str_replace(':', '', $jam);
                                                                  $results = json_decode($appItem->result, true);

                                                                  $isChecked = isset($results[$day]) && isset($results[$day]['jam_' . substr(str_replace(':', '', $jam), 0, 2)]);
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

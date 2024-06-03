<div class="col-12">
   <div class="row row-cards">

      {{-- Verifikasi Perawatan & Penugasan --}}
      <div class="col-sm-6 col-lg-4">
         <a href="{{ route('sectionhead.repairrequests.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-danger text-white avatar">
                           <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" /><path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" /></svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Verifikasi Perawatan & Perbaikan
                        </div>
                        <div class="text-muted">
                           {{ $repairRequestVerifCount }} menunggu verifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-4">
         <a href="{{ route('sectionhead.networkassignment.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-green text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-broadcast-tower">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                              <path d="M16.616 13.924a5 5 0 1 0 -9.23 0" />
                              <path d="M20.307 15.469a9 9 0 1 0 -16.615 0" />
                              <path d="M9 21l3 -9l3 9" />
                              <path d="M10 19h4" />
                           </svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Penugasan Jaringan
                        </div>
                        <div class="text-muted">
                           {{ $networkAssVerifCount }} menunggu verifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-4">
         <a href="{{ route('sectionhead.webassignment.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-twitter text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                              <path d="M7 20l10 0" />
                              <path d="M9 16l0 4" />
                              <path d="M15 16l0 4" />
                              <path d="M8 12l3 -3l2 2l3 -3" />
                           </svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Penugasan Web
                        </div>
                        <div class="text-muted">
                           {{ $webAssVerifCount }} menunggu verifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>
</div>
<div class="col-12">
   <div class="card card-md">
      <div class="card-stamp card-stamp-lg">
         <div class="card-stamp-icon bg-primary">
            <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
               stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
               stroke-linejoin="round">
               <path stroke="none" d="M0 0h24v24H0z" fill="none" />
               <path
                  d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" />
               <path d="M10 10l.01 0" />
               <path d="M14 10l.01 0" />
               <path d="M10 14a3.5 3.5 0 0 0 4 0" />
            </svg>
         </div>
      </div>
      <div class="card-body">
         <div class="row align-items-center">
            <div class="col-10">
               <h3 class="h1">Selamat Datang {{ Auth::user()->name }}</h3>
               <div class="markdown text-muted">
                  Selamat datang di situs web pemantauan dan pelaporan pengecekan perangkat di <a href="https://instagram.com/official_upu" target="_blank" rel="noopener">Universitas Potensi Utama</a>.
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-12">
   <div class="row row-cards">
      <div class="col-lg-4">
         <div class="card mb-2">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div class="subheader">Laporan Lab</div>
               </div>
               <div class="h1 mb-3"></div>
               <div class="d-flex mb-2">
                  <div>Pemeriksaan Harian</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $labCheckingCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Permohonan Penggunaan</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                       {{ $labRequestCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Penggunaan Lab</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $labUsageCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div class="text-muted">--</div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card mb-2">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div class="subheader">Laporan Koneksi Jaringan</div>
               </div>
               <div class="h1 mb-3"></div>
               <div class="d-flex mb-2">
                  <div>Pengembangan Koneksi</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $networkDevCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Pengecekan Wifi</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                       {{ $wifiCheckingCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Penanganan Gangguan</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $networkTroCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Penugasan</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $networkAssCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card mb-2">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div class="subheader">Laporan Web Aplikasi</div>
               </div>
               <div class="h1 mb-3"></div>
               <div class="d-flex mb-2">
                  <div>Pengembangan Web</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $webDevCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Pengecekan Web</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                       {{ $webChekingCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Web Maintenance</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $webMaintenanceCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Penugasan</div>
                  <div class="ms-auto">
                     <span class="text-warning d-inline-flex align-items-center lh-1">
                        {{ $webAssCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-sm-6 col-lg-6">
         <a href="{{ route('sectionhead.repairrequestsreport.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-purple text-white avatar">
                           {{ $repairRequestCount }}
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Laporan Perawatan & Perbaikan
                        </div>
                        <div class="text-muted">
                           {{ $repairRequestReportCount }} menunggu verifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-6">
         <a href="{{ route('sectionhead.employeepcdailychecks.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-yellow text-white avatar">
                           {{ $employeePcDailyCheck }}
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Laporan Pemeriksaan Harian PC
                        </div>
                        <div class="text-muted">
                           {{ $employeePcDailyCheckReportCount }} menunggu verifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>
</div>
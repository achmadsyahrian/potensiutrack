<div class="col-12">
   <div class="row row-cards">
      <div class="col-lg-6">
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
               <div class="d-flex mb-3">
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
            </div>
         </div>
      </div>
      <div class="col-sm-12 col-lg-6">
         <a href="{{ route('vicerector.repairrequestsreport.index') }}" class="text-decoration-none">
            <div class="card mb-2 card-sm">
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
         <a href="{{ route('vicerector.employeepcdailychecks.index') }}" class="text-decoration-none">
            <div class="card mb-2 card-sm">
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
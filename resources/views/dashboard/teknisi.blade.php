<div class="col-12">
   <div class="row row-cards">
      <div class="col-lg-3">
         <div class="card mb-2">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div class="subheader">Perawatan & Perbaikan</div>
               </div>
               <div class="h1 mb-3">{{ $repairRequestCount }}</div>
               <div class="d-flex mb-2">
                  <div>Baru</div>
                  <div class="ms-auto">
                     <span class="text-yellow d-inline-flex align-items-center lh-1">
                        {{ $repairRequestNewCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Selesai</div>
                  <div class="ms-auto">
                     <span class="text-teal d-inline-flex align-items-center lh-1">
                        {{ $repairRequestFinishCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Konfirmasi Pemohon</div>
                  <div class="ms-auto">
                     <span class="text-blue d-inline-flex align-items-center lh-1">
                        {{ $repairRequestConfirmCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Disetujui Kabag</div>
                  <div class="ms-auto">
                     <span class="text-green d-inline-flex align-items-center lh-1">
                        {{ $repairRequestApproveCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
               <div class="d-flex mb-2">
                  <div>Ditolak Kabag</div>
                  <div class="ms-auto">
                     <span class="text-danger d-inline-flex align-items-center lh-1">
                        {{ $repairRequestRejectCount }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M7 12l5 5l10 -10" />
                           <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                     </span>
                  </div>
               </div>
            </div>
         </div>
         <div class="card mb-2 card-sm">
            <div class="card-body">
               <div class="row align-items-center">
                  <div class="col-auto">
                     <span class="bg-teal text-white avatar">
                        {{ $labRequestReportCount }}
                     </span>
                  </div>
                  <div class="col">
                     <div class="font-weight-medium">
                        Permohonan Penggunaan Lab
                     </div>
                     <div class="text-muted">
                        {{ $labRequestReportUncheckCount }} menunggu ditandatangani
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card mb-2 card-sm">
            <div class="card-body">
               <div class="row align-items-center">
                  <div class="col-auto">
                     <span class="bg-cyan text-white avatar">
                        {{ $labUsageReportCount }}
                     </span>
                  </div>
                  <div class="col">
                     <div class="font-weight-medium">
                        Penggunaan Lab
                     </div>
                     <div class="text-muted">
                        {{ $labUsageReportUncheckCount }} menunggu ditandatangani
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card mb-2 card-sm">
            <div class="card-body">
               <div class="row align-items-center">
                  <div class="col-auto">
                     <span class="bg-yellow text-white avatar">
                        {{ $labDailyCheckReportCount }}
                     </span>
                  </div>
                  <div class="col">
                     <div class="font-weight-medium">
                        Pemeriksaan Harian Lab
                     </div>
                     <div class="text-muted">
                        {{ $labDailyCheckReportUncheckCount }} menunggu ditandatangani
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-9">
         <div class="card" style="height: 484px">
           <div class="card-body card-body-scrollable card-body-scrollable-shadow">
             <div class="divide-y">
               @foreach ($repairRequestLatest as $data)
                  <div>
                     <div class="row">
                     <div class="col-auto">
                        @if ($data->requester->photo) 
                           <span class="avatar" style="background-image: url({{ asset('storage/' . $data->requester->photo) }})"></span>
                        @else
                           <span class="avatar" style="background-image: url({{ asset('image/avatar/defaul-profile.jpg') }})"></span>
                        @endif
                     </div>
                     <div class="col">
                        <div class="text-truncate">
                           {{ $data->requester->name }}
                        </div>
                        <div class="text-muted">Kerusakan : {{ $data->fault_description }}</div>
                     </div>
                     <div class="col-auto align-self-center">
                        <div class="text-muted">{{ $data->created_at->diffForHumans() }}</div>
                     </div>
                     </div>
                  </div>
               @endforeach
             </div>
           </div>
         </div>
      </div>
   </div>
</div>
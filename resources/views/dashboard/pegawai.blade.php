<div class="col-12">
   <div class="row row-cards">

      <div class="col-sm-12 col-lg-12">
         <a href="{{ route('employee.repairrequests.index') }}" class="text-decoration-none">
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
                           Layanan Teknisi
                        </div>
                        <div class="text-muted">
                           {{ $repairRequestVerifCount }} menunggu diverifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>

      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('employee.networkdev.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-danger text-white avatar">
                           {{ $networkDevCount }}
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Pengembangan Jaringan
                        </div>
                        <div class="text-muted">
                           {{ $networkDevVerifCount }} menunggu diverifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('employee.networktroubleshooting.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-green text-white avatar">
                          {{ $networkTroCount }}
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Penanganan Jaringan
                        </div>
                        <div class="text-muted">
                           {{ $networkTroVerifCount }} menunggu diverifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('employee.webdevelopment.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-twitter text-white avatar">
                           {{ $webDevCount }}
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Pengembangan Web
                        </div>
                        <div class="text-muted">
                           {{ $webDevVerifCount }} menunggu diverifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('employee.webmaintenance.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-warning text-white avatar">
                          {{ $webMaintenanceCount }}
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Maintenance Web
                        </div>
                        <div class="text-muted">
                           {{ $webMaintenanceVerifCount }} menunggu diverifikasi
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>
</div>

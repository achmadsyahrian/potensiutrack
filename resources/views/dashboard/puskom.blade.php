<div class="col-12">
   <div class="row row-cards">

      {{-- Pengembangan & Maintenance Web & Jaringan --}}
      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('puskom.networkdev.index') }}" class="text-decoration-none">
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
                           {{ $networkDevNew }} menunggu diselesaikan
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('puskom.networktroubleshooting.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-green text-white avatar">
                           {{ $networkTroubleshootingCount }}
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Penanganan Jaringan
                        </div>
                        <div class="text-muted">
                           {{ $networkTroubleshootingNew }} menunggu diselesaikan
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('puskom.webdevelopment.index') }}" class="text-decoration-none">
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
                           {{ $webDevNew }} menunggu diselesaikan
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('puskom.webmaintenance.index') }}" class="text-decoration-none">
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
                           {{ $webMaintenanceNew }} menunggu diselesaikan
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      {{-- Penugasan Web & Jaringan--}}
      <div class="col-md-6 col-xl-3">
         <a class="card card-link" href="puskom/network-assignment?search_engineer=10">
            <div class="card-cover card-cover-blurred text-center" style="background-image: url({{ asset('image/background-avatar/network2.jpeg') }})">
               @if ($irfan->photo) 
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url({{ asset('storage/' . $irfan->photo) }})"></span>
               @else
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url('{{ asset('image/avatar/defaul-profile.jpg') }}')"></span>
               @endif
            </div>
            <div class="card-body text-center">
               <div class="card-title mb-1">M. Irfan M.Kom</div>
               <div class="text-muted">{{ $networkAssIrfanDevCount }} Pengembangan - {{ $networkAssIrfanTrouCount }} Penanganan</div>
            </div>
         </a>
      </div>
      <div class="col-md-6 col-xl-3">
         <a class="card card-link" href="puskom/network-assignment?search_engineer=11">
            <div class="card-cover card-cover-blurred text-center" style="background-image: url({{ asset('image/background-avatar/network.jpeg') }})">
               @if ($andra->photo) 
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url({{ asset('storage/' . $andra->photo) }})"></span>
               @else
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url('{{ asset('image/avatar/defaul-profile.jpg') }}')"></span>
               @endif
            </div>
            <div class="card-body text-center">
               <div class="card-title mb-1">Andra Alfitra S.Kom</div>
               <div class="text-muted">{{ $networkAssAndraDevCount }} Pengembangan - {{ $networkAssAndraTrouCount }} Penanganan</div>
            </div>
         </a>
      </div>
      <div class="col-md-6 col-xl-3">
         <a class="card card-link" href="puskom/web-assignment?search_programmer=8">
            <div class="card-cover card-cover-blurred text-center" style="background-image: url({{ asset('image/background-avatar/programmer.jpeg') }})">
               @if ($briyandana->photo) 
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url({{ asset('storage/' . $briyandana->photo) }})"></span>
               @else
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url('{{ asset('image/avatar/defaul-profile.jpg') }}')"></span>
               @endif
            </div>
            <div class="card-body text-center">
               <div class="card-title mb-1">Briyandana S.Kom</div>
               <div class="text-muted">{{ $webAssBriyanDevCount }} Pengembangan - {{ $webAssBriyanMainCount }} Maintenance</div>
            </div>
         </a>
      </div>
      <div class="col-md-6 col-xl-3">
         <a class="card card-link" href="puskom/web-assignment?search_programmer=9">
            <div class="card-cover card-cover-blurred text-center" style="background-image: url({{ asset('image/background-avatar/programmer2.jpeg') }})">
               @if ($syahrian->photo) 
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url({{ asset('storage/' . $syahrian->photo) }})"></span>
               @else
                  <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url('{{ asset('image/avatar/defaul-profile.jpg') }}')"></span>
               @endif
            </div>
            <div class="card-body text-center">
               <div class="card-title mb-1">Achmad Syahrian</div>
               <div class="text-muted">{{ $webAssRianDevCount }} Pengembangan - {{ $webAssRianMainCount }} Maintenance</div>
            </div>
         </a>
      </div>
   </div>
</div>

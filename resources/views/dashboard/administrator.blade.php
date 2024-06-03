<div class="col-12">
   <div class="row row-cards">

      <div class="col-sm-12 col-lg-4">
         <a href="{{ route('users.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-green text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                              <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                              <path d="M19.001 15.5v1.5" />
                              <path d="M19.001 21v1.5" />
                              <path d="M22.032 17.25l-1.299 .75" />
                              <path d="M17.27 20l-1.3 .75" />
                              <path d="M15.97 17.25l1.3 .75" />
                              <path d="M20.733 20l1.3 .75" />
                           </svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Akun
                        </div>
                        <div class="text-muted">
                            {{ $users }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>

      <div class="col-sm-12 col-lg-4">
         <a href="{{ route('accounts.employee.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-blue text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                              <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                              <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                              <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                              <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                              <path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Pegawai
                        </div>
                        <div class="text-muted">
                            {{ $employees }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>

      <div class="col-sm-12 col-lg-4">
         <a href="{{ route('lecturers.index') }}" class="text-decoration-none">
            <div class="card card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-purple text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-screen">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M19.03 17.818a3 3 0 0 0 1.97 -2.818v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8c0 1.317 .85 2.436 2.03 2.84" />
                              <path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                              <path d="M8 21a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Dosen
                        </div>
                        <div class="text-muted">
                            {{ $lecturers }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>

      <div class="col-sm-6 col-lg-3">
         <a href="{{ route('roles.index') }}" class="text-decoration-none">
            <div class="card mb-2 card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-danger text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Level
                        </div>
                        <div class="text-muted">
                           {{ $levels }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
         <a href="{{ route('divisions.index') }}" class="text-decoration-none">
            <div class="card mb-2 card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-warning text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-teams">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M3 7h10v10h-10z" />
                              <path d="M6 10h4" />
                              <path d="M8 10v4" />
                              <path d="M8.104 17c.47 2.274 2.483 4 4.896 4a5 5 0 0 0 5 -5v-7h-5" />
                              <path d="M18 18a4 4 0 0 0 4 -4v-5h-4" />
                              <path d="M13.003 8.83a3 3 0 1 0 -1.833 -1.833" />
                              <path d="M15.83 8.36a2.5 2.5 0 1 0 .594 -4.117" /></svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Divisi
                        </div>
                        <div class="text-muted">
                           {{ $divisions }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
         <a href="{{ route('iteminventories.index') }}" class="text-decoration-none">
            <div class="card mb-2 card-sm">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-auto">
                        <span class="bg-twitter text-white avatar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="icon icon-tabler icons-tabler-outline icon-tabler-packages">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                              <path d="M2 13.5v5.5l5 3" />
                              <path d="M7 16.545l5 -3.03" />
                              <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                              <path d="M12 19l5 3" />
                              <path d="M17 16.5l5 -3" />
                              <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                              <path d="M7 5.03v5.455" />
                              <path d="M12 8l5 -3" />
                           </svg>
                        </span>
                     </div>
                     <div class="col">
                        <div class="font-weight-medium">
                           Barang Inventaris
                        </div>
                        <div class="text-muted">
                           {{ $inventory }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-sm-6 col-lg-9">
         <div class="card" style="height: 484px">
           <div class="card-body card-body-scrollable card-body-scrollable-shadow">
             <div class="divide-y">
               @foreach ($webApps as $data)
                  <div>
                     <div class="row">
                     <div class="col-auto m-auto">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-world"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M3.6 9h16.8" /><path d="M3.6 15h16.8" /><path d="M11.5 3a17 17 0 0 0 0 18" /><path d="M12.5 3a17 17 0 0 1 0 18" /></svg>
                     </div>
                     <div class="col">
                        <div class="text-truncate">
                           {{ $data->name }}
                        </div>
                        <div class="text-muted">Deskripsi : {{ $data->description }}</div>
                     </div>
                     <div class="col-auto align-self-center">
                        <a href="{{ $data->url }}" target="_blank" class="ms-1" aria-label="Open website">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                         </a>
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

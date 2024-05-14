<header class="navbar navbar-expand-md sticky-top d-print-none">
   <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-brand d-flex align-items-center justify-content-between pe-0 pe-md-3">
         <a href="." class="d-flex align-items-center">
            <img src="{{ asset('image/Logopotensiutama.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image me-3">
            {{-- <h2 class="page-title mb-0 text-light">PotensiuTrack</h2> --}}
         </a>
      </div>
      <div class="navbar-nav flex-row order-md-last">
         <div class="d-none d-md-flex">
            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark me-3" title="Aktifkan mode gelap" data-bs-toggle="tooltip" data-bs-placement="bottom">
               <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-moon-stars">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                  <path d="M17 4a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                  <path d="M19 11h2m-1 -1v2" />
               </svg>
            </a>
            <a href="?theme=light" class="nav-link px-0 hide-theme-light me-3" title="Aktifkan mode terang" data-bs-toggle="tooltip" data-bs-placement="bottom">
               <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sun-high">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z" />
                  <path d="M6.343 17.657l-1.414 1.414" />
                  <path d="M6.343 6.343l-1.414 -1.414" />
                  <path d="M17.657 6.343l1.414 -1.414" />
                  <path d="M17.657 17.657l1.414 1.414" />
                  <path d="M4 12h-2" />
                  <path d="M12 4v-2" />
                  <path d="M20 12h2" />
                  <path d="M12 20v2" /></svg>
            </a>
            {{-- <div class="nav-item dropdown d-none d-md-flex me-3">
               <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                  aria-label="Show notifications">
                  <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                     <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                  </svg>
                  <span class="badge bg-red"></span>
               </a>
               <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Last updates</h3>
                     </div>
                     <div class="list-group list-group-flush list-group-hoverable">
                        <div class="list-group-item">
                           <div class="row align-items-center">
                              <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span>
                              </div>
                              <div class="col text-truncate">
                                 <a href="#" class="text-body d-block">Example 1</a>
                                 <div class="d-block text-muted text-truncate mt-n1">
                                    Change deprecated html tags to text decoration classes (#29604)
                                 </div>
                              </div>
                              <div class="col-auto">
                                 <a href="#" class="list-group-item-actions">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24"
                                       height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                       fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path
                                          d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                    </svg>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div> --}}
         </div>
         <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
               @if (!Auth::user()->photo)
               <span class="avatar avatar-sm" style="background-image: url({{ asset('image/avatar/defaul-profile.jpg') }})"></span>
               @else
               <span class="avatar avatar-sm" style="background-image: url({{ asset('storage/' . Auth::user()->photo) }})"></span>
               @endif
               <div class="d-none d-xl-block ps-2">
                  <div>{{ Auth::user()->name }}</div>
                  <div class="mt-1 small text-muted">{{ Auth::user()->role->name }}</div>
               </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
               {{-- <a href="#" class="dropdown-item">Status</a> --}}
               <a href="{{ route('profile.get') }}" class="dropdown-item">Profile</a>
               <div class="dropdown-divider"></div>
               {{-- <a href="./settings.html" class="dropdown-item">Settings</a> --}}
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
               </form>
               <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
         </div>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
         <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
            <ul class="navbar-nav">
               <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                  <a class="nav-link" href="/">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                           <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                           <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Beranda
                     </span>
                  </a>
               </li>
               @if (Auth::user()->role_id == 1)
               <li class="nav-item dropdown {{ request()->routeIs(['users*', 'computers*', 'labs*', 'roles*', 'divisions*', 'iteminventories.index', 'webapps.index', 'webapps.edit']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-category">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M4 4h6v6h-6z" />
                           <path d="M14 4h6v6h-6z" />
                           <path d="M4 14h6v6h-6z" />
                           <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Manajemen
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                              Akun
                           </a>
                           <a class="dropdown-item {{ Request::is('*labs*') ? 'active' : '' }}" href="{{ route('labs.index') }}">
                              Lab
                           </a>
                           <a class="dropdown-item {{ Request::is('*divisions*') ? 'active' : '' }}" href="{{ route('divisions.index') }}">
                              Divisi
                           </a>
                           <a class="dropdown-item {{ Request::is('*web-applications*') ? 'active' : '' }}" href="{{ route('webapps.index') }}">
                              Web Aplikasi
                           </a>
                        </div>
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*computers*') ? 'active' : '' }}" href="{{ route('computers.index') }}">
                              Komputer
                           </a>
                           <a class="dropdown-item {{ Request::is('*roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                              Level
                           </a>
                           <a class="dropdown-item {{ Request::is('*item-inventories*') ? 'active' : '' }}" href="{{ route('iteminventories.index') }}">
                              Barang Inventaris
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown {{ request()->routeIs(['*administrator*', '*employee*', '*lecturers*', '*technician*', '*puskom*', 'accounts.labassistant.index', 'accounts.labassistant.edit', 'accounts.sectionhead.index', 'accounts.sectionhead.edit']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                           <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                           <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                           <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                           <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                           <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Akun
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*administrator*') ? 'active' : '' }}" href="{{ route('accounts.administrator.index') }}">
                              Administrator
                           </a>
                           {{-- <a class="dropdown-item {{ Request::is('') ? 'active' : '' }}" href="{{ route('lecturers.index') }}">
                              Wakil Rektor
                           </a> --}}
                           <a class="dropdown-item {{ Request::is('*section-head*') ? 'active' : '' }}" href="{{ route('accounts.sectionhead.index') }}">
                              Kabag
                           </a>
                           <a class="dropdown-item {{ Request::is('*employee*') ? 'active' : '' }}" href="{{ route('accounts.employee.index') }}">
                              Pegawai
                           </a>
                        </div>
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*lecturer*') ? 'active' : '' }}" href="{{ route('lecturers.index') }}">
                              Dosen
                           </a>
                           <a class="dropdown-item {{ Request::is('*technician*') ? 'active' : '' }}" href="{{ route('accounts.technician.index') }}">
                              Teknisi
                           </a>
                           <a class="dropdown-item {{ Request::is('*lab-assistant*') ? 'active' : '' }}" href="{{ route('accounts.labassistant.index') }}">
                              Assisten Lab
                           </a>
                           <a class="dropdown-item {{ Request::is('*puskom*') ? 'active' : '' }}" href="{{ route('accounts.puskom.index') }}">
                              Puskom
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 2)
               <li class="nav-item {{ request()->routeIs(['sectionhead.webassignment.index']) ? 'active' : ''}}">
                  <a class="nav-link" href="{{ route('sectionhead.webassignment.index') }}">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M13 5h8" />
                           <path d="M13 9h5" />
                           <path d="M13 15h8" />
                           <path d="M13 19h5" />
                           <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                           <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Penugasan Web Informasi
                     </span>
                  </a>
               </li>
               <li class="nav-item dropdown 
                        {{ request()->routeIs(
                           [
                              'sectionhead.repairrequests.index', 'sectionhead.repairrequests.show', 
                              'sectionhead.employeepcdailychecks.index', 'sectionhead.employeepcdailychecks.showByMonthAndDivision', 'sectionhead.employeepcdailychecks.show', 
                              'sectionhead.labusagesreport.index', 'sectionhead.labusagesreport.showByIndex', 'sectionhead.labusagesreport.show', 
                              'sectionhead.labrequestsreport.index', 'sectionhead.labrequestsreport.showByIndex', 'sectionhead.labrequestsreport.show',
                              'sectionhead.labdailychecksreport.index', 'sectionhead.labdailychecksreport.showByIndex', 'sectionhead.labdailychecksreport.show',
                              'sectionhead.networktroubleshootingsreport.index', 'sectionhead.networktroubleshootingsreport.showByIndex', 'sectionhead.networktroubleshootingsreport.show',
                              'sectionhead.webdevelopmentsreport.index', 'sectionhead.webdevelopmentsreport.showByIndex', 'sectionhead.webdevelopmentsreport.show',
                              'sectionhead.webmaintenancesreport.index', 'sectionhead.webmaintenancesreport.showByIndex', 'sectionhead.webmaintenancesreport.show',
                              'sectionhead.wificheckingsreport.index', 'sectionhead.wificheckingsreport.showByIndex', 'sectionhead.wificheckingsreport.show',
                              'sectionhead.networkdevreport.index', 'sectionhead.networkdevreport.showByIndex', 'sectionhead.networkdevreport.show',
                              'sectionhead.appcheckingsreport.index', 'sectionhead.appcheckingsreport.showByIndex', 'sectionhead.appcheckingsreport.show',
                              'sectionhead.webassignmentreport.index', 'sectionhead.webassignmentreport.showByIndex', 'sectionhead.webassignmentreport.show',
                           ]) ? 'active' : '' }}
                     ">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                           <path d="M18 14v4h4" />
                           <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                           <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                           <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                           <path d="M8 11h4" />
                           <path d="M8 15h3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Laporan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <div class="dropend">
                              <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                Lab
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item {{ Request::is('*lab-daily-check*') ? 'active' : '' }}" href="{{ route('sectionhead.labdailychecksreport.index') }}">
                                    Pemeriksaan Harian Lab
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*lab-requests*') ? 'active' : '' }}" href="{{ route('sectionhead.labrequestsreport.index') }}">
                                    Permohonan Penggunaan Lab
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*lab-usages*') ? 'active' : '' }}" href="{{ route('sectionhead.labusagesreport.index') }}">
                                    Penggunaan Lab Komputer
                                 </a>
                              </div>
                           </div>
                           <div class="dropend">
                              <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                Web Aplikasi
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item {{ Request::is('*sectionhead/web-development*') ? 'active' : '' }}" href="{{ route('sectionhead.webdevelopmentsreport.index') }}">
                                    Pengembangan Web
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*sectionhead/web-maintenance*') ? 'active' : '' }}" href="{{ route('sectionhead.webmaintenancesreport.index') }}">
                                    Web Maintenance
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*sectionhead/web-checkings*') ? 'active' : '' }}" href="{{ route('sectionhead.appcheckingsreport.index') }}">
                                    Pengecekan Web
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*sectionhead/report/web-assignment*') ? 'active' : '' }}" href="{{ route('sectionhead.webassignmentreport.index') }}">
                                    Penugasan Web Informasi
                                 </a>
                              </div>
                           </div>
                           <div class="dropend">
                              <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                Jaringan
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item {{ Request::is('*sectionhead/network-development*') ? 'active' : '' }}" href="{{ route('sectionhead.networkdevreport.index') }}">
                                    Pengembangan Koneksi
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*sectionhead/wifi-checking*') ? 'active' : '' }}" href="{{ route('sectionhead.wificheckingsreport.index') }}">
                                    Pengecekan Wifi
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*network-troubleshootings*') ? 'active' : '' }}" href="{{ route('sectionhead.networktroubleshootingsreport.index') }}">
                                    Penanganan Gangguan Jaringan
                                 </a>
                              </div>
                           </div>
                           <a class="dropdown-item {{ Request::is('*repair-requests*') ? 'active' : '' }}" href="{{ route('sectionhead.repairrequests.index') }}">
                              Perawatan & Perbaikan Pc Staff
                           </a>
                           <a class="dropdown-item {{ Request::is('*employee-daily-check*') ? 'active' : '' }}" href="{{ route('sectionhead.employeepcdailychecks.index') }}">
                              Pemeriksaan Harian PC
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 3)
               <li class="nav-item dropdown {{ request()->routeIs(['labassistant.labrequests.index', 'labassistant.labrequests.show', 'labassistant.labusages.index', 'labassistant.labusages.show', 'labassistant.labdailychecks.index', 'labassistant.labdailychecks.edit']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-devices-2">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M10 15h-6a1 1 0 0 1 -1 -1v-8a1 1 0 0 1 1 -1h6" />
                           <path d="M13 4m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                           <path d="M7 19l3 0" />
                           <path d="M17 8l0 .01" />
                           <path d="M17 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                           <path d="M9 15l0 4" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Lab
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*lab-daily-checks*') ? 'active' : '' }}" href="{{ route('labassistant.labdailychecks.index') }}">
                              Pemeriksaan Harian
                           </a>
                           <a class="dropdown-item {{ request()->routeIs(['labassistant.labrequests.index', 'labassistant.labrequests.show',]) ? 'active' : '' }}" href="{{ route('labassistant.labrequests.index') }}">
                              Permohonan Penggunaan
                           </a>
                           <a class="dropdown-item {{ request()->routeIs(['labassistant.labusages.index', 'labassistant.labusages.show',]) ? 'active' : '' }}" href="{{ route('labassistant.labusages.index') }}">
                              Penggunaan
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 4)
               <li class="nav-item dropdown {{ request()->routeIs(['technician.repairrequests.index', 'technician.repairrequests.edit', 'technician.employeepcdailychecks.show', 'technician.employeepcdailychecks.index']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                           <path d="M7 20l10 0" />
                           <path d="M9 16l0 4" />
                           <path d="M15 16l0 4" />
                           <path d="M8 12l3 -3l2 2l3 -3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Layanan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*repair-requests*') ? 'active' : '' }}" href="{{ route('technician.repairrequests.index') }}">
                              Perawatan & Perbaikan
                           </a>
                           <a class="dropdown-item {{ request()->routeIs(['technician.employeepcdailychecks.index', 'technician.employeepcdailychecks.show']) ? 'active' : '' }}" href="{{ route('technician.employeepcdailychecks.index') }}">
                              Pemeriksaan Harian
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown {{ request()->routeIs(['technician.employeepcdailychecksreport.index', 'technician.employeepcdailychecksreport.showByMonthAndDivision', 'technician.employeepcdailychecksreport.show', 'technician.labusagesreport.index', 'technician.labusagesreport.showByIndex', 'technician.labusagesreport.show', 'technician.labrequestsreport.index', 'technician.labrequestsreport.showByIndex', 'technician.labrequestsreport.show', 'technician.labdailychecksreport.index', 'technician.labdailychecksreport.showByIndex', 'technician.labdailychecksreport.show']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                           <path d="M18 14v4h4" />
                           <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                           <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                           <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                           <path d="M8 11h4" />
                           <path d="M8 15h3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Laporan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*employee-daily-check*') ? 'active' : '' }}" href="{{ route('technician.employeepcdailychecksreport.index') }}">
                              Pemeriksaan Harian PC
                           </a>
                           <a class="dropdown-item {{ Request::is('*lab-usages*') ? 'active' : '' }}" href="{{ route('technician.labusagesreport.index') }}">
                              Penggunaan Lab Komputer
                           </a>
                        </div>
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*lab-requests*') ? 'active' : '' }}" href="{{ route('technician.labrequestsreport.index') }}">
                              Permohonan Penggunaan Lab
                           </a>
                           <a class="dropdown-item {{ Request::is('*lab-daily-check*') ? 'active' : '' }}" href="{{ route('technician.labdailychecksreport.index') }}">
                              Pemeriksaan Harian Lab
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 5)
               <li class="nav-item {{ Request::is('*repair-requests*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('employee.repairrequests.index') }}">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-world-cog">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M21 12a9 9 0 1 0 -8.979 9" />
                           <path d="M3.6 9h16.8" />
                           <path d="M3.6 15h8.9" />
                           <path d="M11.5 3a17 17 0 0 0 0 18" />
                           <path d="M12.5 3a16.992 16.992 0 0 1 2.522 10.376" />
                           <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                           <path d="M19.001 15.5v1.5" />
                           <path d="M19.001 21v1.5" />
                           <path d="M22.032 17.25l-1.299 .75" />
                           <path d="M17.27 20l-1.3 .75" />
                           <path d="M15.97 17.25l1.3 .75" />
                           <path d="M20.733 20l1.3 .75" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Layanan Teknis
                     </span>
                  </a>
               </li>
               <li class="nav-item dropdown {{ request()->routeIs(['employee.networkdev.index', 'employee.networkdev.show', 'employee.networktroubleshooting.index', 'employee.networktroubleshooting.show']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-broadcast-tower">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                           <path d="M16.616 13.924a5 5 0 1 0 -9.23 0" />
                           <path d="M20.307 15.469a9 9 0 1 0 -16.615 0" />
                           <path d="M9 21l3 -9l3 9" />
                           <path d="M10 19h4" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Layanan Jaringan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*network-development*') ? 'active' : '' }}" href="{{ route('employee.networkdev.index') }}">
                              Pengembangan Koneksi Jaringan
                           </a>
                           <a class="dropdown-item {{ Request::is('*network-troubleshooting*') ? 'active' : '' }}" href="{{ route('employee.networktroubleshooting.index') }}">
                              Penanganan Gangguan Jaringan
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown {{ request()->routeIs(['employee.webdevelopment.index', 'employee.webdevelopment.show', 'employee.webmaintenance.index', 'employee.webmaintenance.show']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                           <path d="M7 20l10 0" />
                           <path d="M9 16l0 4" />
                           <path d="M15 16l0 4" />
                           <path d="M8 12l3 -3l2 2l3 -3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Layanan IT
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*web-development*') ? 'active' : '' }}" href="{{ route('employee.webdevelopment.index') }}">
                              Pengembangan Web Aplikasi
                           </a>
                           <a class="dropdown-item {{ Request::is('*web-maintenance*') ? 'active' : '' }}" href="{{ route('employee.webmaintenance.index') }}">
                              Maintenance Sistem
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 7)
               <li class="nav-item dropdown {{ request()->routeIs(['puskom.networkdev.index', 'puskom.networkdev.show', 'puskom.networktroubleshooting.index', 'puskom.networktroubleshooting.edit', 'puskom.wifichecking.index', 'puskom.wifichecking.create', 'puskom.wifichecking.edit']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-broadcast-tower">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                           <path d="M16.616 13.924a5 5 0 1 0 -9.23 0" />
                           <path d="M20.307 15.469a9 9 0 1 0 -16.615 0" />
                           <path d="M9 21l3 -9l3 9" />
                           <path d="M10 19h4" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Jaringan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*puskom/network-development*') ? 'active' : '' }}" href="{{ route('puskom.networkdev.index') }}">
                              Pengembangan Koneksi
                           </a>
                           <a class="dropdown-item {{ Request::is('*puskom/network-troubleshooting*') ? 'active' : '' }}" href="{{ route('puskom.networktroubleshooting.index') }}">
                              Penanganan Koneksi
                           </a>
                           <a class="dropdown-item {{ Request::is('*puskom/wifi-checking*') ? 'active' : '' }}" href="{{ route('puskom.wifichecking.index') }}">
                              Pengecekan Wifi
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown {{ request()->routeIs(['puskom.webdevelopment.index', 'puskom.webdevelopment.show', 'puskom.webmaintenance.index', 'puskom.webmaintenance.show', 'puskom.appchecking.index', 'puskom.appchecking.show', 'puskom.webassignment.index', 'puskom.webassignment.show']) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                           <path d="M7 20l10 0" />
                           <path d="M9 16l0 4" />
                           <path d="M15 16l0 4" />
                           <path d="M8 12l3 -3l2 2l3 -3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Web Aplikasi
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*puskom/web-development*') ? 'active' : '' }}" href="{{ route('puskom.webdevelopment.index') }}">
                              Pengembangan Sistem
                           </a>
                           <a class="dropdown-item {{ Request::is('*puskom/web-maintenance*') ? 'active' : '' }}" href="{{ route('puskom.webmaintenance.index') }}">
                              Maintenance Sistem
                           </a>
                           <a class="dropdown-item {{ Request::is('*puskom/app-checking*') ? 'active' : '' }}" href="{{ route('puskom.appchecking.index') }}">
                              Pengecekan Sistem
                           </a>
                           <a class="dropdown-item {{ Request::is('*puskom/web-assignment*') ? 'active' : '' }}" href="{{ route('puskom.webassignment.index') }}">
                              Penugasan Programmer
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown {{ request()->routeIs(
                  [
                     'puskom.networktroubleshootingsreport.index', 'puskom.networktroubleshootingsreport.showByIndex', 'puskom.networktroubleshootingsreport.show',
                     'puskom.webdevelopmentsreport.index', 'puskom.webdevelopmentsreport.showByIndex', 'puskom.webdevelopmentsreport.show',
                     'puskom.webmaintenancesreport.index', 'puskom.webmaintenancesreport.showByIndex', 'puskom.webmaintenancesreport.show',
                     'puskom.wificheckingsreport.index', 'puskom.wificheckingsreport.showByIndex', 'puskom.wificheckingsreport.show',
                     'puskom.networkdevreport.index', 'puskom.networkdevreport.showByIndex', 'puskom.networkdevreport.show',
                     'puskom.appcheckingsreport.index', 'puskom.appcheckingsreport.showByIndex', 'puskom.appcheckingsreport.show',
                     'puskom.webassignmentreport.index', 'puskom.webassignmentreport.showByIndex', 'puskom.webassignmentreport.show',
                  ]
               ) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                           <path d="M18 14v4h4" />
                           <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                           <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                           <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                           <path d="M8 11h4" />
                           <path d="M8 15h3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Laporan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*report/web-development*') ? 'active' : '' }}" href="{{ route('puskom.webdevelopmentsreport.index') }}">
                              Pengembangan Web
                           </a>
                           <a class="dropdown-item {{ Request::is('*report/web-maintenance*') ? 'active' : '' }}" href="{{ route('puskom.webmaintenancesreport.index') }}">
                              Web Maintenance
                           </a>
                           <a class="dropdown-item {{ Request::is('*report/web-checking*') ? 'active' : '' }}" href="{{ route('puskom.appcheckingsreport.index') }}">
                              Pengecekan Web
                           </a>
                           <a class="dropdown-item {{ Request::is('*report/web-assignment*') ? 'active' : '' }}" href="{{ route('puskom.webassignmentreport.index') }}">
                              Penugasan Web Informasi
                           </a>
                        </div>
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*report/network-development*') ? 'active' : '' }}" href="{{ route('puskom.networkdevreport.index') }}">
                              Pengembangan Koneksi Jaringan
                           </a>
                           <a class="dropdown-item {{ Request::is('*report/network-troubleshooting*') ? 'active' : '' }}" href="{{ route('puskom.networktroubleshootingsreport.index') }}">
                              Penanganan Gangguan Jaringan
                           </a>
                           <a class="dropdown-item {{ Request::is('*report/wifi-checking*') ? 'active' : '' }}" href="{{ route('puskom.wificheckingsreport.index') }}">
                              Pengecekan Wifi
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 8)
               <li class="nav-item dropdown {{ request()->routeIs(
                  [
                     'vicerector.repairrequests.index', 'vicerector.repairrequests.show', 
                     'vicerector.employeepcdailychecks.index', 'vicerector.employeepcdailychecks.showByMonthAndDivision', 'vicerector.employeepcdailychecks.show', 
                     'vicerector.labusagesreport.index', 'vicerector.labusagesreport.showByIndex', 'vicerector.labusagesreport.show', 
                     'vicerector.labdailychecksreport.index', 'vicerector.labdailychecksreport.showByIndex', 'vicerector.labdailychecksreport.show',
                     'vicerector.labrequestsreport.index', 'vicerector.labrequestsreport.showByIndex', 'vicerector.labrequestsreport.show', 
                     'vicerector.networktroubleshootingsreport.index', 'vicerector.networktroubleshootingsreport.showByIndex', 'vicerector.networktroubleshootingsreport.show', 
                     'vicerector.webdevelopmentsreport.index', 'vicerector.webdevelopmentsreport.showByIndex', 'vicerector.webdevelopmentsreport.show', 
                     'vicerector.webmaintenancesreport.index', 'vicerector.webmaintenancesreport.showByIndex', 'vicerector.webmaintenancesreport.show',
                     'vicerector.networkdevreport.index', 'vicerector.networkdevreport.showByIndex', 'vicerector.networkdevreport.show'
                  ]
               ) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                           <path d="M18 14v4h4" />
                           <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                           <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                           <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                           <path d="M8 11h4" />
                           <path d="M8 15h3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Laporan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">

                           <div class="dropend">
                              <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                Lab
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item {{ Request::is('*lab-daily-check*') ? 'active' : '' }}" href="{{ route('vicerector.labdailychecksreport.index') }}">
                                    Pemeriksaan Harian Lab
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*lab-requests*') ? 'active' : '' }}" href="{{ route('vicerector.labrequestsreport.index') }}">
                                    Permohonan Penggunaan Lab
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*lab-usages*') ? 'active' : '' }}" href="{{ route('vicerector.labusagesreport.index') }}">
                                    Penggunaan Lab Komputer
                                 </a>
                              </div>
                           </div>
                           <div class="dropend">
                              <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                Jaringan
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item {{ Request::is('*vicerector/network-development*') ? 'active' : '' }}" href="{{ route('vicerector.networkdevreport.index') }}">
                                    Pengembangan Koneksi
                                 </a>
                              </div>
                           </div>
                           <a class="dropdown-item {{ Request::is('*repair-requests*') ? 'active' : '' }}" href="{{ route('vicerector.repairrequests.index') }}">
                              Perawatan & Perbaikan Pc Staff
                           </a>
                           <a class="dropdown-item {{ Request::is('*employee-daily-check*') ? 'active' : '' }}" href="{{ route('vicerector.employeepcdailychecks.index') }}">
                              Pemeriksaan Harian PC
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 9)
               <li class="nav-item dropdown {{ request()->routeIs([ 
                  'vicerector.wificheckingsreport.index', 'vicerector.wificheckingsreport.showByIndex', 'vicerector.wificheckingsreport.show', 
                  'vicerector.appcheckingsreport.index', 'vicerector.appcheckingsreport.showByIndex', 'vicerector.appcheckingsreport.show', 
                  'vicerector.webmaintenancesreport.index', 'vicerector.webmaintenancesreport.showByIndex', 'vicerector.webmaintenancesreport.show', 
                  'vicerector.networktroubleshootingsreport.index', 'vicerector.networktroubleshootingsreport.showByIndex', 'vicerector.networktroubleshootingsreport.show', 
                  'vicerector.webdevelopmentsreport.index', 'vicerector.webdevelopmentsreport.showByIndex', 'vicerector.webdevelopmentsreport.show',
                  'vicerector.networkdevreport.index', 'vicerector.networkdevreport.showByIndex', 'vicerector.networkdevreport.show',
                  'vicerector.webassignmentreport.index', 'vicerector.webassignmentreport.showByIndex', 'vicerector.webassignmentreport.show',
                  ]) ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                           <path d="M18 14v4h4" />
                           <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                           <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                           <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                           <path d="M8 11h4" />
                           <path d="M8 15h3" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Laporan
                     </span>
                  </a>
                  <div class="dropdown-menu">
                     <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                           <a class="dropdown-item {{ Request::is('*vicerector/wifi-checking*') ? 'active' : '' }}" href="{{ route('vicerector.wificheckingsreport.index') }}">
                              Pengecekan Wifi
                           </a>
                           <a class="dropdown-item {{ Request::is('*vicerector/web-checking*') ? 'active' : '' }}" href="{{ route('vicerector.appcheckingsreport.index') }}">
                              Pengecekan Web Aplikasi
                           </a>
                           <div class="dropend">
                              <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                Jaringan
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item {{ Request::is('*vicerector/network-development*') ? 'active' : '' }}" href="{{ route('vicerector.networkdevreport.index') }}">
                                    Pengembangan Koneksi Jaringan
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*vicerector/network-troubleshooting*') ? 'active' : '' }}" href="{{ route('vicerector.networktroubleshootingsreport.index') }}">
                                    Penanganan Gangguan Jaringan
                                 </a>
                              </div>
                           </div>
                           <div class="dropend">
                              <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                Web Aplikasi
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item {{ Request::is('*vicerector/web-development*') ? 'active' : '' }}" href="{{ route('vicerector.webdevelopmentsreport.index') }}">
                                    Pengembangan Web
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*vicerector/web-maintenance*') ? 'active' : '' }}" href="{{ route('vicerector.webmaintenancesreport.index') }}">
                                    Web Maintenance
                                 </a>
                                 <a class="dropdown-item {{ Request::is('*vicerector/web-assignment*') ? 'active' : '' }}" href="{{ route('vicerector.webassignmentreport.index') }}">
                                    Penugasan Web Informasi
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
               @elseif (Auth::user()->role_id == 10)
               <li class="nav-item {{ request()->routeIs(['programmer.webassignment.index']) ? 'active' : ''}}">
                  <a class="nav-link" href="{{ route('programmer.webassignment.index') }}">
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M13 5h8" />
                           <path d="M13 9h5" />
                           <path d="M13 15h8" />
                           <path d="M13 19h5" />
                           <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                           <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                     </span>
                     <span class="nav-link-title">
                        Penugasan Web Informasi
                     </span>
                  </a>
               </li>
               @endif
            </ul>
         </div>
      </div>
   </div>
</header>


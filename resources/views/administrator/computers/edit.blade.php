@extends('layouts.app')
@section('content')

@include('components.notification-handler')
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               <ol class="breadcrumb breadcrumb-arrows">
                  <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('computers.index') }}">Komputer</a></li>
                  <li class="breadcrumb-item active"><a href="#">Edit</a></li>
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
            <form action="{{ route('computers.update', ['computer' => $computer]) }}" method="post" enctype="multipart/form-data">
               @csrf
               @method('put')
               <div class="col d-flex flex-column">
                  <div class="card-body">
                     <h2 class="mb-4">Data Komputer</h2>
                     <div class="row g-3 mt-4">
                        <div class="col-md">
                           <div class="form-label required">Nama</div>
                           <input type="text" placeholder="Masukkan nama"
                              class="form-control @error('name') is-invalid @enderror" value="{{ $computer->name }}"
                              name="name" autocomplete='off'>
                           <x-invalid-feedback field='name'></x-invalid-feedback>
                        </div>
                        <div class="col-md">
                           <div class="form-label required">Labolatorium</div>
                           <select type="text" class="form-select @error('lab_id') is-invalid @enderror" name="lab_id" id="select-optgroups">
                              <option disabled>Pilih lab</option>
                              @foreach ($labs as $item)
                                  <option value="{{ $item->id }}" {{ $computer->lab_id == $item->id ? 'selected' : '' }}>
                                      {{ $item->name }}
                                  </option>
                              @endforeach
                          </select>                          
                           <x-invalid-feedback field='lab_id'></x-invalid-feedback>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer bg-transparent mt-auto">
                     <div class="btn-list justify-content-end">
                        <a href="{{ route('computers.index') }}" class="btn">
                           Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                           Simpan
                        </button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
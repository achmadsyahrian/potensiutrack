@extends('layouts.app')
@section('content')

@include('components.notification-handler')
<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               <ol class="breadcrumb breadcrumb-arrows">
                  <li class="breadcrumb-item"><a href="#">Layanan</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('puskom.wifichecking.index') }}">Pengecekan Wifi</a></li>
                  <li class="breadcrumb-item active"><a href="#">Tambah</a></li>
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
            <form action="{{ route('puskom.wifichecking.store') }}" method="post">
               @csrf
               @method('post')
               <div class="col d-flex flex-column">
                  <div class="card-body">
                     <h2 class="mb-4">Data Permohonan</h2>
                        <div class="row g-3 mt-4">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Tanggal</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
                                    <x-invalid-feedback field='date'></x-invalid-feedback>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Lokasi</label>
                                    <select type="text" class="form-select @error('building_id') is-invalid @enderror" name="building_id" id="select-optgroups" value="">
                                    <option selected disabled>Pilih lokasi</option>
                                    @foreach ($buildings as $item)
                                      <option value="{{ $item->id }}" {{ old('building_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                    </select>
                                    <x-invalid-feedback field='building_id'></x-invalid-feedback>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
                                            <thead>
                                              <tr>
                                                <th colspan="5">Lantai 1 :</th>
                                                <th class="text-end">
                                                  <button type="button" id="add-lantai1" class="btn btn-teal btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                      <path d="M12 5l0 14" />
                                                      <path d="M5 12l14 0" />
                                                    </svg>
                                                  </button>
                                                </th>
                                              </tr>
                                            </thead>
                                            <tbody id="floor1-table-body">
                                            </tbody>
                                          </thead>
                                          <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
                                            <thead>
                                              <tr>
                                                <th colspan="5">Lantai 2 :</th>
                                                <th class="text-end">
                                                  <button type="button" id="add-lantai2" class="btn btn-teal btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                      <path d="M12 5l0 14" />
                                                      <path d="M5 12l14 0" />
                                                    </svg>
                                                  </button>
                                                </th>
                                              </tr>
                                            </thead>
                                            <tbody id="floor2-table-body">
                                            </tbody>
                                        </table>   
                                        <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
                                          <thead>
                                            <tr>
                                              <th colspan="5">Lantai 3 :</th>
                                              <th class="text-end">
                                                <button type="button" id="add-lantai3" class="btn btn-teal btn-icon">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 5l0 14" />
                                                    <path d="M5 12l14 0" />
                                                  </svg>
                                                </button>
                                              </th>
                                            </tr>
                                          </thead>
                                          <tbody id="floor3-table-body">
                                          </tbody>
                                      </table>
                                      <table class="table card-table table-vcenter text-nowrap datatable" id="my-table">
                                        <thead>
                                          <tr>
                                            <th colspan="5">Lantai 4 :</th>
                                            <th class="text-end">
                                              <button type="button" id="add-lantai4" class="btn btn-teal btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                  <path d="M12 5l0 14" />
                                                  <path d="M5 12l14 0" />
                                                </svg>
                                              </button>
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody id="floor4-table-body">
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <a href="{{ route('puskom.wifichecking.index') }}" class="btn">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  
    $(document).ready(function() {
      // Floor 1 Code
      var floor1Number = 1;
        $('#add-lantai1').click(function() { addNewRowFloor1(floor1Number); });
          function addNewRowFloor1(accessPointNumber) {
          var newRow = '<tr>' +
              '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
              '<td><input type="text" style="width:230px;" class="form-control" name="floor1_device_name[]" placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor1_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
              '<td><input type="text" style="width:200px;" class="form-control" name="floor1_condition[]" placeholder="Masukkan kondisi perangkat"></td>' +
              '<td><input type="text" style="width:230px;" class="form-control" name="floor1_description[]" placeholder="Keterangan"></td>' +
              '<td><div class="btn-list justify-content-end flex-nowrap"><button type="button" class="btn btn-outline-danger delete-lantai1">Hapus</button></div></td>' +
              '</tr>';

          $('#floor1-table-body').append(newRow);
          $(document).on('click', '.delete-lantai1', function() { $(this).closest('tr').remove(); });
          floor1Number++;
        }
      
      // Floor 2 Code
      var floor2Number = 1;
      $('#add-lantai2').click(function() { addNewRowFloor2(floor2Number); });

      function addNewRowFloor2(accessPointNumber) {
          var newRow = '<tr>' +
          '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
          '<td><input type="text" style="width:230px;" class="form-control" name="floor2_device_name[]" placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor2_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
          '<td><input type="text" style="width:200px;" class="form-control" name="floor2_condition[]" placeholder="Masukkan kondisi perangkat"></td>' +
          '<td><input type="text" style="width:230px;" class="form-control" name="floor2_description[]" placeholder="Keterangan"></td>' +
          '<td><div class="btn-list justify-content-end flex-nowrap"><button type="button" class="btn btn-outline-danger delete-lantai2">Hapus</button></div></td>' +
          '</tr>';

          $('#floor2-table-body').append(newRow);

          $(document).on('click', '.delete-lantai2', function() {
          $(this).closest('tr').remove();
          });

          floor2Number++;
      }

      // Floor 3 Code
      var floor3Number = 1;
      $('#add-lantai3').click(function() { addNewRowFloor3(floor3Number); });

      function addNewRowFloor3(accessPointNumber) {
          var newRow = '<tr>' +
          '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
          '<td><input type="text" style="width:230px;" class="form-control" name="floor3_device_name[]" placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor3_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
          '<td><input type="text" style="width:200px;" class="form-control" name="floor3_condition[]" placeholder="Masukkan kondisi perangkat"></td>' +
          '<td><input type="text" style="width:230px;" class="form-control" name="floor3_description[]" placeholder="Keterangan"></td>' +
          '<td><div class="btn-list justify-content-end flex-nowrap"><button type="button" class="btn btn-outline-danger delete-lantai3">Hapus</button></div></td>' +
          '</tr>';

          $('#floor3-table-body').append(newRow);

          $(document).on('click', '.delete-lantai3', function() {
          $(this).closest('tr').remove();
          });

          floor3Number++;
      }


      // Floor 3 Code
      var floor4Number = 1;
      $('#add-lantai4').click(function() { addNewRowFloor4(floor4Number); });

      function addNewRowFloor4(accessPointNumber) {
          var newRow = '<tr>' +
          '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
          '<td><input type="text" style="width:230px;" class="form-control" name="floor4_device_name[]" placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor4_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
          '<td><input type="text" style="width:200px;" class="form-control" name="floor4_condition[]" placeholder="Masukkan kondisi perangkat"></td>' +
          '<td><input type="text" style="width:230px;" class="form-control" name="floor4_description[]" placeholder="Keterangan"></td>' +
          '<td><div class="btn-list justify-content-end flex-nowrap"><button type="button" class="btn btn-outline-danger delete-lantai4">Hapus</button></div></td>' +
          '</tr>';

          $('#floor4-table-body').append(newRow);

          $(document).on('click', '.delete-lantai4', function() {
          $(this).closest('tr').remove();
          });

          floor4Number++;
      }
    });


</script>


@endsection

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
            <form action="{{ route('puskom.wifichecking.update', ['wifi_checking' => $wifiChecking]) }}" method="post">
               @csrf
               @method('patch')
               <div class="col d-flex flex-column">
                  <div class="card-body">
                     <h2 class="mb-4">Data Permohonan</h2>
                        <div class="row g-3 mt-4">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" name="date" value="{{ \Carbon\Carbon::parse($wifiChecking->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" name="date" value="{{ $wifiChecking->building->name }}" readonly>
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
<?php
  $floor1Data = json_decode($wifiChecking->floor_1, true); // Set true untuk mengembalikan array
  $floor2Data = json_decode($wifiChecking->floor_2, true);
  $floor3Data = json_decode($wifiChecking->floor_3, true);
  $floor4Data = json_decode($wifiChecking->floor_4, true);

  // Hitung jumlah elemen dalam setiap array
  $floor1Count = [
    'accesspoint' => isset($floor1Data['accesspoint']) ? count($floor1Data['accesspoint']) : 0,
    'condition' => isset($floor1Data['condition']) ? count($floor1Data['condition']) : 0,
    'device_name' => isset($floor1Data['device_name']) ? count($floor1Data['device_name']) : 0,
    'description' => isset($floor1Data['description']) ? count($floor1Data['description']) : 0,
  ];
  
  $floor2Count = [
    'accesspoint' => isset($floor2Data['accesspoint']) ? count($floor2Data['accesspoint']) : 0,
    'condition' => isset($floor2Data['condition']) ? count($floor2Data['condition']) : 0,
    'device_name' => isset($floor2Data['device_name']) ? count($floor2Data['device_name']) : 0,
    'description' => isset($floor2Data['description']) ? count($floor2Data['description']) : 0,
  ];

  $floor3Count = [
    'accesspoint' => isset($floor3Data['accesspoint']) ? count($floor3Data['accesspoint']) : 0,
    'condition' => isset($floor3Data['condition']) ? count($floor3Data['condition']) : 0,
    'device_name' => isset($floor3Data['device_name']) ? count($floor3Data['device_name']) : 0,
    'description' => isset($floor3Data['description']) ? count($floor3Data['description']) : 0,
  ];

  $floor4Count = [
    'accesspoint' => isset($floor4Data['accesspoint']) ? count($floor4Data['accesspoint']) : 0,
    'condition' => isset($floor4Data['condition']) ? count($floor4Data['condition']) : 0,
    'device_name' => isset($floor4Data['device_name']) ? count($floor4Data['device_name']) : 0,
    'description' => isset($floor4Data['description']) ? count($floor4Data['description']) : 0,
  ];

  // Data
  $floor1Json = json_encode($floor1Data);
  $floor2Json = json_encode($floor2Data);
  $floor3Json = json_encode($floor3Data);
  $floor4Json = json_encode($floor4Data);

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    var floor1Count = <?php echo json_encode($floor1Count); ?>;
    var floor2Count = <?php echo json_encode($floor2Count); ?>;
    var floor3Count = <?php echo json_encode($floor3Count); ?>;
    var floor4Count = <?php echo json_encode($floor4Count); ?>;

    // Data
    var floor1Data = JSON.parse('<?php echo $floor1Json; ?>');
    var floor2Data = JSON.parse('<?php echo $floor2Json; ?>');
    var floor3Data = JSON.parse('<?php echo $floor3Json; ?>');
    var floor4Data = JSON.parse('<?php echo $floor4Json; ?>');

    for (var i = 1; i <= floor1Count['accesspoint']; i++) {
      addNewRowFloor1(i);
    }
    for (var j = 1; j <= floor2Count['accesspoint']; j++) {
      addNewRowFloor2(j);
    }
    for (var k = 1; k <= floor3Count['accesspoint']; k++) {
      addNewRowFloor3(k);
    }
    for (var l = 1; l <= floor4Count['accesspoint']; l++) {
      addNewRowFloor4(l);
    }

    var floor1AccessPointNumber = floor1Data && floor1Data['accesspoint'] ? floor1Data['accesspoint'].length : 0;
    var floor2AccessPointNumber = floor2Data && floor2Data['accesspoint'] ? floor2Data['accesspoint'].length : 0;
    var floor3AccessPointNumber = floor3Data && floor3Data['accesspoint'] ? floor3Data['accesspoint'].length : 0;
    var floor4AccessPointNumber = floor4Data && floor4Data['accesspoint'] ? floor4Data['accesspoint'].length : 0;




    $('#add-lantai1').click(function() {
        if (floor1AccessPointNumber) {
            floor1AccessPointNumber++;
            addNewRowFloor1(floor1AccessPointNumber);
        } else {
            floor1AccessPointNumber = 1;
            addNewRowFloor1(floor1AccessPointNumber);
        }
    });

    $('#add-lantai2').click(function() {
        if (floor2AccessPointNumber) {
            floor2AccessPointNumber++;
            addNewRowFloor2(floor2AccessPointNumber);
        } else {
            floor2AccessPointNumber = 1;
            addNewRowFloor2(floor2AccessPointNumber);
        }
    });

    $('#add-lantai3').click(function() {
        if (floor3AccessPointNumber) {
            floor3AccessPointNumber++;
            addNewRowFloor3(floor3AccessPointNumber);
        } else {
            floor3AccessPointNumber = 1;
            addNewRowFloor3(floor3AccessPointNumber);
        }
    });
      $('#add-lantai4').click(function() {
        floor4AccessPointNumber++;
        addNewRowFloor4(floor4AccessPointNumber);
      });

      // Definisikan variabel floorNumber sebelum digunakan
      var floor1Number = <?php echo $floor1Count['accesspoint']; ?>;
      var floor2Number = <?php echo $floor2Count['accesspoint']; ?>;
      var floor3Number = <?php echo $floor3Count['accesspoint']; ?>;
      var floor4Number = <?php echo $floor4Count['accesspoint']; ?>;


      // Definisikan fungsi untuk menambah baris baru pada setiap lantai
      function addNewRowFloor1(accessPointNumber) {
        var deviceName = (floor1Data && floor1Data['device_name'].length > (accessPointNumber - 1)) ? floor1Data['device_name'][accessPointNumber - 1] : '';
        var condition = (floor1Data && floor1Data['condition'].length > (accessPointNumber - 1)) ? floor1Data['condition'][accessPointNumber - 1] : '';
        var description = (floor1Data && floor1Data['description'].length > (accessPointNumber - 1)) ? floor1Data['description'][accessPointNumber - 1] : '';

        
          var newRow = '<tr>' +
              '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
              '<td><input type="text" style="width:230px;" class="form-control" name="floor1_device_name[]"  value="' + deviceName + '"  placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor1_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
              '<td><input type="text" style="width:200px;" class="form-control" name="floor1_condition[]" value="' + condition + '" placeholder="Masukkan kondisi perangkat"></td>' +
              '<td><input type="text" style="width:230px;" class="form-control" name="floor1_description[]" value="' + description + '" placeholder="Keterangan"></td>' +
              '<td><div class="btn-list justify-content-end flex-nowrap"><button type="button" class="btn btn-outline-danger delete-lantai1">Hapus</button></div></td>' +
              '</tr>';

          $('#floor1-table-body').append(newRow);
          $(document).on('click', '.delete-lantai1', function() { $(this).closest('tr').remove(); });
          floor1Number++;
      }
      function addNewRowFloor2(accessPointNumber) {
          var deviceName = (floor2Data && floor2Data['device_name'].length > (accessPointNumber - 1)) ? floor2Data['device_name'][accessPointNumber - 1] : '';
          var condition = (floor2Data && floor2Data['condition'].length > (accessPointNumber - 1)) ? floor2Data['condition'][accessPointNumber - 1] : '';
          var description = (floor2Data && floor2Data['description'].length > (accessPointNumber - 1)) ? floor2Data['description'][accessPointNumber - 1] : '';
        
          var newRow = '<tr>' +
            '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
            '<td><input type="text" style="width:230px;" class="form-control" name="floor2_device_name[]" value="' + deviceName + '" placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor2_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
            '<td><input type="text" style="width:200px;" class="form-control" name="floor2_condition[]" value="' + condition + '" placeholder="Masukkan kondisi perangkat"></td>' +
            '<td><input type="text" style="width:230px;" class="form-control" name="floor2_description[]" value="' + description + '" placeholder="Keterangan"></td>' +
            '<td><div class="btn-list justify-content-end flex-nowrap"><button type="button" class="btn btn-outline-danger delete-lantai2">Hapus</button></div></td>' +
            '</tr>';

            $('#floor2-table-body').append(newRow);

            $(document).on('click', '.delete-lantai2', function() {
              $(this).closest('tr').remove();
            });

            floor2Number++;
      }
      function addNewRowFloor3(accessPointNumber) {
          var deviceName = (floor3Data && floor3Data['device_name'].length > (accessPointNumber - 1)) ? floor3Data['device_name'][accessPointNumber - 1] : '';
          var condition = (floor3Data && floor3Data['condition'].length > (accessPointNumber - 1)) ? floor3Data['condition'][accessPointNumber - 1] : '';
          var description = (floor3Data && floor3Data['description'].length > (accessPointNumber - 1)) ? floor3Data['description'][accessPointNumber - 1] : '';
          
          var newRow = '<tr>' +
            '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
            '<td><input type="text" style="width:230px;" class="form-control" name="floor3_device_name[]" value="' + deviceName + '" placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor3_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
            '<td><input type="text" style="width:200px;" class="form-control" name="floor3_condition[]" value="' + condition + '" placeholder="Masukkan kondisi perangkat"></td>' +
            '<td><input type="text" style="width:230px;" class="form-control" name="floor3_description[]" value="' + description + '" placeholder="Keterangan"></td>' +
            '<td><div class="btn-list justify-content-end flex-nowrap"><button type="button" class="btn btn-outline-danger delete-lantai3">Hapus</button></div></td>' +
            '</tr>';

            $('#floor3-table-body').append(newRow);

            $(document).on('click', '.delete-lantai3', function() {
            $(this).closest('tr').remove();
            });

            floor3Number++;
      }
      function addNewRowFloor4(accessPointNumber) {
        var deviceName = (floor4Data && floor4Data['device_name'].length > (accessPointNumber - 1)) ? floor4Data['device_name'][accessPointNumber - 1] : '';
        var condition = (floor4Data && floor4Data['condition'].length > (accessPointNumber - 1)) ? floor4Data['condition'][accessPointNumber - 1] : '';
        var description = (floor4Data && floor4Data['description'].length > (accessPointNumber - 1)) ? floor4Data['description'][accessPointNumber - 1] : '';

        var newRow = '<tr>' +
          '<td>Accesspoint ' + accessPointNumber + '</td>' + // No floor number prefix
          '<td><input type="text" style="width:230px;" class="form-control" name="floor4_device_name[]" value="' + deviceName + '" placeholder="Masukkan nama perangkat"> <input type="hidden" name="floor4_accesspoint[]" value="Accesspoint ' + accessPointNumber + '"></td>' +
          '<td><input type="text" style="width:200px;" class="form-control" name="floor4_condition[]" value="' + condition + '" placeholder="Masukkan kondisi perangkat"></td>' +
          '<td><input type="text" style="width:230px;" class="form-control" name="floor4_description[]" value="' + description + '" placeholder="Keterangan"></td>' +
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


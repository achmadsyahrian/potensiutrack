<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

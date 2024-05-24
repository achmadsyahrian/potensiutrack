@extends('layouts.app')
@section('content')

@include('components.notification-handler')

<div class="page-header d-print-none">
   <div class="container-xl">
      <div class="row g-2 align-items-center">
         <div class="col">
            <div class="page-pretitle">
               <ol class="breadcrumb breadcrumb-arrows">
                  <li class="breadcrumb-item"><a href="#">Lab</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('headaslab.labdailychecksreport.index') }}">Pemeriksaan Harian Lab</a></li>
                  <li class="breadcrumb-item active"><a href="#">Lihat</a></li>
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
            <div class="col d-flex flex-column">
               <div class="card-body">
                  <h2 class="mb-4">Data Laporan</h2>
                  <div class="row g-3 mt-4">
                     <div class="col-md">
                        <label class="form-label">Lab</label>
                        <input type="text" class="form-control" value="{{ $labDailyCheck->lab->name }}" readonly>
                        <input type="hidden" id="lab-id" class="form-control" value="{{ $labDailyCheck->lab_id }}" readonly>
                        <x-invalid-feedback field='lab_id'></x-invalid-feedback>
                     </div>
                     <div class="col-md">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                           name="date" value="{{ $labDailyCheck->date }}"
                           autocomplete="off" readonly>                     
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        {{-- <label class="form-label mt-4">Laporan Harian</label> --}}
                           <div class="card mt-4">
                              <div class="table-responsive">
                                 <table class="table table-vcenter card-table" id="computer-table" style="display: none">
                                       
                                 </table>
                              </div>
                           </div>
                     </div>
                  </div>
               </div>
               <div class="card-footer bg-transparent mt-auto">
                  <div class="btn-list justify-content-end">
                     <a href="{{ route('headaslab.labdailychecksreport.index') }}" class="btn">
                        Kembali
                     </a>
                     <button type="submit" class="btn btn-primary">
                        Simpan
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   var labId = document.getElementById('lab-id').value;
   
   window.onload = function() {
      var computers = {!! $labDailyCheck->results !!};
      var table = document.querySelector('#computer-table'); // Ambil tabel
      var numberOfDevices = 4; // Karena Anda memiliki 4 perangkat tetap

      // Bersihkan isi tabel
      table.innerHTML = '';

      // Tambahkan baris untuk setiap perangkat di thead (sekarang ditampilkan secara horizontal)
      var theadRow = '<tr><th></th><th>Item</th>';
      for (let i = 1; i <= Object.keys(computers).length; i++) {
         theadRow += '<th>' + i + '</th>';
      }
      theadRow += '<th>Keterangan</th></tr>';
      table.innerHTML += '<thead>' + theadRow + '</thead>';

      // Tambahkan kolom untuk setiap perangkat di tbody (sekarang ditampilkan secara vertikal)
      var tbody = '<tbody>';
         for (let i = 0; i < numberOfDevices; i++) {
            tbody += '<tr><td></td><td>' + getDeviceName(i) + '</td>';
            Object.entries(computers).forEach(([computerId, device]) => {
               var isChecked = device[getDeviceName(i)] === 'on' ? 'checked' : ''; // Atur properti checked berdasarkan nilai dari JSON results

               // Tambahkan input tersembunyi dengan nilai default 'off'
               tbody += '<td><input type="hidden" name="results[' + computerId + '][' + getDeviceName(i) + ']" value="off">';
               tbody += '<input class="form-check-input m-0 align-middle" type="checkbox" onclick="return false;" name="results[' + computerId + '][' + getDeviceName(i) + ']" ' + isChecked + '></td>';
            });

            var descriptions = JSON.parse('{!! addslashes($labDailyCheck->descriptions) !!}'); // Mengonversi JSON menjadi objek JavaScript

            var description = '';
            if (descriptions && descriptions[getDeviceName(i)]) {
               description = descriptions[getDeviceName(i)]; // Menggunakan nilai deskripsi dari objek JavaScript jika ada
            }

            // Menambahkan textarea dengan nilai deskripsi dari database
            tbody += '<td><textarea name="descriptions[' + getDeviceName(i) + ']" id="" cols="" rows="1" class="form-control" style="width: 200px;" readonly>' + description + '</textarea></td>';
         }


      tbody += '</tbody>';
      table.innerHTML += tbody;

      // Tampilkan tabel
      table.style.display = 'table';

      // Tambahkan event listener untuk checkbox kontrol di thead
      document.getElementById('checkAll').addEventListener('click', function() {
         var checkboxes = document.querySelectorAll('#computer-table tbody input[type="checkbox"]');
         checkboxes.forEach(function(checkbox) {
               checkbox.checked = document.getElementById('checkAll').checked;
         });
      });

      // Fungsi untuk mendapatkan nama perangkat berdasarkan indeks
      function getDeviceName(index) {
         switch (index) {
               case 0:
                  return 'Mouse';
               case 1:
                  return 'Keyboard';
               case 2:
                  return 'Internet';
               case 3:
                  return 'Sistem';
               default:
                  return 'Unknown';
         }
      }
   };


</script>

@endsection
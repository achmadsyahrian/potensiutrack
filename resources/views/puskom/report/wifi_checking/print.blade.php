<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Print Penugasan Pembuatan dan Maintenance Web Sistem Informasi</title>
   <style>
      body {
         font-family: 'Times New Roman', Times, serif;
         margin: 20px;
      }
      /* Tabler title */
      .table-title {
         width: 100%;
         border-collapse: collapse;
         /* margin-bottom: 10px; */
      }

      .table-title,
      th,
      td {
         border: 1px solid black;
      }

      th,
      td {
         /* padding: 10px; */
         text-align: left;
      }

      th {
         background-color: #f2f2f2;
      }

      .table-title > td > img {
         display: block;
         margin: 0 auto;
      }

      .header-cell {
         text-align: center;
         vertical-align: middle;
      }

      /* Containter */
      .container {
         position:absolute; 
         top: 110;
         width:100%; 
         left:0;
         height: 400px;
      }
      .flex-container {
         display: flex;
         padding: 10px 4%;
         justify-content: space-between;
      }
      .flex-container p {
         margin: 0;
      }

      .container > .table-data {
         width: 100%;
         border-collapse: collapse;
         margin: auto;
      }
      .container > .table-data > thead > tr > th{
         background-color: #cdcdcd !important;
         padding: 2px;
         font-weight: 500;
         text-align: left;
         font-size: 13px;
         vertical-align: middle;
         border: 1px solid black;
      }
      .container > .table-data > tbody > tr > td {
         padding: 4px;
         border: 1px solid black;
         font-size: 10px;
         text-align: left;
         height: 7px;
      }
      
      .table-signature {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      .table-signature > tbody > tr > td {
         border: none;
      }
      
      .page-break {
         page-break-after: always;
      }
      
      header {
         position: fixed;
         top: 0;
         left: 0px;
         right: 0px;
         height: 50px;
         text-align: center;
      }
      
      footer {
         position: fixed;
         bottom: 0;
         width: 100%;
      }
      .page-num:before {
         content: counter(page);
      }

      
   </style>
</head>
<body>
   <header>
      <table class="table-title">
         <thead>
            <tr>
               <td rowspan="5" style="width: 100px; height: 90px; text-align: center; vertical-align: middle;">
                  <img src="{{ asset('image/Logopotensiutama.png') }}" alt="Logo" width="85px" style="text-align: center">
               </td>
               <td colspan="2"  class="header-cell">
                  <strong>DOKUMEN LEVEL</strong><br>FORM
               </td>
               <td class="header-cell" style="width: 30%;">
                  <strong>NO. DOKUMEN</strong><br>F-/SPMI/27-02-04
               </td>
            </tr>
            <tr>
               <td colspan="2" rowspan="2" class="header-cell" style="font-size: 13px;">
                  <strong>JUDUL</strong><br>LAPORAN PENGECEKAN WIFI
               </td>
               <td class="">
                  <span style="width: 120px; display: inline-block"> Tanggal Terbit </span> : 08 April 2019
               </td>
            </tr>
            <tr>
               <td class="">
                  <span style="width: 120px; display: inline-block"> Tanggal Efektif </span> : 15 April 2019
               </td>
            </tr>
            <tr>
               <td colspan="2" rowspan="2" class="header-cell">
                  <strong>AREA</strong><br>PUSKOM
               </td>
               <td class="">
                  <div id="page-num-container">
                     <span style="width: 120px; display: inline-block">Halaman</span> : <span class="page-num"></span> dari <span class="page-count">{!! session('pageCount') !!}</span>
                 </div>
               </td>
            </tr>
            <tr>
               <td class="header-cell">
                  <strong>NO. REVISI</strong><br>00
               </td>
            </tr>
         </thead>
      </table>
   </header>
   
   <footer>
      {{-- Signature Path --}}
      <div class="signature-path">
         {{-- <p style="margin: 4px 0;">Medan, {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('D MMMM YYYY') }}</p> --}}
         <table class="table-signature" >
             <tbody>
                 <tr>
                     <td style="text-align: left;">
                         Dibuat Oleh :
                     </td>
                     <td style="text-align: left;">
                         Diketahui Oleh :
                     </td>
                     <td style="text-align: left;">
                         Disetujui Oleh :
                     </td>
                 </tr>
                 <tr>
                     <td style="text-align: left;">
                         Staff PUSKOM
                     </td>
                     <td style="text-align: left;">
                         Kabag. Puskom
                     </td>
                     <td style="text-align: left;">
                         Wakil Rektor I
                     </td>
                 </tr>
                 <tr>
                     <td>
                         <img src="{{ asset('storage/'.$data->puskom_signature) }}" alt="Tanda Tangan Puskom" width="120" style="display: block; text-align: left;">
                     </td>
                     <td>
                         <img src="{{ asset('storage/'.$data->kabag_signature) }}" alt="Tanda Tangan Kabag" width="120">
                     </td>
                     <td>
                         <img src="{{ asset('storage/'.$data->wakil_rektor_signature) }}" alt="Tanda Tangan Wakil Rektor 2" width="120">
                     </td>
                 </tr>
                 <tr>
                  <td>
                     (M. Irfan Aldy Nasution, M.Kom)
                  </td>
                  <td>
                     (Soeheri M.Kom)
                  </td>
                  <td>
                     (Lili Tanti, M.Kom)
                  </td>
                 </tr>
             </tbody>
         </table>
         <p style="position: fixed; font-size:12px; left:10%; margin:auto;"><i>Dokumen ini milik Universitas Potensi Utama, Dilarang memperbanyak atau menggunakan informasi didalamnya tanpa persetujuan Universitas Potensi Utama</i></p>
     </div>
   </footer>
   <div class="container">
      <div class="flex-container" style="display: flex; justify-content: space-between; font-size:13px; font-weight:500;">
         <div style="position: absolute; left: 0; margin-bottom:10px;">
            <p>Laporan harian jaringan Perangkat Wifi di Universitas Potensi Utama pada : {{ \Carbon\Carbon::parse($data->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</p>
            <p>Jaringan : {{ $data->building->name }}</p>
         </div>
      </div>
      <table class="table-data" style="margin-top:35px;">
         <thead>
            <tr>
               <th colspan="5">Lantai 1 {{ $data->building->name }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($floor1Data['accesspoint'] as $index => $accesspoint)
            <tr>
               <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $accesspoint }}</td>
                <td>{{ $floor1Data['device_name'][$index] }}</td>
                <td>Kondisi Perangkat: {{ $floor1Data['condition'][$index] ?? '--' }}</td>
                <td>Keterangan: {{ $floor1Data['description'][$index] ?? '--' }}</td>
            </tr>
            @endforeach
         </tbody>
         <thead>
            <tr>
               <th colspan="5">Lantai 2 {{ $data->building->name }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($floor2Data['accesspoint'] as $index => $accesspoint)
            <tr>
               <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $accesspoint }}</td>
                <td>{{ $floor2Data['device_name'][$index] }}</td>
                <td>Kondisi Perangkat: {{ $floor2Data['condition'][$index] ?? '--' }}</td>
                <td>Keterangan: {{ $floor2Data['description'][$index] ?? '--' }}</td>
            </tr>
            @endforeach
         </tbody>

      </table>
   </div>

   <div class="page-break"></div>

   <div class="container">
      <div class="flex-container" style="display: flex; justify-content: space-between; font-size:13px; font-weight:500;">
         <div style="position: absolute; left: 0; margin-bottom:10px;">
            <p>Laporan harian jaringan Perangkat Wifi di Universitas Potensi Utama pada : {{ \Carbon\Carbon::parse($data->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</p>
            <p>Jaringan : {{ $data->building->name }}</p>
         </div>
      </div>
      <table class="table-data" style="margin-top:35px;">
         <thead>
            <tr>
               <th colspan="5">Lantai 3 {{ $data->building->name }}</th>
            </tr>
         </thead>
         <tbody>
            @if(isset($floor3Data['accesspoint']))
               @foreach ($floor3Data['accesspoint'] as $index => $accesspoint)
                     <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $accesspoint }}</td>
                        <td>{{ $floor3Data['device_name'][$index] ?? '--' }}</td>
                        <td>Kondisi Perangkat: {{ $floor3Data['condition'][$index] ?? '--' }}</td>
                        <td>Keterangan: {{ $floor3Data['description'][$index] ?? '--' }}</td>
                     </tr>
               @endforeach
            @else
               <tr>
                     <td colspan="5">Data tidak tersedia</td>
               </tr>
            @endif
         </tbody>
      </table>
   </div>

   <div class="page-break"></div>

   <div class="container">
      <div class="flex-container" style="display: flex; justify-content: space-between; font-size:13px; font-weight:500;">
         <div style="position: absolute; left: 0; margin-bottom:10px;">
            <p>Laporan harian jaringan Perangkat Wifi di Universitas Potensi Utama pada : {{ \Carbon\Carbon::parse($data->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</p>
            <p>Jaringan : {{ $data->building->name }}</p>
         </div>
      </div>
      <table class="table-data" style="margin-top:35px;">
         <thead>
            <tr>
               <th colspan="5">Lantai 4 {{ $data->building->name }}</th>
            </tr>
         </thead>
         <tbody>
            @if(isset($floor4Data['accesspoint']))
               @foreach ($floor4Data['accesspoint'] as $index => $accesspoint)
               <tr>
                  <td style="text-align: center;">{{ $index + 1 }}</td>
                  <td>{{ $accesspoint }}</td>
                  <td>{{ $floor4Data['device_name'][$index] }}</td>
                  <td>Kondisi Perangkat: {{ $floor4Data['condition'][$index] ?? '--' }}</td>
                  <td>Keterangan: {{ $floor4Data['description'][$index] ?? '--' }}</td>
               </tr>
               @endforeach
            @else
               <tr>
                     <td colspan="5">Data tidak tersedia</td>
               </tr>
            @endif
         </tbody>
      </table>
   </div>
</body>
</html>


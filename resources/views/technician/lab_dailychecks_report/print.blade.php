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

      .container > .table-data {
         width: 100%;
         border-collapse: collapse;
         margin: auto;
         /* page-break-after: always; */
      }
      .container > .table-data > thead > tr > th{
         background-color: #cdcdcd !important;
         padding: 2px;
         font-weight: 500;
         text-align: center;
         font-size: 13px;
         vertical-align: middle;
         border: 1px solid black;
      }
      .container > .table-data > tbody > tr > td {
         padding: 4px;
         border: 1px solid black;
         font-size: 10px;
         text-align: center;
         height: 7px;
      }
      
      .table-signature {
         width: 100%;
         border-collapse: collapse;
      }

      .table-signature > tbody > tr > td {
         border: none;
         padding-right: 10px
      }
      .table-desc > tbody > tr > td {
         border: none;
         /* width: 130px; */
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
         position: absolute;
         bottom: 0;
         width: 100%;
         /* padding: 10px; */
         text-align: center;
      }
      .page-num:before {
         content: counter(page);
      }

      .vertical-text {
         transform: rotate(-90deg);
      }
      
      footer > .footer-desc > .table-aslab {
         margin: 10px 0 15px 0;
         border-collapse: collapse;
      }
      footer > .footer-desc > .table-aslab > thead > tr > th{
         /* padding: 10px; */
         width: 150px;
         font-weight: 500;
         text-align: center;
         vertical-align: middle;
         border: 1px solid black;
      }
      footer > .footer-desc > .table-aslab > tbody > tr > td {
         /* padding: 10px; */
         border: 1px solid black;
         font-size: 12px;
         text-align: center;
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
                  <strong>NO. DOKUMEN</strong><br>F-/SPMI/26-01-03
               </td>
            </tr>
            <tr>
               <td colspan="2" rowspan="2" class="header-cell" style="font-size: 13px;">
                  <strong>JUDUL</strong><br>PEMERIKSAAN HARIAN PC LAB KOMPUTER
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

   <p style="position: fixed; font-size:12px; left:10%; margin:auto; bottom:-10;"><i>Dokumen ini milik Universitas Potensi Utama, Dilarang memperbanyak atau menggunakan informasi didalamnya tanpa persetujuan Universitas Potensi Utama</i></p>
   
   <div class="container">
      <div class="flex-container" style="display: flex; justify-content: space-between; font-size:13px; font-weight:500; background-color:grey; margin-bottom:40px;">
         <div style="position: absolute; left: 20; margin-bottom:10px;">
            <p>ASLAB : {{ $headAssistants }} </p>
         </div>
         <div style="position: absolute; right: 50%; margin-bottom:10px;">
               <p>BULAN: {{ $month }} {{ $year }}</p>
         </div>
         <div style="position: absolute; right: 20; margin-bottom:10px;">
               <p>LOKASI: {{ $labName }}</p>
         </div>
     </div>
     

      @php
         use Carbon\Carbon;

         // Generate an array of dates for the given month and year
         $startOfMonth = Carbon::create($year, $monthNumber, 1);
         $endOfMonth = $startOfMonth->copy()->endOfMonth();
         $dates = [];
         for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
               $dates[] = $date->copy();
         }

         $datesCollection = collect($dates);

         $lab_id = $lab;
         $startId = ($lab_id - 1) * 41 + 1;
         $endId = $lab_id * 41;
      @endphp

      @foreach ($datesCollection->chunk(4) as $chunkedDates)
            <table class="table-data" style="margin-top:10px;">
                  <thead>
                     <tr>
                        <th rowspan="2" class="center-text">TGL</th>
                        <th rowspan="2" style="width: 20px; font-size:12px;"><div class="vertical-text">ITEM</div></th>
                        <th colspan="41" class="center-text">Nomor Perangkat</th>
                        <th rowspan="2" class="center-text">Keterangan</th>
                     </tr>
                     <tr>
                        @for ($i = 1; $i <= 41; $i++)
                              <th class="center-text">{{ $i }}</th>
                        @endfor
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($chunkedDates as $date)
                        @php
                              $dateString = $date->format('Y-m-d');
                              $dayData = $data->firstWhere('date', $dateString);
                              $results = $dayData ? json_decode($dayData->results, true) : [];
                              $descriptions = $dayData ? json_decode($dayData->descriptions, true) : [];
                        @endphp
                        <tr>
                              <td rowspan="4" class="center-text">{{ $date->format('d') }}</td>
                              <td>M</td>
                              @for ($i = $startId; $i <= $endId; $i++)
                                 <td class="center-text">
                                    <div style="font-family: DejaVu Sans, sans-serif;">
                                          @if(isset($results[$i]['Mouse']) && $results[$i]['Mouse'] == 'on')
                                             &#10003;
                                          @endif
                                    </div>
                                 </td>
                              @endfor
                              <td>{{ $descriptions['Mouse'] ?? '' }}</td>
                        </tr>
                        <tr>
                              <td>K</td>
                              @for ($i = $startId; $i <= $endId; $i++)
                                 <td class="center-text">
                                    <div style="font-family: DejaVu Sans, sans-serif;">
                                          @if(isset($results[$i]['Keyboard']) && $results[$i]['Keyboard'] == 'on')
                                             &#10003;
                                          @endif
                                    </div>
                                 </td>
                              @endfor
                              <td>{{ $descriptions['Keyboard'] ?? '' }}</td>
                        </tr>
                        <tr>
                              <td>S</td>
                              @for ($i = $startId; $i <= $endId; $i++)
                                 <td class="center-text">
                                    <div style="font-family: DejaVu Sans, sans-serif;">
                                          @if(isset($results[$i]['Sistem']) && $results[$i]['Sistem'] == 'on')
                                             &#10003;
                                          @endif
                                    </div>
                                 </td>
                              @endfor
                              <td>{{ $descriptions['Sistem'] ?? '' }}</td>
                        </tr>
                        <tr>
                              <td>I</td>
                              @for ($i = $startId; $i <= $endId; $i++)
                                 <td class="center-text">
                                    <div style="font-family: DejaVu Sans, sans-serif;">
                                          @if(isset($results[$i]['Internet']) && $results[$i]['Internet'] == 'on')
                                             &#10003;
                                          @endif
                                    </div>
                                 </td>
                              @endfor
                              <td>{{ $descriptions['Internet'] ?? '' }}</td>
                        </tr>
                     @endforeach
                  </tbody>
            </table>
            @if (!$loop->last)
               <div class="page-break"></div>
            @endif
      @endforeach
   </div>

   <footer>

      <div class="footer-desc" style="height: 70px; width:70%;">
         <table class="table-aslab" style="float: left;">
            <thead>
               <tr>
                  <th>Asisten Lab</th>
                  <th>Paraf</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{ $headAssistants }}</td>
                  <td>
                     <img src="{{ asset('storage/'.$dataReport->kepala_aslab_signature) }}" alt="Tanda Tangan Dosen" width="50">
                  </td>
               </tr>
            </tbody>
         </table>

         <table class="table-desc" style="border-collapse:collapse; float: right; font-size:14px;">
            <tr>
               <td>Keterangan :</td>
               <td style="width: 120px;"></td>
               <td style="width: 120px;"></td>
            </tr>
            <tr>
               <td></td>
               <td>M : Mouse</td>
               <td>S : System</td>
            </tr>
            <tr>
               <td></td>
               <td>K : Keyboard</td>
               <td>I : Internet</td>
            </tr>
         </table>
      </div>
      
      <div class="signature-path">
         <table class="table-signature" style="font-size: 15px;">
             <tbody>
                 <tr>
                     <td style="text-align: left;">
                           Medan, {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('D MMMM YYYY') }} <br>
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
                         Teknisi
                     </td>
                     <td style="text-align: left;">
                         Kabag. Puskom
                     </td>
                     <td style="text-align: left;">
                         Wakil Rektor II
                     </td>
                 </tr>
                 <tr>
                     <td>
                         <img src="{{ asset('storage/'.$dataReport->teknisi_signature) }}" alt="Tanda Tangan Puskom" width="120" style="display: block; text-align: left;">
                     </td>
                     <td>
                         <img src="{{ asset('storage/'.$dataReport->kabag_signature) }}" alt="Tanda Tangan Kabag" width="120">
                     </td>
                     <td>
                         <img src="{{ asset('storage/'.$dataReport->wakil_rektor_signature) }}" alt="Tanda Tangan Wakil Rektor 2" width="120">
                     </td>
                 </tr>
                 <tr>
                  <td>
                     (Ahmad Jihad Alfayed)
                  </td>
                  <td>
                     (Soeheri M.Kom)
                  </td>
                  <td>
                     (Daifiria, M.Kom)
                  </td>
                 </tr>
             </tbody>
         </table>
     </div>
   </footer>
   
</body>
</html>


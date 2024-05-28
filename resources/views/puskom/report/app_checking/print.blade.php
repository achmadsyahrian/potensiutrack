<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Print Penugasan Pengembangan dan Penanganan Koneksi Jaringan</title>
   <style>
      body {
         font-family: 'Times New Roman', Times, serif;
         margin: 20px;
      }
      /* Tabler title */
      .table-title {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 10px;
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
         margin-top: 10px;
         border: 1px solid black;
         height: 500px;
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
         width: 96%;
         border-collapse: collapse;
         margin: auto;
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
         margin-bottom: 5px;
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
               <td style="width: 100px; height: 90px; text-align: center; vertical-align: middle;">
                  <img src="{{ asset('image/Logopotensiutama.png') }}" alt="Logo" width="85px" style="text-align: center">
               </td>
               <td class="header-cell">
                  <strong>DOKUMEN LEVEL</strong><br>FORM
               </td>
               <td class="header-cell" style="width: 30%;">
                  <strong>NO. DOKUMEN</strong><br>F-/SPMI/27-03-04
               </td>
            </tr>
            <tr>
               <td colspan="2" rowspan="2" class="header-cell">
                  <strong>JUDUL</strong><br>LAPORAN PENGECEKAN WEB DAN APLIKASI SISTEM INFORMASI
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
                         <img src="{{ asset('storage/'.$dataReport->puskom_signature) }}" alt="Tanda Tangan Puskom" width="120" style="display: block; text-align: left;">
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
   @foreach ($chunkedData as $index => $dataChunk)
      @php $pageNumber = ($index * 3) + 1; @endphp
      <div class="container" style="position:absolute; bottom:0; width:100%; left:0;">
         <div class="flex-container" style="display: flex; justify-content: space-between; font-size:13px; font-weight:500;">
            <div style="position: absolute; left: 20; margin-bottom:10px;">
                  <p>Bulan: {{ $monthName }} {{ $year }}</p>
            </div>
         </div>
         <table class="table-data" style="margin-top:15px;">
            <thead>
               <tr>
                  <th rowspan="2">URL Situs</th>
                  <th rowspan="2">Jam</th>
                  <th rowspan="2">Waktu</th>
                  <th colspan="{{ $daysInMonth }}">Tanggal Pengecekan</th>
               </tr>
               <tr>
                  @for ($day = 1; $day <= $daysInMonth; $day++)
                     <th>{{ $day }}</th>
                  @endfor
               </tr>
            </thead>
            <tbody>
               @foreach ($dataChunk as $item)
                   @for ($day = 1; $day <= $daysInMonth; $day++) <!-- iterasi untuk setiap $day -->
                       @for ($i = 1; $i <= 4; $i++) <!-- iterasi untuk setiap jam -->
                           <tr>
                               @if ($i === 1 && $day === 1) <!-- Tambahkan kondisi untuk hanya menampilkan URL pada baris pertama -->
                                   <td rowspan="4">
                                       {{ $item->application->url ?? $item->application->name }}
                                   </td>
                               @endif
                               <td>{{ $i }}</td> <!-- Nomor jam -->
                               @if ($i == 1)
                                 <td style="height: 7px;">08:00</td>
                                 @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <td>
                                          @php
                                             $status = json_decode($item->result, true);
                                             $checked = isset($status[$day]["jam_08"]);
                                          @endphp
                                          @if ($checked)
                                             <div style="font-family: DejaVu Sans, sans-serif;">&#10003;</div>
                                          @endif
                                    </td>
                                 @endfor
                              @elseif ($i == 2)
                                 <td>11:00</td>
                                 @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <td>
                                          @php
                                             $status = json_decode($item->result, true);
                                             $checked = isset($status[$day]["jam_11"]);
                                          @endphp
                                          @if ($checked)
                                             <div style="font-family: DejaVu Sans, sans-serif;">&#10003;</div>
                                          @endif
                                    </td>
                                 @endfor
                              @elseif ($i == 3)
                                 <td>16:00</td>
                                 @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <td>
                                          @php
                                             $status = json_decode($item->result, true);
                                             $checked = isset($status[$day]["jam_16"]);
                                          @endphp
                                          @if ($checked)
                                             <div style="font-family: DejaVu Sans, sans-serif;">&#10003;</div>
                                          @endif
                                    </td>
                                 @endfor
                              @elseif ($i == 4)
                                 <td>19:00</td>
                                 @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <td>
                                          @php
                                             $status = json_decode($item->result, true);
                                             $checked = isset($status[$day]["jam_19"]);
                                          @endphp
                                          @if ($checked)
                                             <div style="font-family: DejaVu Sans, sans-serif;">&#10003;</div>
                                          @endif
                                    </td>
                                 @endfor
                              @endif
                           </tr>
                       @endfor
                   @endfor
               @endforeach
           </tbody>
         </table>
      </div>
      @if (!$loop->last)
         <div class="page-break"></div>
      @endif
   @endforeach
</body>
</html>


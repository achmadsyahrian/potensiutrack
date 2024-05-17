<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Print Penggunaan Lab Komputer</title>
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
         padding: 10px;
         font-weight: 500;
         text-align: center;
         font-size: 14px;
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
      footer > .table-aslab {
         width: 20%;
         margin: 10px 0 0 0;
         border-collapse: collapse;
      }
      footer > .table-aslab > thead > tr > th{
         background-color: #cdcdcd !important;
         /* padding: 10px; */
         font-weight: 500;
         text-align: center;
         vertical-align: middle;
         border: 1px solid black;
      }
      footer > .table-aslab > tbody > tr > td {
         /* padding: 10px; */
         border: 1px solid black;
         font-size: 12px;
         text-align: center;
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
                  <strong>NO. DOKUMEN</strong><br>F-/SPMI/26-01-04
               </td>
            </tr>
            <tr>
               <td colspan="2" rowspan="2" class="header-cell">
                  <strong>JUDUL</strong><br>PENGGUNAAN LAB KOMPUTER
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
      <table class="table-aslab">
         <thead>
            <tr>
               <th>Asisten Lab</th>
               <th>Paraf</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($headAssistants as $headAssistant)
               <tr>
                  <td>{{ $headAssistant->user->name }}</td>
                  <td>
                     <img src="{{ asset('storage/'.$dataReport->kepala_aslab_signature) }}" alt="Tanda Tangan Dosen" width="50">
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>

      {{-- Signature Path --}}
      <div class="signature-path">
         <p style="margin: 4px 0;">Medan, 30 April 2024</p>
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
                         <img src="{{ asset('storage/'.$dataReport->teknisi_signature) }}" alt="Tanda Tangan Teknisi" width="120" style="display: block; text-align: left;">
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
   @foreach ($chunkedData as $index => $dataChunk)
      @php $pageNumber = ($index * 7) + 1; @endphp
      <div class="container" style="position:absolute; bottom:0; width:100%; left:0;">
         <div class="flex-container" style="display: flex; justify-content: space-between;">
            <div style="position: absolute; left: 20; margin-bottom:10px;">
               <p>Nama Lab Komputer: {{ $labName }}</p>
            </div>
            <div style="position: absolute; right: 20; margin-bottom:10px;">
                  <p>Bulan: {{ $month }} {{ $year }}</p>
            </div>
         </div>
         <table class="table-data" style="margin-top:15px;">
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Mata Kuliah</th>
                  <th>Dosen</th>
                  <th>Kelas</th>
                  <th>Materi Kuliah</th>
                  <th>Jumlah SKS</th>
                  <th>TTD Dosen</th>
                  <th>Paraf Aslab</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($dataChunk as $item)
                  <tr>
                     <td>{{ $pageNumber++ }}</td>
                     <td>{{ \Carbon\Carbon::parse($item->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</td>
                     <td>{{ \Carbon\Carbon::parse($item->time)->format('H:i') }}</td>
                     <td>{{ $item->course }}</td>
                     <td>{{ $item->lecturer->name }}</td>
                     <td>{{ $item->class }}</td>
                     <td>{{ $item->course_topic }}</td>
                     <td>{{ $item->course_credits }}</td>
                     <td style="padding:0;">
                           <img src="{{ asset('storage/'.$item->lecturer_signature) }}" alt="Tanda Tangan Dosen" width="50">
                     </td>
                     <td style="padding:0;">
                           <img src="{{ asset('storage/'.$item->lab_assistant_signature) }}" alt="Paraf Aslab" width="50">
                     </td>
                  </tr>
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


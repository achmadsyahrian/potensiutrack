<!DOCTYPE html>
<html>
<head>
    <style>
       @page {
          margin: 50px 25px;
       }

       header {
          position: fixed;
          top: -40px;
          left: 0px;
          right: 0px;
          height: 50px;
          text-align: center;
          line-height: 35px;
       }

       footer {
          position: fixed;
          bottom: -50px;
          left: 0px;
          right: 0px;
          height: 50px;
          text-align: center;
          line-height: 35px;
       }

       .page-break {
          page-break-after: always;
       }

       table {
          width: 100%;
          border-collapse: collapse;
          margin-bottom: 20px;
       }

       th,
       td {
          border: 1px solid black;
          padding: 8px;
          text-align: left;
       }

    </style>

</head>
<body>
    <header>
        <script type="text/php">
            if (isset($pdf)) {
                $font = $fontMetrics->get_font("helvetica", "normal");
                $size = 10;
                $x = 150; // Adjust the x-position according to your needs
                $y = 20;
                $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
                $color = array(0, 0, 0);
                $word_space = 0.0;  // Spasi antar kata
                $char_space = 0.0;  // Spasi antar karakter
                $angle = 0.0;       // Sudut teks (0 untuk horizontal)
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }
        </script>
        <h2>Monthly Report for {{ $labName }} - {{ $month }} {{ $year }}</h2>
    </header>

    <footer>
        <img src="{{ asset('image/Logopotensiutama.png') }}" alt="Signature" style="height: 50px;">
    </footer>

    @foreach ($chunkedData as $index => $dataChunk)
        <table style="margin-top: 70px;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Usage</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataChunk as $data)
                    <tr>
                        <td>{{ $data->date }}</td>
                        <td>{{ $data->usage }}</td>
                        <td>{{ $data->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>

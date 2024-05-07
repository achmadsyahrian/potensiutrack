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
                        <li class="breadcrumb-item"><a href="{{ route('puskom.appchecking.index') }}">Pemeriksaan Harian</a></li>
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
                <form action="{{ route('puskom.appchecking.update', ['app_checking' => $appChecking]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Data Permohonan</h2>
                            <div class="row g-3 mt-4">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Waktu</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::create()->month($appChecking->month)->translatedFormat('F') }} {{ $appChecking->year }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Aplikasi</label>
                                        <input type="text" class="form-control" value="{{ $appChecking->application->name }}" readonly>
                                    </div>
                                </div>

                                @php
                                    use Carbon\Carbon;
                                    $totalDays = Carbon::create($appChecking->year, $appChecking->month)->daysInMonth;
                                @endphp
                                
                                <div class="col-lg-12">
                                    <label class="form-label">Kondisi</label>
                                    <div class="card mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter card-table" id="computer-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Jam</th>
                                                        @for ($i = 1; $i <= $totalDays; $i++)
                                                            <th>{{ $i }}</th>
                                                        @endfor
                                                    <tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (['08:00', '11:00', '16:00', '19:00'] as $jam)
                                                        <tr class="text-center">
                                                            <td>{{ $jam }}</td>
                                                            @for ($day = 1; $day <= $totalDays; $day++)
                                                                @php
                                                                    $checkboxName = $appChecking->year . '-0' . $appChecking->month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) . '_' . str_replace(':', '', $jam);
                                                                    
                                                                    $results = json_decode($appChecking->result, true);
                                                                    
                                                                    $checkboxKey = $appChecking->year . '-0' . $appChecking->month . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                                                    $jamKey = 'jam_' . substr(str_replace(':', '', $jam), 0, 2);
                                                                    $isChecked = isset($results[$checkboxKey]) && isset($results[$checkboxKey][$jamKey]) && $results[$checkboxKey][$jamKey] == 1;
                                                                @endphp
                                                                <td>
                                                                    <input class="form-check-input m-0 align-middle" type="checkbox" name="{{ $checkboxName }}" {{ $isChecked ? 'checked' : '' }}>
                                                                </td>
                                                            @endfor
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('puskom.appchecking.index') }}" class="btn">
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
<script src="{{ asset('dist/libs/fslightbox/index.js?1684106062') }}" defer></script>
@endsection

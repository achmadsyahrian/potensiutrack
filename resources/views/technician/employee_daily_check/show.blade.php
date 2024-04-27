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
                        <li class="breadcrumb-item"><a href="{{ route('technician.employeepcdailychecks.index') }}">Pemeriksaan Harian</a></li>
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
                <form action="{{ route('technician.employeepcdailychecks.update', ['employee_pc_daily_check' => $employeePcDailyCheck]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Data Permohonan</h2>
                            <div class="row g-3 mt-4">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($employeePcDailyCheck->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Divisi</label>
                                        <input type="text" class="form-control" value="{{ $employeePcDailyCheck->division->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jam Mulai</label>
                                        <input type="time" class="form-control" value="{{ $employeePcDailyCheck->start_time }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jam Selesai</label>
                                        <input type="time" class="form-control" value="{{ $employeePcDailyCheck->end_time }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label">Kondisi</label>
                                    <div class="card mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter card-table" id="computer-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th><input class="form-check-input m-0 align-middle" type="checkbox" id="checkAll"></th>
                                                        <th>Keyboard</th>
                                                        <th>Mouse</th>
                                                        <th>Monitor</th>
                                                        <th>CPU</th>
                                                        <th>Internet</th>
                                                        <th>Printer</th>
                                                        <th>Scanner</th>
                                                    <tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td></td>
                                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" {{ $employeePcDailyCheck->keyboard_condition ? 'checked' : '' }} onclick="return false;"></td>
                                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" {{ $employeePcDailyCheck->mouse_condition ? 'checked' : '' }} onclick="return false;"></td>
                                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" {{ $employeePcDailyCheck->monitor_condition ? 'checked' : '' }} onclick="return false;"></td>
                                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" {{ $employeePcDailyCheck->cpu_condition ? 'checked' : '' }} onclick="return false;"></td>
                                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" {{ $employeePcDailyCheck->internet_condition ? 'checked' : '' }} onclick="return false;"></td>
                                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" {{ $employeePcDailyCheck->printer_condition ? 'checked' : '' }} onclick="return false;"></td>
                                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" {{ $employeePcDailyCheck->scanner_condition ? 'checked' : '' }} onclick="return false;"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Keluhan</label>
                                        <input type="text" class="form-control" value="{{ $employeePcDailyCheck->complaint ?? '-' }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" value="{{ $employeePcDailyCheck->description ?? '-' }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Paraf Staff/Pegawai</label>
                                        <a data-fslightbox="gallery" href="{{ asset('storage/'.$employeePcDailyCheck->employee_signature) }}">
                                            <img class="w-75 rounded border" src="{{ asset('storage/'.$employeePcDailyCheck->employee_signature) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Paraf Teknisi</label>
                                        <a data-fslightbox="gallery" href="{{ asset('storage/'.$employeePcDailyCheck->technician_signature) }}">
                                            <img class="w-75 rounded border" src="{{ asset('storage/'.$employeePcDailyCheck->technician_signature) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('technician.employeepcdailychecks.index') }}" class="btn">
                                        Kembali
                                    </a>
                                        {{-- <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button> --}}
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
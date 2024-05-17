@extends('layouts.app')
@section('content')

@include('components.notification-handler')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    <ol class="breadcrumb breadcrumb-arrows">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('headaslab.labrequestsreport.index') }}">Permohonan Penggunaan Lab</a></li>
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
                {{-- <form action="{{ route('technician.employeepcdailychecks.update', ['employee_pc_daily_check' => $labRequest]) }}" method="post">
                    @csrf
                    @method('put') --}}
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Data Permohonan</h2>
                            <div class="row g-3 mt-4">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($labRequest->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Waktu Rencana Penggunaan</label>
                                        <input type="datetime-control" class="form-control" value="{{ \Carbon\Carbon::parse($labRequest->scheduled_date)->locale('id_ID')->isoFormat('D MMMM YYYY') }} Jam{{ \Carbon\Carbon::parse($labRequest->scheduled_date)->isoFormat(' HH:mm') }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lab</label>
                                        <input type="text" class="form-control" value="{{ $labRequest->lab->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" class="form-control" value="{{ $labRequest->class }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Dosen</label>
                                        <input type="text" class="form-control" value="{{ $labRequest->lecturer->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mata Kuliah</label>
                                        <input type="text" class="form-control" value="{{ $labRequest->course ?? '-' }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Paraf Aslab</label>
                                        <a data-fslightbox="gallery" href="{{ asset('storage/'.$labRequest->lab_assistant_signature) }}">
                                            <img class="w-75 rounded border" src="{{ asset('storage/'.$labRequest->lab_assistant_signature) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <textarea data-bs-toggle="autosize" readonly class="form-control" name="description" id="" cols="" rows="7">{{ $labRequest->description ?? '-' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('headaslab.labrequestsreport.index') }}" class="btn">
                                        Kembali
                                    </a>
                                        {{-- <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button> --}}
                                </div>
                            </div>
                        </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('dist/libs/fslightbox/index.js?1684106062') }}" defer></script>
@endsection
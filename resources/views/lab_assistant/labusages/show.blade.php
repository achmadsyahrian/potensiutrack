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
                        <li class="breadcrumb-item"><a href="{{ route('labassistant.labusages.index') }}">Penggunaan Lab Komputer</a></li>
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
                {{-- <form action="{{ route('technician.employeepcdailychecks.update', ['employee_pc_daily_check' => $labUsage]) }}" method="post">
                    @csrf
                    @method('put') --}}
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Data Permohonan</h2>
                            <div class="row g-3 mt-4">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($labUsage->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jam</label>
                                        <input type="time" class="form-control" value="{{ $labUsage->time }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Dosen</label>
                                        <input type="text" class="form-control" value="{{ $labUsage->lecturer->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Lab</label>
                                        <input type="text" class="form-control" value="{{ $labUsage->lab->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" class="form-control" value="{{ $labUsage->class }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Mata Kuliah</label>
                                        <input type="text" class="form-control" value="{{ $labUsage->course ?? '-' }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Materi Kuliah</label>
                                        <input type="text" class="form-control" value="{{ $labUsage->course_topic ?? '-' }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah SKS</label>
                                        <input type="text" class="form-control" value="{{ $labUsage->course_credits ?? '-' }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Paraf Aslab</label>
                                        <a data-fslightbox="gallery" href="{{ asset('storage/'.$labUsage->lab_assistant_signature) }}">
                                            <img class="w-75 rounded border" src="{{ asset('storage/'.$labUsage->lab_assistant_signature) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanda Tangan Dosen</label>
                                        <a data-fslightbox="gallery" href="{{ asset('storage/'.$labUsage->lecturer_signature) }}">
                                            <img class="w-75 rounded border" src="{{ asset('storage/'.$labUsage->lecturer_signature) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('labassistant.labusages.index') }}" class="btn">
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
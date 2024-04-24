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
                        <li class="breadcrumb-item"><a href="{{ route('puskom.networktroubleshooting.index') }}">Permohonan Pengembangan Jaringan</a></li>
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
                <form action="{{ route('puskom.networktroubleshooting.markAsComplete', ['id' => $networkTroubleshooting]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Data Permohonan</h2>
                            <div class="row g-3 mt-4">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="text" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($networkTroubleshooting->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    @if ($networkTroubleshooting->status == 1)
                                    <div class="mb-3">
                                        <label class="form-label required">Tanggal Selesai</label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="date" class="form-control @error('finish_date') is-invalid @enderror"
                                                    name="finish_date" value="{{ $networkTroubleshooting->finish_date }}" autocomplete="off">
                                                <x-invalid-feedback field='finish_date'></x-invalid-feedback>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <span class="form-help" data-bs-toggle="popover" data-bs-placement="top"
                                                    data-bs-content="<p>Silakan isi kolom ini ketika sudah selesai menangani gangguan.</p>"
                                                    data-bs-html="true">?</span>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="text" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($networkTroubleshooting->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" readonly>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Divisi</label>
                                        <input type="text" class="form-control" value="{{ $networkTroubleshooting->division->name }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pemohon</label>
                                        <input type="text" class="form-control" value="{{ $networkTroubleshooting->reporter->name }}" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alasan Pengembangan</label>
                                        <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini"
                                            class="form-control @error('network_expansion_reason') is-invalid @enderror" id="" cols=""
                                            rows="1" readonly>{{ $networkTroubleshooting->fault_reason }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('puskom.networktroubleshooting.index') }}" class="btn">
                                        Kembali
                                    </a>
                                    @if ($networkTroubleshooting->status == 1)
                                        <button type="submit" class="btn btn-success">
                                            Selesai
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
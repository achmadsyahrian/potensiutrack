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
                        <li class="breadcrumb-item"><a href="{{ route('employee.networktroubleshooting.index') }}">Permohonan Penanganan Jaringan</a></li>
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
                <form
                    action="{{ route('employee.networktroubleshooting.verify', ['id' => $networkTroubleshooting->id]) }}"
                    method="POST">
                    @csrf
                    @method('PATCH')
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
                                            <label class="form-label">Tanggal Selesai</label>
                                            <input type="text" class="form-control"
                                                value="Belum Selesai" readonly>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <div class="row g-2">
                                                <div class="col">
                                                    <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($networkTroubleshooting->finish_date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}" readonly>
                                                </div>
                                            </div>
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
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Alasan Pengembangan</label>
                                        <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini"
                                            class="form-control @error('fault_reason') is-invalid @enderror" id="" cols=""
                                            rows="7" readonly>{{ $networkTroubleshooting->fault_reason }}</textarea>
                                    </div>
                                </div>
                                @if ($networkTroubleshooting->status == 2)
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <x-signature-canvas title="Paraf Pegawai" name="reporter_signature"></x-signature-canvas>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('employee.networktroubleshooting.index') }}" class="btn">
                                        Kembali
                                    </a>
                                    @if ($networkTroubleshooting->status == 2)
                                        <button type="submit" class="btn btn-success">
                                            Verifikasi
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection
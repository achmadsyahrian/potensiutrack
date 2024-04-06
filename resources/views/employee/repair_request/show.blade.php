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
                        <li class="breadcrumb-item"><a href="{{ route('technician.repairrequests.index') }}">Perawatan &
                                Perbaikan</a></li>
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
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h2 class="mb-4">Data Permohonan</h2>
                        <div class="row g-3 mt-4">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kode Inventory</label>
                                    <input type="text" class="form-control" name="inventory_code"
                                        placeholder="Masukkan kode" value="{{ $repairRequest->inventory_code }}"
                                        autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Divisi</label>
                                    <input type="text" class="form-control" value="{{ $repairRequest->division->name }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Permohonan</label>
                                    <input type="text" class="form-control" name="date"
                                        value="{{ $repairRequest->date ? \Carbon\Carbon::parse($repairRequest->date)->format('d F Y') : '' }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pengembalian</label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input type="text" class="form-control" name="date"
                                                value="{{ $repairRequest->return_date ? \Carbon\Carbon::parse($repairRequest->return_date)->format('d F Y') : 'Belum dikembalikan' }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pemohon</label>
                                    <input type="text" class="form-control"
                                        value="{{ $repairRequest->requester->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Penanggung Jawab</label>
                                    <input type="text" class="form-control"
                                        value="{{ $repairRequest->technician->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Jenis Barang</label>
                                    <input type="text" class="form-control"
                                        value="{{ $repairRequest->itemInventory->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Kerusakan</label>
                                    <textarea data-bs-toggle="autosize" readonly class="form-control"
                                        name="fault_description" id="" cols=""
                                        rows="1">{{ $repairRequest->fault_description ?? '-' }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Perbaikan</label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <textarea data-bs-toggle="autosize" class="form-control"
                                                name="repair_solution" readonly id="" cols=""
                                                rows="1">{{ $repairRequest->repair_solution ?? '-' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <a href="{{ route('employee.repairrequests.index') }}" class="btn">
                                    Kembali
                                </a>
                                @if ($repairRequest->status == 2)
                                <form
                                    action="{{ route('employee.repairrequests.verify', ['id' => $repairRequest->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">
                                        Verifikasi
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
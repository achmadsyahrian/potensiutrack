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
                <form action="{{ route('technician.repairrequests.update', ['repair_request' => $repairRequest]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Data Permohonan</h2>
                            <div class="row g-3 mt-4">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Kode Inventory</label>
                                        <input type="text"
                                            class="form-control @error('inventory_code') is-invalid @enderror"
                                            name="inventory_code" placeholder="Masukkan kode"
                                            value="{{ $repairRequest->inventory_code }}" autocomplete="off">
                                        <x-invalid-feedback field='inventory_code'></x-invalid-feedback>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Divisi</label>
                                        <select type="text"
                                            class="form-select @error('division_id') is-invalid @enderror"
                                            name="division_id" id="select-optgroups" value="">
                                            <option selected disabled>Pilih divisi</option>
                                            @foreach ($divisions as $item)
                                            <option value="{{ $item->id }}" {{ $repairRequest->division_id == $item->id
                                                ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-invalid-feedback field='division_id'></x-invalid-feedback>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Tanggal Permohonan</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                            name="date" value="{{ $repairRequest->date }}" autocomplete="off">
                                        <x-invalid-feedback field='date'></x-invalid-feedback>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pengembalian</label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <input type="date" class="form-control @error('return_date') is-invalid @enderror"
                                                    name="return_date" value="{{ $repairRequest->return_date }}" autocomplete="off">
                                                <x-invalid-feedback field='return_date'></x-invalid-feedback>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <span class="form-help" data-bs-toggle="popover" data-bs-placement="top"
                                                    data-bs-content="<p>Silakan isi kolom ini ketika sudah melakukan perbaikan.</p>"
                                                    data-bs-html="true">?</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Pemohon</label>
                                        <select type="text"
                                            class="form-select @error('requested_by') is-invalid @enderror"
                                            name="requested_by" id="select-optgroups" value="">
                                            <option selected disabled>Pilih pemohon</option>
                                            @foreach ($employees as $item)
                                            <option value="{{ $item->id }}" {{ $repairRequest->requested_by == $item->id
                                                ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-invalid-feedback field='requested_by'></x-invalid-feedback>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Penanggung Jawab</label>
                                        <select type="text"
                                            class="form-select @error('technician_id') is-invalid @enderror"
                                            name="technician_id" id="select-optgroups" value="">
                                            <option selected disabled>Pilih teknisi</option>
                                            @foreach ($technicians as $item)
                                            <option value="{{ $item->id }}" {{ $repairRequest->technician_id ==
                                                $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-invalid-feedback field='technician_id'></x-invalid-feedback>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label required">Jenis Barang</label>
                                        <select type="text"
                                            class="form-select @error('item_inventory_id') is-invalid @enderror"
                                            name="item_inventory_id" id="select-optgroups" value="">
                                            <option selected disabled>Pilih barang</option>
                                            @foreach ($itemInventories as $item)
                                            <option value="{{ $item->id }}" {{ $repairRequest->item_inventory_id ==
                                                $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-invalid-feedback field='item_inventory_id'></x-invalid-feedback>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Kerusakan</label>
                                        <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini"
                                            class="form-control @error('fault_description') is-invalid @enderror"
                                            name="fault_description" id="" cols=""
                                            rows="1">{{ $repairRequest->fault_description }}</textarea>
                                        <x-invalid-feedback field='name'></x-invalid-feedback>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Perbaikan</label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini"
                                                    class="form-control @error('repair_solution') is-invalid @enderror"
                                                    name="repair_solution" id="" cols=""
                                                    rows="1">{{ $repairRequest->repair_solution }}</textarea>
                                                <x-invalid-feedback field='repair_solution'></x-invalid-feedback>
                                            </div>
                                            <div class="col-auto align-self-center">
                                                <span class="form-help" data-bs-toggle="popover" data-bs-placement="top"
                                                    data-bs-content="<p>Harap isilah kolom ini dengan deskripsi perbaikan yang telah dilakukan, jika sudah melakukan perbaikan.</p>"
                                                    data-bs-html="true">?</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent mt-auto">
                                <div class="btn-list justify-content-end">
                                    <a href="{{ route('technician.repairrequests.index') }}" class="btn">
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

@endsection
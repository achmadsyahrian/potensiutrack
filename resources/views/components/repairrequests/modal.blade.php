<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('technician.repairrequests.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permohonan baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Kode Inventory</label>
                                <input type="text" class="form-control @error('inventory_code') is-invalid @enderror" name="inventory_code"
                                    placeholder="Masukkan kode" value="{{ old('inventory_code') }}" autocomplete="off">
                                <x-invalid-feedback field='inventory_code'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Tanggal</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                    value="{{ old('date') }}" autocomplete="off">
                                <x-invalid-feedback field='date'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Pemohon</label>
                                <select type="text" class="form-select @error('requested_by') is-invalid @enderror" name="requested_by" id="select-optgroups" value="">
                                    <option selected disabled>Pilih pemohon</option>
                                    @foreach ($employees as $item)
                                        <option value="{{ $item->id }}" {{ old('requested_by') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>                                
                                <x-invalid-feedback field='requested_by'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Penanggung Jawab</label>
                                <select type="text" class="form-select @error('technician_id') is-invalid @enderror" name="technician_id" id="select-optgroups" value="">
                                    <option selected disabled>Pilih teknisi</option>
                                    @foreach ($technicians as $item)
                                        <option value="{{ $item->id }}" {{ old('technician_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-invalid-feedback field='technician_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label required">Divisi</label>
                                <select type="text" class="form-select @error('division_id') is-invalid @enderror" name="division_id" id="select-optgroups" value="">
                                    <option selected disabled>Pilih divisi</option>
                                    @foreach ($divisions as $item)
                                        <option value="{{ $item->id }}" {{ old('division_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-invalid-feedback field='division_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Jenis Barang</label>
                                <select type="text" class="form-select @error('item_inventory_id') is-invalid @enderror" name="item_inventory_id" id="select-optgroups" value="">
                                    <option selected disabled>Pilih barang</option>
                                    @foreach ($itemInventories as $item)
                                        <option value="{{ $item->id }}" {{ old('item_inventory_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-invalid-feedback field='item_inventory_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Kerusakan</label>
                                <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini" class="form-control @error('fault_description') is-invalid @enderror" name="fault_description" id="" cols="" rows="1">{{ old('fault_description') }}</textarea>
                                <x-invalid-feedback field='fault_description'></x-invalid-feedback>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Perbaikan</label>
                                <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini" class="form-control @error('repair_solution') is-invalid @enderror" name="repair_solution" id="" cols="" rows="1">{{ old('repair_solution') }}</textarea>
                                <x-invalid-feedback field='name'></x-invalid-feedback>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn link-secondary" data-bs-dismiss="modal">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Simpan
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy ms-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if ($errors->any())
            var modal = new bootstrap.Modal(document.getElementById('modal-report'));
            modal.show();
        @endif
    });
</script>

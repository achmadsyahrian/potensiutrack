<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('technician.employeepcdailychecks.store') }}" method="post" enctype="multipart/form-data">
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
                                <label class="form-label required">Tanggal</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                    value="{{ old('date') }}" autocomplete="off">
                                <x-invalid-feedback field='date'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Divisi</label>
                                <select type="text" class="form-select @error('division_id') is-invalid @enderror"
                                    name="division_id" id="select-optgroups" value="">
                                    <option selected disabled>Pilih divisi</option>
                                    @foreach ($divisions as $item)
                                    <option value="{{ $item->id }}" {{ old('division_id')==$item->id ? 'selected' : ''
                                        }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-invalid-feedback field='division_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Jam Mulai</label>
                                <input type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                    value="{{ old('start_time') }}" autocomplete="off">
                                <x-invalid-feedback field='start_time'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Jam Selesai</label>
                                <input type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                                    value="{{ old('end_time') }}" autocomplete="off">
                                <x-invalid-feedback field='end_time'></x-invalid-feedback>
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
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                        name="keyboard_condition"></td>
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                        name="mouse_condition"></td>
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                        name="monitor_condition"></td>
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                        name="cpu_condition"></td>
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                        name="internet_condition"></td>
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                        name="printer_condition"></td>
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                        name="scanner_condition"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Keluhan</label>
                                <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini"
                                    class="form-control @error('complaint') is-invalid @enderror"
                                    name="complaint" id="" cols=""
                                    rows="1">{{ old('complaint') }}</textarea>
                                <x-invalid-feedback field='complaint'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea data-bs-toggle="autosize" placeholder="Ketikkan disini"
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description" id="" cols=""
                                    rows="1">{{ old('description') }}</textarea>
                                <x-invalid-feedback field='description'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-signature-canvas title="Paraf Staff/Pegawai" name="employee_signature"></x-signature-canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-signature-canvas title="Paraf Teknisi" name="technician_signature"></x-signature-canvas>
                            </div>
                        </div>
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

        // CheckAll
        const checkAllCheckbox = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('#computer-table tbody input[type="checkbox"]');

        // Tambahkan event listener untuk checkAll checkbox
        checkAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = checkAllCheckbox.checked;
            });
        });

        // Tambahkan event listener untuk semua checkbox lainnya
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Centang atau hilangkan centang checkAll checkbox tergantung pada apakah semua checkbox lainnya telah dicentang
                checkAllCheckbox.checked = [...checkboxes].every(function(cb) {
                    return cb.checked;
                });
            });
        });
        
    });
</script>
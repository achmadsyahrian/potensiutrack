<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('labassistant.labdailychecks.store') }}" class="d-inline-block" method="post">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label class="form-label required">Lab</label>
                                <select type="text" class="form-select @error('lab_id') is-invalid @enderror" name="lab_id" id="select-lab">
                                    <option selected disabled>Pilih lab</option>
                                    @foreach ($labs as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-invalid-feedback field='lab_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-1 d-flex justify-content-center align-items-center mt-3">
                            <button type="button" id="btnPilihLab" class="btn btn-info me-auto">Pilih</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Tanggal</label>
                                <input type="datetime-local" class="form-control @error('date') is-invalid @enderror"
                                    name="date" value="{{ old('date') }}"
                                    autocomplete="off">
                                <x-invalid-feedback field='date'></x-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Asisten Lab 1</label>
                                <select type="text" class="form-select @error('mandatory_user_id') is-invalid @enderror"
                                    name="mandatory_user_id" id="select-aslab" value="">
                                    <option selected disabled>Pilih asisten lab</option>
                                    @foreach ($lab_assistants as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-invalid-feedback field='mandatory_user_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Asisten Lab 2</label>
                                <select type="text" class="form-select @error('optional_user_id') is-invalid @enderror"
                                    name="optional_user_id" id="select-aslab" value="">
                                    <option selected disabled>Pilih asisten lab</option>
                                    @foreach ($lab_assistants as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-invalid-feedback field='optional_user_id'></x-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table" id="computer-table" style="display: none">
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan 
                        <svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy ms-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnPilihLab').addEventListener('click', function() {
        // Mengambil nilai lab_id dari select
        var labId = document.getElementById('select-lab').value;

        // Mengirim request AJAX ke server
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/labassistant/pilih-lab/' + labId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var computers = JSON.parse(xhr.responseText); // Respons dari server dalam bentuk JSON
                var table = document.querySelector('#computer-table'); // Ambil tabel
                var numberOfDevices = 4; // Karena Anda memiliki 4 perangkat tetap

                // Bersihkan isi tabel
                table.innerHTML = '';

                // Tambahkan baris untuk setiap perangkat di thead (sekarang ditampilkan secara horizontal)
                var theadRow = '<tr><th><input class="form-check-input m-0 align-middle" type="checkbox" id="checkAll" checked></th><th>Item</th>';
                for (let i = 1; i <= computers.length; i++) {
                    theadRow += '<th>' + i + '</th>';
                }
                theadRow += '<th>Keterangan</th></tr>';
                table.innerHTML += '<thead>' + theadRow + '</thead>';

                // Tambahkan kolom untuk setiap perangkat di tbody (sekarang ditampilkan secara vertikal)
                var tbody = '<tbody>';
                    for (let i = 0; i < numberOfDevices; i++) {
                        tbody += '<tr><td></td><td>' + getDeviceName(i) + '</td>';
                        computers.forEach(function(computer) {
                            let isChecked = computer.results && computer.results[getDeviceName(i)] === 'on';
                            let checkboxValue = isChecked ? 'on' : 'off'; // Tentukan nilai checkbox berdasarkan status perangkat
                            tbody += '<td><input type="hidden" name="results[' + computer.id + '][' + getDeviceName(i) + ']" value="off">';
                            tbody += '<input class="form-check-input m-0 align-middle" value="on" type="checkbox" checked name="results[' + computer.id + '][' + getDeviceName(i) + ']"' + (isChecked ? ' checked' : '') + '></td>';
                        });
                        tbody += '<td><textarea name="descriptions[' + getDeviceName(i) + ']" id="" cols="" rows="1" class="form-control" style="width: 200px;"></textarea></td></tr>';

                    }

                tbody += '</tbody>';
                table.innerHTML += tbody;

                // Tampilkan tabel
                table.style.display = 'table';

                // Tambahkan event listener untuk checkbox kontrol di thead
                document.getElementById('checkAll').addEventListener('click', function() {
                    var checkboxes = document.querySelectorAll('#computer-table tbody input[type="checkbox"]');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = document.getElementById('checkAll').checked;
                    });
                });
            } else {
                console.error('Gagal memuat data');
            }
        };
        xhr.send();

        // Fungsi untuk mendapatkan nama perangkat berdasarkan indeks
        function getDeviceName(index) {
            switch (index) {
                case 0:
                    return 'Mouse';
                case 1:
                    return 'Keyboard';
                case 2:
                    return 'Internet';
                case 3:
                    return 'Sistem';
                default:
                    return 'Unknown';
            }
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        @if ($errors->any())
            var modal = new bootstrap.Modal(document.getElementById('modal-report'));
            modal.show();
        @endif
    });
</script>


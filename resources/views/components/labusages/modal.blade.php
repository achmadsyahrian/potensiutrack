<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('labassistant.labusages.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Penggunaan baru</h5>
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
                                <label class="form-label required">Lab</label>
                                <select type="text" class="form-select @error('lab_id') is-invalid @enderror" name="lab_id" id="select-optgroups" value="">
                                    <option selected disabled>Pilih lab</option>
                                    @foreach ($labs as $item)
                                        <option value="{{ $item->id }}" {{ old('lab_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>                                
                                <x-invalid-feedback field='lab_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Dosen</label>
                                <select type="text" class="form-select @error('lecturer_id') is-invalid @enderror" name="lecturer_id" id="select-optgroups" value="">
                                    <option selected disabled>Pilih dosen</option>
                                    @foreach ($lecturers as $item)
                                        <option value="{{ $item->id }}" {{ old('lecturer_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>                                
                                <x-invalid-feedback field='lecturer_id'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Kelas</label>
                                <input type="text" class="form-control @error('class') is-invalid @enderror" name="class"
                                    placeholder="Masukkan kelas" value="{{ old('class') }}" autocomplete="off">
                                <x-invalid-feedback field='class'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Jam</label>
                                <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" autocomplete="off">
                                <x-invalid-feedback field='time'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Jumlah SKS</label>
                                <input type="number" min="1" class="form-control @error('course_credits') is-invalid @enderror" name="course_credits"
                                    placeholder="Masukkan jumlah" value="{{ old('course_credits') }}" autocomplete="off">
                                <x-invalid-feedback field='course_credits'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Mata Kuliah</label>
                                <input type="text" class="form-control @error('course') is-invalid @enderror" name="course"
                                    placeholder="Masukkan matkul" value="{{ old('course') }}" autocomplete="off">
                                <x-invalid-feedback field='course'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label required">Materi Kuliah</label>
                                <input type="text" class="form-control @error('course_topic') is-invalid @enderror" name="course_topic"
                                    placeholder="Masukkan materi" value="{{ old('course_topic') }}" autocomplete="off">
                                <x-invalid-feedback field='course_topic'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-signature-canvas title="Paraf Aslab" name="lab_assistant_signature"></x-signature-canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn link-secondary" data-bs-dismiss="modal">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="submitBtn">
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

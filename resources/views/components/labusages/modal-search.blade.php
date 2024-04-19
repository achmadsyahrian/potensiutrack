<div class="modal modal-blur fade " id="modal-search" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('labassistant.labusages.index') }}" method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pencarian Lanjutan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Penggunaan</label>
                                <input type="date" class="form-control" name="search_date" value="{{ request('search_date') }}" autocomplete="off">
                            </div>                            
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Waktu</label>
                                <input type="time" class="form-control" name="search_time" value="{{ request('search_time') }}" autocomplete="off">
                            </div>                            
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Lab</label>
                                <select type="text" class="form-select" name="search_lab">
                                    <option selected disabled>Pilih lab</option>
                                    @foreach ($labs as $item)
                                        <option value="{{ $item->id }}" {{ request('search_lab') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Dosen</label>
                                <select type="text" class="form-select" name="search_lecturer">
                                    <option selected disabled>Pilih dosen</option>
                                    @foreach ($lecturers as $item)
                                        <option value="{{ $item->id }}" {{ request('search_lecturer') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="input" class="form-control" name="search_class" placeholder="Masukkan kelas" value="{{ request('search_class') }}" autocomplete="off">
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

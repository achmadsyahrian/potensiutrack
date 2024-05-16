<div class="modal modal-blur fade " id="modal-search" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('sectionhead.networkassignment.index') }}" method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pencarian Lanjutan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="search_date" value="{{ request('search_date') }}" autocomplete="off">
                            </div>                            
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="search_finish_date" value="{{ request('search_finish_date') }}" autocomplete="off">
                            </div>                            
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Divisi</label>
                                <select type="text" class="form-select" name="search_division">
                                    <option selected disabled>Pilih divisi</option>
                                    @foreach ($divisions as $item)
                                        <option value="{{ $item->id }}" {{ request('search_division') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">IT Administrator</label>
                                <select type="text" class="form-select" name="search_engineer">
                                    <option selected disabled>Pilih admin</option>
                                    @foreach ($engineers as $item)
                                        <option value="{{ $item->id }}" {{ request('search_engineer') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select type="text" class="form-select" name="search_status">
                                    <option selected disabled>Pilih status</option>
                                    <option value="1" {{ request('search_status') == 1 ? 'selected' : '' }}>Baru</option>
                                    <option value="2" {{ request('search_status') == 2 ? 'selected' : '' }}>Sudah Selesai</option>
                                </select>
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
